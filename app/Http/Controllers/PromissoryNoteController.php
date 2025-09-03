<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use  \Illuminate\Support\Facades\Auth;
use App\Models\PromissoryNote;
use App\Models\Notification;
use Carbon\Carbon;




class PromissoryNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('student.promissorynote');
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
        return redirect()->route('student.dashboard')->with('error', 'Settle your previous promissory note before submitting a new application.');
      }

        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'student_id' => 'required|string|max:50',
            'gender' => 'required|string|max:10',
            'department' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'year_level' => 'required|string|max:20',
            'amount' => 'required|numeric',
            'reason' => 'required|string',
            'term' => 'required|string',
            'academic_year' => 'required|string',
            'down_payment' => 'nullable|numeric',
            'due_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'attachments' => 'nullable',
            'attachments.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);

            $validated['user_id'] = Auth::check() ? Auth::user()->id : null;

            $attachmentPaths = [];
            if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');
            foreach ((array)$files as $file) {
                if ($file) {
                    $path = $file->store('attachments', 'public');
                    $attachmentPaths[] = $path;
                }
             }
          }
             $validated['attachments'] = !empty($attachmentPaths) ? json_encode($attachmentPaths) : null;
             $validated['status'] = 'pending';
             PromissoryNote::create($validated);

             return redirect()->route('student.dashboard')->with('success', 'Promissory Note submitted successfully.');


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
            $note = PromissoryNote::findOrFail($id);
            return view('student.promissorynote_view', compact('note'));
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

      //public function getNotifications()
     // {
          //$user = Auth::user();
          //$notes = PromissoryNote::where('user_id', $user->id)->pluck('pn_id');
          //$notifications = Notification::whereIn('pn_id', $notes)
              //->whereNull('read_at')
              //->orderBy('sent_at', 'desc')
             // ->get();

         // return response()->json([
             // 'count' => $notifications->count(),
             // 'notifications' => $notifications,
         // ]);
      }


      //public function markNotificationAsRead(Request $request)
      //{
        //  $user = Auth::user();
         // $notificationId = $request->input('notification_id');


         // $notes = PromissoryNote::where('user_id', $user->id)->pluck('pn_id');
          //$notification = Notification::where('notification_id', $notificationId)
              //->whereIn('pn_id', $notes)
              //->first();

         // if ($notification && $notification->read_at === null) {
             // $notification->read_at = Carbon::now();
             // $notification->save();
             // return response()->json(['success' => true]);
         // }

          //return response()->json(['success' => false], 404);
     // }


