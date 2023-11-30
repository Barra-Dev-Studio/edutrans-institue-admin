<x-app-layout>
    <x-breadcrumb>
    <x-slot name="title">Profile settings</x-slot>
    <x-breadcrumb-item>Profil settings</x-breadcrumb-item>
  </x-breadcrumb>

    <div class="card bg-slate-50 dark:border-zinc-600 dark:bg-zinc-800">
        <div class="card-body">
            <div class="max-w-xl">
                <livewire:profile.update-profile-information-form />
            </div>
        </div>
    </div>
    <div class="card bg-slate-50 dark:border-zinc-600 dark:bg-zinc-800">
        <div class="card-body">
            <div class="max-w-xl">
                <livewire:profile.update-password-form />
            </div>
        </div>
    </div>
    <div class="card bg-slate-50 dark:border-zinc-600 dark:bg-zinc-800">
        <div class="card-body">
            <div class="max-w-xl">
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</x-app-layout>
