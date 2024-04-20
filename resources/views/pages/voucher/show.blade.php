<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Voucher management</x-slot>
        <x-breadcrumb-item>Voucher management</x-breadcrumb-item>
        <x-breadcrumb-item>Detail</x-breadcrumb-item>
        <x-breadcrumb-item>{{ $voucher->name }}</x-breadcrumb-item>
    </x-breadcrumb>

    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Voucher data</h5>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-4 gap-8 items-center">
                <div class="col-span-3">
                    <div class="prose">
                        <h1 class="mb-1 text-slate-800">{{ $voucher->name }}</h1>
                        <div class="text-slate-600">{{ $voucher->description }}</div>
                    </div>
                </div>
                <div class="text-right">
                    <p class="mb-0">Kuota tersisa</p>
                    <h3>{{ $voucher->qty }} voucher</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-3 items-center gap-4">
        <div class="card bg-slate-50">
            <div class="card-body border-b border-slate-200">
                <h5>Discount off price</h5>
            </div>
            <div class="card-body">
                <h3>Rp{{ number_format($voucher->disc_off_price) }}</h3>
            </div>
        </div>
        <div class="card bg-slate-50">
            <div class="card-body border-b border-slate-200">
                <h5>Discount off percent</h5>
            </div>
            <div class="card-body">
                <h3>{{ number_format($voucher->disc_off_percent)}}%</h3>
            </div>
        </div>
        <div class="card bg-slate-50">
            <div class="card-body border-b border-slate-200">
                <h5>Valid</h5>
            </div>
            <div class="card-body">
                <h5>
                    {{ \Carbon\Carbon::parse($voucher->valid_start)->format('d F Y') }} s.d
                    {{ \Carbon\Carbon::parse($voucher->valid_end)->format('d F Y') }}
                </h5>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 items-center gap-4">
        <div class="card bg-slate-50">
            <div class="card-body border-b border-slate-200">
                <h5>Voucher code</h5>
            </div>
            <div class="card-body">
                <h3 class="pre italic">{{ $voucher->code }}</h3>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 items-center gap-4">
        <div class="card bg-slate-50">
            <div class="card-body border-b border-slate-200">
                <h5>Voucher rules</h5>
            </div>
            <div class="card-body">
                <div class="overflow-x-auto js-scrollable">
                    <table class="w-full table table-striped rounded">
                        @foreach($showRules as $rule => $value)
                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-slate-50">
                            <td class="p-2">{{ $rule }}</td>
                            <td class="p-2">{{ $value }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
