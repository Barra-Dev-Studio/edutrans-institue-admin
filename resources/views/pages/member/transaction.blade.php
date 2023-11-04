<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">My Transaction</x-slot>
        <x-breadcrumb-item>My Transaction</x-breadcrumb-item>
    </x-breadcrumb>
    <x-flash-notification></x-flash-notification>
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Transaction data</h5>
        </div>
        <div class="card-body">
            <livewire:pages.member.transaction-table-livewire :memberId="$memberId"></livewire:pages.member.transaction-table-livewire>
        </div>
    </div>
</x-app-layout>
