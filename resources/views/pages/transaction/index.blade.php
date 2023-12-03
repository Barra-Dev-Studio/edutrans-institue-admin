<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Transaction management</x-slot>
        <x-breadcrumb-item>Transaction management</x-breadcrumb-item>
    </x-breadcrumb>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="card bg-white">
            <div class="card-body flex flex-col justify-between h-full">
                <div>
                    <div class="grid grid-cols-1 gap-5 items-center">
                        <div>
                            <span class="text-gray-700 dark:text-zinc-100">Saldo didapatkan</span>
                            <h4 class="mt-4 text-xl text-gray-800 dark:text-gray-100 ">Rp{{ number_format($transaction->balance) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="flex items-center mt-4 prose">
                    <span class="text-gray-700 text-13 dark:text-zinc-100">Data terakhir dari Xendit</span>
                </div>
            </div>
        </div>
        <div class="card bg-white">
            <div class="card-body flex flex-col justify-between h-full">
                <div>
                    <div class="grid grid-cols-1 gap-5 items-center">
                        <div>
                            <span class="text-gray-700 dark:text-zinc-100">Transaksi sukses</span>
                            <h4 class="mt-4 text-xl text-gray-800 dark:text-gray-100 ">{{ number_format($statistics->success) }} transaksi</h4>
                        </div>
                    </div>
                </div>
                <div class="flex items-center mt-4 prose">
                    <span class="text-gray-700 text-13 dark:text-zinc-100">Dari total {{ $statistics->total }} transaksi</span>
                </div>
            </div>
        </div>
        <div class="card bg-white">
            <div class="card-body flex flex-col justify-between h-full">
                <div>
                    <div class="grid grid-cols-1 gap-5 items-center">
                        <div>
                            <span class="text-gray-700 dark:text-zinc-100">Transaksi pending</span>
                            <h4 class="mt-4 text-xl text-gray-800 dark:text-gray-100 ">{{ number_format($statistics->pending) }} transaksi</h4>
                        </div>
                    </div>
                </div>
                <div class="flex items-center mt-4 prose">
                    <span class="text-gray-700 text-13 dark:text-zinc-100">Dari total {{ $statistics->total }} transaksi</span>
                </div>
            </div>
        </div>
        <div class="card bg-white">
            <div class="card-body flex flex-col justify-between h-full">
                <div>
                    <div class="grid grid-cols-1 gap-5 items-center">
                        <div>
                            <span class="text-gray-700 dark:text-zinc-100">Transaksi gagal</span>
                            <h4 class="mt-4 text-xl text-gray-800 dark:text-gray-100 ">{{ number_format($statistics->failed) }} transaksi</h4>
                        </div>
                    </div>
                </div>
                <div class="flex items-center mt-4 prose">
                    <span class="text-gray-700 text-13 dark:text-zinc-100">Dari total {{ $statistics->total }} transaksi</span>
                </div>
            </div>
        </div>
    </div>
    <x-flash-notification></x-flash-notification>
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Transaction data</h5>
        </div>
        <div class="card-body">
            <livewire:pages.transaction.transaction-table-livewire></livewire:pages.transaction.transaction-table-livewire>
        </div>
    </div>
</x-app-layout>
