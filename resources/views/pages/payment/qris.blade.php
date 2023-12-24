<x-guest-layout>
    <div class="w-screen h-screen flex items-start md:items-center justify-center px-6">
        <div class="card bg-white w-full md:w-[400px]">
            <div class="card-body border-b border-slate-200 text-center">
                <p class="text-lg text-red-600">Selesaikan pembayaran sebelum<br>
                    <span class="font-bold text-red-700">{{ \Carbon\Carbon::parse($expiredAt, 'UTC')->tz('Asia/Jakarta')->format('d F, Y H:i') }}</span></p>
            </div>
            <div class="card-body text-center">
                <div>
                    <div class="flex flex-col items-center justify-center mb-4">
                        <span class="font-medium text-lg mb-4">QRIS</span>
                        {!! QrCode::size(200)->generate($qrStrings) !!}
                    </div>
                    <div class="flex flex-col items-center justify-center mb-4">
                        <span class="font-medium text-lg">Nominal pembayaran</span>
                        <div class="bg-slate-200 px-4 mt-4 rounded">
                            <h3>Rp{{ number_format($amount) }}</h3>
                        </div>
                    </div>
                    <p class="text-lg text-slate-600">Transfer dengan nominal persis yang tertera di atas. Pembayaran akan otomatis divalidasi setelah pembayaran berhasil</p>
                    <div class="flex items-center justify-center mt-4">
                        <img src="{{ \Storage::url('paymentmethods/xendit.png') }}" class="h-10" alt="Powered by Xendit">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
