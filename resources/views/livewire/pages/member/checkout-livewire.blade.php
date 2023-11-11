<div>
    <div class="card bg-slate-50">
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="col-span-2 md:border-r md:border-slate-200 md:pr-8">
                    <h3 class="mb-4">Detail pembayaran</h3>
                    <div class="flex px-5 py-3 border-2 bg-yellow-50 text-yellow-700 border-yellow-100 rounded mb-4">
                        <div>
                            <h6 class="text-15">Mohon pratinjau informasi</h6>
                            <p>Pastikan produk dan informasi pembeli sudah sesuai karena detail produk akan dikirimkan ke
                                email pembeli</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="payment_method" :value="__('Metode Pembayaran')" />
                        <select class='dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5
                                        text-sm text-gray-500 focus:border
                                        focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100' wire:change="setSelectedPayment" wire:model.live="paymentMethod">
                            <option value="-1">Select</option>
                            @foreach($payments as $payment => $additional_price)
                            <option value="{{ $payment }}">{{ $payment }} (Rp{{ number_format($additional_price) }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-8">
                        <h3 class="mb-2">Detail produk</h3>
                        <div class="card bg-slate-50">
                            <div class="card-body flex gap-4 items-center">
                                <div>
                                    <img src="{{ \Storage::url($course->thumbnail) }}" class="w-[70px] rounded"
                                        alt="{{ $course->title }}">
                                </div>
                                <div>
                                    <h5 class="prose">{{ $course->title }}</h5>
                                    <p class="prose">{{ $course->mentor->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:pl-8">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <x-input-label for="payment_method" :value="__('Detail pemesanan')" />
                                <div class="flex gap-2 flex-col mt-4">
                                    <div class="flex gap-8 justify-between items-center">
                                        <p class="text-slate-700">{{ $course->title }}</p>
                                        <p class="text-right text-slate-700">Rp{{ number_format($course->price) }}</p>
                                    </div>
                                    <div class="flex gap-8 justify-between items-center">
                                        <p class="text-slate-700">PPN 11%</p>
                                        <p class="text-right text-slate-700">Rp{{ number_format($tax)
                                            }}</p>
                                    </div>
                                    <div class="flex gap-8 justify-between items-center">
                                        <p class="text-slate-700">Biaya transaksi</p>
                                        <p class="text-right text-slate-700">Rp{{ number_format($additionalPrice) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8">
                                <x-input-label for="payment_method" :value="__('Metode pembayaran')" />
                                <p class="text-slate-700">{{ $selectedPayment == null ? 'Silakan pilih metode pembayaran untuk melanjutkan proses pemesanan' : $selectedPayment }}</p>
                            </div>
                            <div class="mt-8">
                                <x-input-label for="payment_method" :value="__('Informasi pemesan')" />
                                @if(auth()->check())
                                <p class="text-slate-700">{{ auth()->user()->name }}</p>
                                <p class="text-slate-700">{{ auth()->user()->email }}</p>
                                @else
                                <a href="{{ route('login') }}" class="!no-underline prose bg-sky-800 text-white py-3 block w-full px-6 rounded hover:bg-sky-700">Masuk</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="h-[50px]"></div>
                    <div class="text-right">
                        <p class="text-slate-900 font-bold">Total pembayaran</p>
                        <h3>Rp{{ number_format($totalPrice) }}</h3>
                    </div>
                    @if(auth()->check())
                    <div class="w-full mt-4">
                        <button
                            class="!no-underline prose bg-sky-800 text-white py-3 block w-full px-6 rounded hover:bg-sky-700 disabled:bg-sky-300 disabled:text-slate-100" @if(!$selectedPayment && Auth()) disabled @endif>Lanjutkan
                            pembayaran</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
