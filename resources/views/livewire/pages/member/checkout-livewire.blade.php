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
                        <x-input-label class="font-bold text-lg mb-8" for="payment_method" :value="__('Pilih Metode Pembayaran')" />
                        @foreach($paymentMethods as $type => $payments)
                        <div class="mb-8">
                            <x-input-label class="mb-8" for="payment_method" :value="$type" />
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-4">
                                @foreach($payments as $payment)
                                <div class="card bg-white mb-0 cursor-pointer @if($selectedPayment == $payment->code) border-sky-500 @endif" wire:click="setSelectedPayment('{{ $payment->code }}')">
                                    <div class="card-body flex">
                                        <img src="{{ \Storage::url('paymentmethods/' . $payment->logo)}}" class="w-full h-[30px]" alt="{{ $payment->name }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-8">
                        <x-input-label for="mobile_number" :value="__('Nomor HP')" />
                        <x-text-input wire:model.live="mobileNumber" id="mobile_number" class="block mt-1 w-full mb-1" type="text" name="mobile_number"
                            placeholder="08123xxx" required />
                        <span class="text-slate-500">Jika memilih metode pembayaran Ewallet, pastikan Nomor HP yang dimasukan yang terdaftar di Ewallet yang dipilih</span>
                    </div>
                    <div class="mt-8">
                        <h3 class="mb-2">Detail produk</h3>
                        <div class="card bg-white">
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
                    <div class="card bg-white">
                        <div class="card-body">
                            <div>
                                <x-input-label for="payment_method" :value="__('Detail pemesanan')" />
                                <div class="flex gap-2 flex-col mt-4">
                                    <div class="flex gap-8 justify-between items-center">
                                        <p class="text-slate-700">{{ $course->title }}</p>
                                        @if($course->discount_price > 0)
                                            <div>
                                                <p class="text-right text-slate-700 line-through">Rp{{ number_format($course->price) }}</p>
                                                <p class="text-right text-slate-700">Rp{{ number_format($course->discount_price) }}</p>
                                            </div>
                                        @else
                                            <p class="text-right text-slate-700">Rp{{ number_format($course->price) }}</p>
                                        @endif
                                    </div>
                                    <div class="flex gap-8 justify-between items-center">
                                        <p class="text-slate-700">Biaya transaksi</p>
                                        <p class="text-right text-slate-700">Rp{{ number_format($additionalPrice) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8">
                                <x-input-label for="payment_method" :value="__('Metode pembayaran')" />
                                <p class="text-slate-700">{{ $selectedPayment == null ? 'Silakan pilih metode pembayaran untuk melanjutkan proses pemesanan' : $selectedPaymentShow->name }}</p>
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
                    <div class="flex items-center justify-center mt-4">
                        <img src="{{ \Storage::url('paymentmethods/xendit.png') }}" class="h-10" alt="Powered by Xendit">
                    </div>
                    <div class="mt-4">
                        <x-flash-notification></x-flash-notification>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
