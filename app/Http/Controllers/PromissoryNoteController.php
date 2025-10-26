<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PromissoryNote;
use App\Models\Notification;
use App\Models\SupportingDocument;
use Carbon\Carbon;
use App\Enums\Role;
use App\Models\AccountSubledger;
use App\Models\PartialPayment;
use App\Models\Period;
use Illuminate\Support\Facades\Mail;
use App\Mail\PromissoryNoteSubmitted;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Downpayment;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class PromissoryNoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $notifications = Notification::where('user_id', $user->id)
            ->orderByDesc('sent_at')
            ->get();

        $unreadCount = $notifications->where('is_read', false)->count();

        if (is_null($user->email_verified_at)) {
            $verificationNotification = (object)[
                'content' => 'Please verify your email address.',
                'is_read' => false,
                'sent_at' => now(),
            ];
            $notifications->prepend($verificationNotification);
            $unreadCount += 1;
        }

        return view('student.promissorynote', compact('notifications', 'unreadCount'));
    }

    public function create()
    {
        return view('student.promissorynoteform');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $restricted = PromissoryNote::where('user_id', $user->id)
            ->where('status', 'approved')
            ->where('due_date', '<', now())
            ->where('is_settled', false)
            ->exists();

        if ($restricted) {
            return redirect()->route('student.dashboard')
                ->with('error', 'Settle your previous promissory note before submitting a new application.');
        }

        $parentPnId = $request->input('parent_pn_id');

        $validated = $request->validate([
            'gender'        => 'required|string|max:10',
            'department'    => 'required|string|max:100',
            'course'        => 'required|string|max:250',
            'phone'         => [
                'required',
                'string',
                'max:20',
                Rule::unique('promissory_notes', 'phone')->ignore($parentPnId, 'pn_id'),
            ],
            'year_level'    => 'required|string|max:20',
            'amount'        => 'required|numeric',
            'reason'        => 'required|string',
            'other_reason'  => 'required_if:reason,Other|max:255',
            'academic_year' => 'required|string',
            'semester'      => 'required|string',
            'term'          => 'required|string',
            'down_payment'  => 'nullable|numeric|min:0',
            'due_date'      => 'required|date|after_or_equal:today',
            'attachments'   => 'nullable',
            'attachments.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'signature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_pn_id'  => 'nullable|integer',
        ]);

        $validated['user_id'] = $user->id;
        $validated['status'] = 'pending';

        if ($validated['reason'] === 'Other') {
            $validated['other_reason'] = $request->input('other_reason');
        } else {
            $validated['other_reason'] = null;
        }

        $assessmentBalance = AccountSubledger::where('user_id', $user->id)
            ->where('school_year', $request->academic_year)
            ->where('semester', $request->semester == '1st Semester' ? '1' : '2')
            ->where('reference', 'Billing')
            ->orderByDesc('date')
            ->orderByDesc('subledger_id')
            ->value('debit');

        $validated['assessment_balance'] = $assessmentBalance ? (float)str_replace(',', '', $assessmentBalance) : 0;

        unset($validated['attachments']);

        if ($request->filled('parent_pn_id')) {
            $validated['parent_pn_id'] = $request->parent_pn_id;
        }

        $promissoryNote = PromissoryNote::create($validated);

        // Handle electronic signature (prefer uploaded image)
        // Signature upload (image)
        if ($request->hasFile('signature_image')) {
            $file = $request->file('signature_image');
            $fileName = 'signature_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'signatures/' . $fileName;

            $file->storeAs('signatures', $fileName, 'private'); // specify 'private' disk
            $promissoryNote->signature_path = $filePath;
            $promissoryNote->save();
        } elseif ($request->filled('signature')) {
            $signatureData = $request->input('signature');
            if (preg_match('/^data:image\/(\w+);base64,/', $signatureData, $type)) {
                $signatureData = substr($signatureData, strpos($signatureData, ',') + 1);
                $type = strtolower($type[1]);
                $signatureData = base64_decode($signatureData);
                $fileName = 'signature_' . time() . '.' . $type;
                $filePath = 'signatures/' . $fileName;
                Storage::disk('private')->put($filePath, $signatureData); // specify 'private' disk
                $promissoryNote->signature_path = $filePath;
                $promissoryNote->save();
            }
        }

        Period::create([
            'pn_id'        => $promissoryNote->pn_id,
            'semester'     => $validated['semester'],
            'term'         => $validated['term'],
            'academic_year'=> $validated['academic_year'],
        ]);

        PartialPayment::create([
            'pn_id'          => $promissoryNote->pn_id,
            'payment_amount' => $validated['amount'],
            'due_date'       => $validated['due_date'] ?? null,
        ]);

        Downpayment::create([
            'user_id'       => $user->id,
            'academic_year' => $validated['academic_year'],
            'downpayment'   => $validated['down_payment'] ?? 0,
            'allocated_at'  => now(),
        ]);



        $admins = User::where('role', Role::ADMIN->value)->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id'   => $admin->id,
                'pn_id'     => $promissoryNote->pn_id,
                'content'   => $user->fullname . ' submitted a new promissory note.',
                'sent_at'   => now(),
                'is_read'   => false,
            ]);
}

        // Store attachments privately
        // Attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if ($file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('supporting_documents', $fileName, 'private'); // specify 'private' disk

                    SupportingDocument::create([
                        'pn_id'         => $promissoryNote->pn_id,
                        'file_name'     => $fileName,
                        'file_path'     => $filePath,
                        'document_type' => $file->getClientOriginalExtension(),
                        'upload_date'   => now(),
                    ]);
                }
            }
        }

        Mail::to($user->email)->send(new PromissoryNoteSubmitted($promissoryNote));

        return redirect()->route('student.dashboard')
            ->with('success', 'Promissory Note submitted successfully. An email notification has been sent.');
    }

    public function show(string $id)
    {
        //
    }

    public function view($id)
    {
        $note = PromissoryNote::with('supportingDocuments', 'user')->findOrFail($id);

        $set1Entries = AccountSubledger::where('user_id', $note->user_id)
            ->where('school_year', $note->academic_year)
            ->where('semester', '1')
            ->orderBy('date')
            ->orderBy('subledger_id')
            ->get();

        $assessmentBalance = isset($set1Entries[3]) ? (float)str_replace(',', '', $set1Entries[3]->balance) : 0;
        $partialPayment = $note->amount ?? 0;
        $remainingBalance = max(0, $assessmentBalance - $partialPayment);

        return view('student.promissorynote_view', compact(
            'note',
            'assessmentBalance',
            'partialPayment',
            'remainingBalance'
        ));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function checkStatus()
    {
        $user = Auth::user();
        $note = PromissoryNote::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->where('is_settled', false)
            ->first();

        return response()->json(['hasUnsettled' => $note ? true : false]);
    }

    public function recordPayment($pn_id)
    {
        $note = PromissoryNote::findOrFail($pn_id);
        $note->is_settled = true;
        $note->save();

        return redirect()->back()->with('success', 'Payment recorded and status updated.');
    }

    public function resubmit($pn_id)
    {
        $note = PromissoryNote::findOrFail($pn_id);

        if ($note->status !== 'rejected') {
            return redirect()->route('student.dashboard')->with('error', 'Only rejected notes can be resubmitted.');
        }

        $alreadyResubmitted = PromissoryNote::where('parent_pn_id', $note->pn_id)->exists();
        if ($alreadyResubmitted) {
            return redirect()->route('student.dashboard')->with('error', 'This note has already been resubmitted.');
        }

        return view('student.promissorynote_resubmit', compact('note'));
    }

    public function downloadAttachment($id)
    {
        $document = SupportingDocument::findOrFail($id);

        $disk = Storage::disk('private');
        $path = $document->file_path;

        if (!$disk->exists($path)) {
            \Log::error('File not found: ' . $path);
            abort(404, 'File not found: ' . $path);
        }


        $mime = $disk->mimeType($path);

        // If the file is an image, display inline for <img src="">
        if (str_starts_with($mime, 'image/')) {
            return response(
                $disk->get($path),
                200,
                [
                    'Content-Type' => $mime,
                    'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
                ]
            );
        }

        // Otherwise, force download (use storage_path for compatibility)
        return response()->download(
            storage_path('app/private/' . $path),
            $document->file_name,
            ['Content-Type' => $mime]
        );
    }

    public function viewSignature($pn_id)
    {
        $note = PromissoryNote::findOrFail($pn_id);
        $path = $note->signature_path;

        $disk = Storage::disk('private');
        if (!$path || !$disk->exists($path)) {
            abort(404);
        }

        $mime = $disk->mimeType($path);

        return response(
            $disk->get($path),
            200,
            [
                'Content-Type' => $mime,
                'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
            ]
        );
    }

    public function adminViewSignature($pn_id)
    {
        $note = PromissoryNote::findOrFail($pn_id);
        $path = $note->signature_path;

        $disk = Storage::disk('private');
        if (!$path || !$disk->exists($path)) {
            abort(404);
        }

        $mime = $disk->mimeType($path);

        return response(
            $disk->get($path),
            200,
            [
                'Content-Type' => $mime,
                'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
            ]
        );
    }
}



