<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">My Transaction</x-slot>
        <x-breadcrumb-item>My Transaction</x-breadcrumb-item>
        <x-breadcrumb-item>{{ $transaction->id }}</x-breadcrumb-item>
    </x-breadcrumb>
    <x-flash-notification></x-flash-notification>
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Transaction data</h5>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="card bg-slate-50">
                    <div class="card-body">
                        <span class="prose">Total item</span>
                        <h2>{{ $transaction->total_item }}</h2>
                    </div>
                </div>
                <div class="card bg-slate-50">
                    <div class="card-body">
                        <span class="prose">Total price</span>
                        <h2>Rp{{ number_format($transaction->total_price) }}</h2>
                    </div>
                </div>
                <div class="card bg-slate-50">
                    <div class="card-body">
                        <span class="prose">Total discount</span>
                        <h2>Rp{{ number_format($transaction->total_disc) }}</h2>
                    </div>
                </div>
                <div class="card bg-slate-50">
                    <div class="card-body">
                        <span class="prose">Total discount</span>
                        <h2>Rp{{ number_format($transaction->total_payment) }}</h2>
                    </div>
                </div>
            </div>
            <h5 class="mb-4">Products</h5>
            @foreach($transaction->transactionDetails as $detail)
            <div class="card bg-slate-50">
                <div class="card-body">
                    <div class="flex justify-between items-center">
                        <p class="prose">{{ $detail->item_name }}</p>
                        <p class="prose text-right">Rp{{ number_format($detail->final_price) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
