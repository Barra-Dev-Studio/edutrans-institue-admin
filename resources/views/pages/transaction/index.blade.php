<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Transaction management</x-slot>
        <x-breadcrumb-item>Transaction management</x-breadcrumb-item>
    </x-breadcrumb>
    <div class="grid grid-cols-4">
        <div class="card bg-slate-50">
            <div class="card-body">
                <h5>Balance</h5>
                <h2>Rp{{ number_format($transaction->balance) }}</h2>
            </div>
        </div>
    </div>
    <x-flash-notification></x-flash-notification>
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Transaction data</h5>
        </div>
        <div class="card-body">
            <livewire:pages.transaction.transaction-table-livewire></livewire:pages.transaction.transaction-table-livewire>
        </div>
    </div>
</x-app-layout>
