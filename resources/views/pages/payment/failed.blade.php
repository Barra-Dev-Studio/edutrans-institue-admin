<x-guest-layout>
    <div class="w-screen h-screen flex items-start md:items-center justify-center px-6">
        <div class="card bg-white w-full md:w-[400px]">
            <div class="card-body text-center">
                <div class="p-8">
                    <span class="text-red-600 text-6xl"><i class="bx bx-error-circle"></i></span>
                    <h3 class="">Pembayaran gagal</h3>
                    <p class="text-lg text-slate-600 mb-8">Pembayaran gagal dilakukan. Silakan ulangi dalam beberapa saat lagi. Butuh bantuan? Hubungi kami</p>
                    <a class="!no-underline prose bg-sky-800 text-white py-3 px-6 rounded hover:bg-sky-700 hover:text-white mb-4"
                        href="{{ route('member.index') }}">Dashboard member</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
