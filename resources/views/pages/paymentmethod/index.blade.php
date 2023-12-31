<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Payment method management</x-slot>
        <x-breadcrumb-item>Payment method management</x-breadcrumb-item>
    </x-breadcrumb>
    <x-flash-notification></x-flash-notification>
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Mentor data</h5>
        </div>
        <div class="card-body">
            <livewire:pages.payment-method.payment-method-table-livewire></livewire:pages.payment-method.payment-method-table-livewire>
        </div>
    </div>
</x-app-layout>
