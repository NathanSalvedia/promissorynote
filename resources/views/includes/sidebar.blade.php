<aside class="w-64 bg-[#660809] text-white min-h-screen flex flex-col py-6 px-4">
    <div class="mb-8">
        <h2 class="text-2xl font-bold">Admin</h2>
    </div>
    <nav class="flex flex-col gap-2 py-6 px-4 h-full">
        <a href="{{ route('admin.subledger-create') }}"
           class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-black transition {{ request()->routeIs('admin.subledger-create') ? 'bg-black' : 'bg-[#660809]' }}">
            <iconify-icon icon="mdi:file-document-edit-outline"></iconify-icon>
            Subledger Entry
        </a>
        <a href="{{ route('admin.manage-record') }}"
           class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-black transition {{ request()->routeIs('admin.manage-record') ? 'bg-black' : 'bg-[#660809]' }}">
            <iconify-icon icon="mdi:file-document-edit-outline"></iconify-icon>
            Manage Records
        </a>
        <a href="{{ route('admin.analytics') }}"
           class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-black transition {{ request()->routeIs('admin.analytics') ? 'bg-black' : 'bg-[#660809]' }}">
            <iconify-icon icon="mdi:chart-line"></iconify-icon>
            Analytics
        </a>
        <a href="{{ route('admin.manage-users') }}"
           class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-black transition {{ request()->routeIs('admin.manage-users') ? 'bg-black' : 'bg-[#660809]' }}">
            <iconify-icon icon="mdi:account-multiple-outline"></iconify-icon>
            Manage Users
        </a>
        <a href="{{ route('admin.payment-tracking') }}"
           class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-black transition {{ request()->routeIs('admin.payment-tracking') ? 'bg-black' : 'bg-[#660809]' }}">
            <iconify-icon icon="mdi:cash-multiple"></iconify-icon>
            Payment Tracking
        </a>
    </nav>
</aside>
