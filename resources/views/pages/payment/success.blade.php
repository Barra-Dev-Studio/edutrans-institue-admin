<x-guest-layout>
    <div class="w-screen h-screen flex items-start md:items-center justify-center px-6">
        <div class="card bg-white w-full md:w-[400px]">
            <div class="card-body text-center">
                <div class="p-8">
                    <span class="text-emerald-600 text-6xl"><i class=" bx bx-check-circle"></i></span>
                    <h3 class="">Pembayaran berhasil</h3>
                    <p class="text-lg text-slate-600 mb-8">Pembayaran telah berhasil dikonfirmasi. Silakan masuk ke dashboard member untuk memulai</p>
                    <a class="!no-underline prose bg-sky-800 text-white py-3 px-6 rounded hover:bg-sky-700 hover:text-white mb-4" href="{{ route('member.index') }}">Dashboard member</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
