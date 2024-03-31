<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">User management</x-slot>
        <x-breadcrumb-item>Detail user</x-breadcrumb-item>
        <x-breadcrumb-item>{{ $user->name }}</x-breadcrumb-item>
        <x-breadcrumb-item>Assign course</x-breadcrumb-item>
    </x-breadcrumb>
    <x-flash-notification></x-flash-notification>
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Course list</h5>
        </div>
        <div class="card-body bg-white">
            <livewire:pages.transaction.add-transaction-manually-livewire :id="$user->id"></livewire:pages.transaction.add-transaction-manually-livewire>
        </div>
    </div>
</x-app-layout>
