<x-guest-layout>
    <div class="w-screen flex items-start md:items-center justify-center px-6">
        <div class="card bg-white w-full md:w-[400px]">
            <div class="card-body border-b border-slate-200 text-center">
                <p class="text-lg text-red-600">Selesaikan pembayaran sebelum<br>
                    <span class="font-bold text-red-700">{{ \Carbon\Carbon::parse($expiredAt, 'UTC')->tz('Asia/Jakarta')->format('d F, Y H:i') }}</span></p>
            </div>
            <div class="card-body text-center">
                <div>
                    <div class="flex flex-col items-center justify-center mb-4">
                        <span class="font-medium text-lg">Nomor virtual account</span>
                        <div class="border border-slate-200 px-4 mt-4 rounded py-4 w-full">
                            <h2 class="mt-0">{{ number_format($accountNumber, 0, ' ', ' ') }}</h2>
                            <button data-clipboard-text="{{ $accountNumber }}" class="btn btn-copy-account py-2 px-4 bg-slate-100 mt-4 rounded hover:bg-slate-50">Copy virtual account</button>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-center mb-4">
                        <span class="font-medium text-lg">Nominal pembayaran</span>
                        <div class="border border-slate-200 px-4 mt-4 py-4 rounded w-full">
                            <h3>Rp{{ number_format($amount) }}</h3>
                            <button data-clipboard-text="{{ $amount }}" class="btn btn-copy-price py-2 px-4 bg-slate-100 mt-4 rounded hover:bg-slate-50">Copy nominal</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js"></script>
    <script>
        const clipboardAccountNumber = new ClipboardJS('.btn-copy-account');
        clipboardAccountNumber.on('success', function() {
            const button = document.querySelector('.btn-copy-account')
            setTimeout(function() {
                button.textContent = 'Copy account number'
            }, 2000);
            button.textContent = 'Copied'
        })

        const clipboardPrice = new ClipboardJS('.btn-copy-price');
        clipboardPrice.on('success', function() {
            const button = document.querySelector('.btn-copy-price')
            setTimeout(function() {
                button.textContent = 'Copy nominal'
            }, 2000);
            button.textContent = 'Copied'
        })
    </script>
</x-guest-layout>
