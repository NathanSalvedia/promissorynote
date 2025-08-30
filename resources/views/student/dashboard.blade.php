@extends('layouts.layout')

@section('content')

{{-- ===== styles (marquee + icon animation) ===== --}}
<style>
  /* marquee for header strip */
  .marquee { white-space:nowrap; overflow:hidden; box-sizing:border-box }
  .marquee>span { display:inline-block; padding-left:100%; animation:marquee 16s linear infinite }
  .marquee:hover>span { animation-play-state:paused }
  @keyframes marquee { 0%{transform:translateX(0)} 100%{transform:translateX(-100%)} }

  /* icon animation (bounce + pulse) */
  @keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
  }
  @keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
  }
  .icon-anim {
    animation: bounce 1.5s infinite, pulse 3s infinite;
  }
</style>

<div class="min-h-screen bg-gray-100 flex flex-col">

    {{-- ================= HEADER ================= --}}
    <header class="w-full">
      {{-- Top black strip with scrolling text --}}
      <div class="bg-black text-white text-[11px] md:text-xs py-0.5">
        <div class="max-w-7xl mx-auto px-4">
          <div class="marquee">
            <span>Enroll Now  |  Experience a Modern SPC  |  Welcome to My.SPC Promissorynote Management System</span>
          </div>
        </div>
      </div>

      {{-- Maroon strip --}}
      <div class="bg-[#660809] text-white">
        <div class="max-w-7xl mx-auto px-4 py-1 text-[11px] md:text-xs flex justify-end gap-6">
        </div>
      </div>

      {{-- White navbar --}}
      <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
          <div class="flex items-center gap-3">
            <img src="/img/spc-wordmark.png" alt="SPC" class="h-10 md:h-12 object-contain">
          </div>
            <div class="flex items-center gap-6">
            <button class="relative text-[#660809] hover:text-[#000000] ">
                <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full">3</span>
            </button>
           <div class="flex items-center gap-2">
                <iconify-icon icon="mdi:account-circle" class="text-2xl text-gray-700"></iconify-icon>
                <span class="font-medium">{{ auth()->user()->fullname }}</span>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-[#660809] hover:text-[#000000] flex items-center gap-1">
                    <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
                    Logout
                </button>
            </form>
        </div>
    </header>


    <main class="p-6 max-w-6xl mx-auto w-full">

        <h2 class="text-xl font-bold mb-4">Student Portal</h2>
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
            <div class="bg-[#660809]  text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:file-document-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                            <p class="text-sm/5 opacity-90">Total Notes</p>
                            <p class="text-3xl font-bold">{{ $promissoryNotes->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809]  text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:clock-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                            <p class="text-sm/5 opacity-90">Pending</p>
                            <p class="text-3xl font-bold">{{ $promissoryNotes->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
            </div>


            <div class="bg-[#660809]  text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                            <p class="text-sm/5 opacity-90">Approved</p>
                            <p class="text-3xl font-bold">{{ $promissoryNotes->where('status', 'approved')->count() }}</p>
                    </div>
                </div>
            </div>


            <div class="bg-[#660809]  text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:currency-php" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                            <p class="text-sm/5 opacity-90">Total Amount</p>
                            <p class="text-2xl font-bold">₱{{ number_format($promissoryNotes->sum('amount'), 2) }}</p>
                    </div>
                </div>
            </div>
        </div>


            <div class="mb-6 grid grid-cols-2 gap-4">





                <a href="{{ route('student.promissorynote') }}" id="newPromissoryNote"
                class="bg-[#660809] hover:bg-[#000000] text-white px-5 py-2 rounded-lg shadow flex items-center gap-2 justify-center">
                    <iconify-icon icon="mdi:plus-circle-outline" class="text-lg"></iconify-icon>
                    New Promissory Note
                </a>


                <a href="{{ route('student.subledger')}}"
                class="bg-[#660809] hover:bg-[#000000] text-white px-5 py-2 rounded-lg shadow flex items-center gap-2 justify-center">
                    <iconify-icon icon="mdi:clipboard-list-outline" class="text-lg"></iconify-icon>
                    Account Subledger
                </a>
            </div>


        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">My Promissory Notes</h3>
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border">Note ID</th>
                        <th class="py-2 px-4 border">Amount</th>
                        <th class="py-2 px-4 border">Reason</th>
                        <th class="py-2 px-4 border">Status</th>
                        <th class="py-2 px-4 border">Date</th>
                        <th class="py-2 px-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($promissoryNotes as $note)
                    <tr>
                        <td class="py-2 px-4 border">{{ $note->pn_id }}</td>
                        <td class="py-2 px-4 border">₱{{ number_format($note->amount, 2) }}</td>
                        <td class="py-2 px-4 border">{{ $note->reason }}</td>
                        <td class="py-2 px-4 border text-[#660809] font-semibold">{{ ucfirst($note->status) }}</td>
                        <td class="py-2 px-4 border">{{ $note->created_at->format('Y-m-d') }}</td>
                        <td class="py-2 px-4 border text-[#660809]  cursor-pointer flex items-center gap-1">
                            <a href="{{ route('student.promissorynote.view', $note->pn_id) }}" class="flex items-center gap-1">
                                <iconify-icon icon="mdi:eye-outline"></iconify-icon> View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-2 px-4 border text-center text-gray-500">No promissory notes found.</td>
                    </tr>
                    @endforelse
          </tbody>
        </table>
      </div>
    </main>
</div>

@endsection
