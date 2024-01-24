<x-guest-layout>
    <div class="bg-sky-900 pt-16 md:px-16">
        <div class="px-6 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 items-end gap-8">
                <div class="col-span-2 pb-16 md:pb-12">
                    <p class="text-slate-300 mb-4 prose">Proses pembayaran</p>
                    <h1 class="text-white text-5xl leading-snug">Checkout dan Informasi Pembayaran</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="md:px-16 pb-16 mt-16">
        <div class="px-6 md:px-8">
            @guest
            <livewire:pages.guest.login-or-register-livewire :course="$course"></livewire:pages.guest.login-or-register-livewire>
            @endguest
            @auth
            <livewire:pages.member.checkout-livewire :course="$course"></livewire:pages.member.checkout-livewire>
            @endauth
        </div>
    </div>
</x-guest-layout>
