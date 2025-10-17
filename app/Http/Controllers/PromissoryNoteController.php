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

class PromissoryNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Get notifications for the user
        $notifications = Notification::where('user_id', $user->id)
            ->orderByDesc('sent_at')
            ->get();

        // Count unread notifications
        $unreadCount = $notifications->where('is_read', false)->count();

        // Add email verification notification if not verified
        if (is_null($user->email_verified_at)) {
            $verificationNotification = (object)[
                'content' => 'Please verify your email address.',
                'is_read' => false,
                'sent_at' => now(),
            ];
            // Prepend to notifications
            $notifications->prepend($verificationNotification);
            $unreadCount += 1;
        }

        return view('student.promissorynote', compact('notifications', 'unreadCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.promissorynoteform');
    }

    /**
     * Store a newly created resource in storage.
     */
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

        $validated = $request->validate([
            'gender'        => 'required|string|max:10',
            'department'    => 'required|string|max:100',
            'course'        => 'required|string|max:250',
            'phone'         => 'required|string|max:20',
            'year_level'    => 'required|string|max:20',
            'amount'        => 'required|numeric',
            'reason'        => 'required|string',
            'other_reason'  => 'required_if:reason,Other|max:255',
            'academic_year' => 'required|string',
            'semester'      => 'required|string',
            'down_payment'  => 'nullable|numeric|min:0',
            'due_date'      => 'required|date|after_or_equal:today',
            'attachments'   => 'nullable',
            'attachments.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        Period::create([
            'pn_id'        => $promissoryNote->pn_id,
            'semester'     => $validated['semester'],
            'academic_year'=> $validated['academic_year'],
        ]);

        PartialPayment::create([
            'pn_id'          => $promissoryNote->pn_id,
            'payment_amount' => $validated['amount'],
            'due_date'       => $validated['due_date'] ?? null,
        ]);

        if ($promissoryNote->due_date) {
            Notification::create([
                'user_id'   => $user->id,
                'pn_id'     => $promissoryNote->pn_id,
                'content'   => "Reminder: Your promissory note is due on {$promissoryNote->due_date}.",
                'sent_at'   => now(),
                'is_read'   => false,
            ]);
        }

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

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if ($file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('supporting_documents', $fileName, 'public');

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

        // Send email notification to the user
       Mail::to($user->email)->send(new PromissoryNoteSubmitted($promissoryNote));

        return redirect()->route('student.dashboard')
            ->with('success', 'Promissory Note submitted successfully. An email notification has been sent.');
    }

         /**
          * Display the specified resource.
          */
              public function show(string $id)
          {


             //
          }




        /**
         * Display a specific promissory note for viewing.
         */
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

       /**
        * Show the form for editing the specified resource.
        */
        public function edit(string $id)
       {
         //
       }

       /**
       * Update the specified resource in storage.
       */
       public function update(Request $request, string $id)
       {
        //
       }

       /**
       * Remove the specified resource from storage.
       */
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

        return view('student.promissorynote_resubmit', compact('note'));
    }
}



