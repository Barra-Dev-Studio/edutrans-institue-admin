<x-guest-layout>
    <div class="w-screen h-screen flex items-start md:items-center justify-center px-6">
        <div class="card bg-white w-full md:w-[400px]">
            <div class="card-body border-b border-slate-200">
                <p class="text-lg text-orange-600">Selesaikan pembayaran sebelum<br>{{ \Carbon\Carbon::parse($expiredAt, 'UTC')->tz('Asia/Jakarta')->format('d F, Y H:i') }}</p>
            </div>
            <div class="card-body text-center">
                <div class="p-8">
                    <div class="flex items-center justify-center mb-4">
                        {!! QrCode::size(200)->generate($qrStrings) !!}
                    </div>
                    <h3 class="mb-4">Rp{{ number_format($amount) }}</h3>
                    <p class="text-lg text-slate-600">Scan QRCode pembayaran untuk melanjutkan transaksi. Pembayaran akan otomatis divalidasi setelah pembayaran berhasil</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
