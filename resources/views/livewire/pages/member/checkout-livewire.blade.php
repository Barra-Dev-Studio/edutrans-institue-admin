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
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="card cursor-pointer @if($selectedPayment == 'ID_OVO') bg-sky-100 @endif" wire:click="setSelectedPayment('ID_OVO')">
                                <div class="card-body">
                                    <p>OVO</p>
                                </div>
                            </div>
                            <div class="card cursor-pointer @if($selectedPayment == 'ID_DANA') bg-sky-100 @endif" wire:click="setSelectedPayment('ID_DANA')">
                                <div class="card-body">
                                    <p>DANA</p>
                                </div>
                            </div>
                            <div class="card cursor-pointer @if($selectedPayment == 'ID_LINKAJA') bg-sky-100 @endif" wire:click="setSelectedPayment('ID_LINKAJA')">
                                <div class="card-body">
                                    <p>LINKAJA</p>
                                </div>
                            </div>
                            <div class="card cursor-pointer @if($selectedPayment == 'ID_SHOPEEPAY') bg-sky-100 @endif" wire:click="setSelectedPayment('ID_SHOPEEPAY')">
                                <div class="card-body">
                                    <p>SHOPEEPAY</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="mobile_number" :value="__('Nomor HP')" />
                        <x-text-input wire:model.live="mobileNumber" id="mobile_number" class="block mt-1 w-full" type="text" name="mobile_number"
                            placeholder="Nomor HP" required />
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
                        <button wire:click="submit" wire:loading.attr="disabled" wire:target="submit"
                            class="!no-underline prose bg-sky-800 text-white py-3 block w-full px-6 rounded hover:bg-sky-700 disabled:bg-sky-300 disabled:text-slate-100" @if(!$selectedPayment && Auth()) disabled @endif><span wire:loading.remove wire:target="submit">Pembayaran</span><span wire:loading wire:target="submit"><x-spinner></x-spinner></span></button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
