<aside class="w-64 bg-[#660809] text-white flex flex-col p-4 space-y-3 min-h-screen fixed top-0 left-0 z-40">
 

    {{-- ✅ Dashboard Button --}}
    <a href="{{ route('admin.dashboard') }}"
       class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-black transition">
        <iconify-icon icon="mdi:view-dashboard-outline"></iconify-icon>
        Dashboard
    </a>

    <a href="{{ route('admin.manage-record') }}"
       class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-black transition">
        <iconify-icon icon="mdi:file-document-edit-outline"></iconify-icon>
        Manage Records
    </a>

    <a href="#"
       class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-black transition">
        <iconify-icon icon="mdi:chart-line"></iconify-icon>
        Analytics
    </a>

    <a href="{{ route('admin.manage-users') }}"
       class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-black transition">
        <iconify-icon icon="mdi:account-multiple-outline"></iconify-icon>
        Manage Users
    </a>

    <a href="{{ route('admin.payment-tracking') }}"
       class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-black transition">
        <iconify-icon icon="mdi:cash-multiple"></iconify-icon>
        Payment Tracking
    </a>
</aside>
