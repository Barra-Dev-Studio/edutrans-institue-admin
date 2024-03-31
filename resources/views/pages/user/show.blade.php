<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">{{ $user->name }}</x-slot>
        <x-breadcrumb-item>User management</x-breadcrumb-item>
        <x-breadcrumb-item>Detail User</x-breadcrumb-item>
        <x-breadcrumb-item>{{ $user->name }}</x-breadcrumb-item>
    </x-breadcrumb>
    <div class="grid grid-cols-3 gap-2">
        <div class="card mb-0 bg-white">
            <div class="card-body">
                <span class="text-slate-500">Total course</span>
                <h3 class="my-3">{{ $stats['courses'] }} Courses</h3>
                <span class="text-slate-500">Terakhir diupdate {{ \Carbon\Carbon::now()->format('Y-m-d, H:i') }}</span>
            </div>
        </div>
        <div class="card mb-0 bg-white">
            <div class="card-body">
                <span class="text-slate-500">Total transaction</span>
                <h3 class="my-3">{{ $stats['transactions'] }} Transactions</h3>
                <span class="text-slate-500">Terakhir diupdate {{ \Carbon\Carbon::now()->format('Y-m-d, H:i') }}</span>
            </div>
        </div>
        <div class="card mb-0 bg-white">
            <div class="card-body">
                <span class="text-slate-500">Total payment</span>
                <h3 class="my-3">Rp{{ number_format($stats['payment']) }}</h3>
                <span class="text-slate-500">Terakhir diupdate {{ \Carbon\Carbon::now()->format('Y-m-d, H:i') }}</span>
            </div>
        </div>
    </div>
    <div class="mt-2 pb-4">
        <livewire:pages.user.user-detail-livewire :user="$user"></livewire:pages.user.user-detail-livewire>
    </div>
</x-app-layout>
