<div>
    <div class="flex flex-wrap gap-2 mb-2 mt-8">
        <button class="btn @if($activeTab === 'courses') bg-sky-500 text-white @else bg-white @endif" wire:click="changeTab('courses')">Courses</button>
        <button class="btn @if($activeTab === 'transactions') bg-sky-500 text-white @else bg-white @endif" wire:click="changeTab('transactions')">Transaction</button>
    </div>
    @if($activeTab === 'courses')
    <div class="card bg-white mb-0">
        <div class="card-body pb-4 border-b border-slate-200">
            <div class="flex justify-between items-center">
                <h5 class="dark:text-zinc-100">Owned Courses</h5>
                <a href="" class="btn bg-emerald-500 text-white hover:bg-emerald-600">Add new course manually</a>
            </div>
        </div>
        <div class="card-body">
            <livewire:pages.user.user-detail-courses-livewire :id="$user->id"></livewire:pages.user.user-detail-courses-livewire>
        </div>
    </div>
    @elseif($activeTab === 'transactions')
    <div class="card bg-white mb-0">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">User Transactions</h5>
        </div>
        <div class="card-body">
            <livewire:pages.user.user-detail-transaction-livewire :id="$user->id"></livewire:pages.user.user-detail-transaction-livewire>
        </div>
    </div>
    @endif
</div>
