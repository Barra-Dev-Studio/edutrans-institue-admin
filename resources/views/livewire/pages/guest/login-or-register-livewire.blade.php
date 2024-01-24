<div class="card bg-slate-50">
    <div class="card-body">
        <div class="grid grid-cols-1 md:gap-0">
            @if($section === 'register')
            <div>
                <h3 class="mb-1">Yuk daftar sebelum membeli</h3>
                <p class="prose text-slate-500 mb-4">Jika belum memiliki akun</p>
                <form wire:submit="register">
                    <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-4">
                        <div>
                            <x-input-label for="name" :value="__('Nama lengkap')" />
                            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" placeholder="Nama lengkap" />
                            <x-input-error :messages="$errors->get('name')" wire:target="register" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" placeholder="Email" />
                            <x-input-error :messages="$errors->get('email')" wire:target="register" class="mt-2" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-4 mt-4">
                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                          type="password"
                                          name="password"
                                          placeholder="Password"
                                          required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" wire:target="register" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                          type="password"
                                          placeholder="Konfirmasi password"
                                          name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" wire:target="register" class="mt-2" />
                        </div>
                    </div>

                    <div class="block mt-4">
                        <p class="text-slate-500">Dengan mendaftar Anda menyetujui <a href="{{ route('terms') }}" class="underline">syarat dan ketentuan</a> yang ada di Edutrans Institute</p>
                    </div>

                    <div class="flex flex-col md:flex-row items-center gap-4 mt-4">
                        <x-primary-button class="w-full md:w-auto">
                            {{ __('Buat akun') }}
                        </x-primary-button>
                        <x-primary-outline-button wire:click="changeSection" class="w-full md:w-auto">
                            {{ __('Saya sudah memiliki akun') }}
                        </x-primary-outline-button>
                    </div>
                </form>
            </div>
            @elseif($section === 'login')
            <div>
                <h3 class="mb-1">Atau masuk</h3>
                <p class="prose text-slate-500 mb-4">Jika sudah memiliki akun</p>
                <form wire:submit="login">
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" placeholder="Email" />
                        <x-input-error :messages="$errors->get('email')" wire:target="login" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                      type="password"
                                      name="password"
                                      placeholder="Password"
                                      required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" wire:target="login" class="mt-2" />
                    </div>
                    <div class="block mt-4">
                        <p class="text-slate-500">Dengan menggunakan layanan kami, Anda menyetujui <a href="{{ route('terms') }}" class="underline">syarat dan ketentuan</a> yang ada di Edutrans Institute</p>
                    </div>
                    <div class="flex flex-col md:flex-row items-center gap-4 mt-4">
                        <x-primary-button class="w-full md:w-auto">
                            {{ __('Log in') }}
                        </x-primary-button>
                        <x-primary-outline-button wire:click="changeSection" class="w-full md:w-auto">
                            {{ __('Saya belum memiliki akun') }}
                        </x-primary-outline-button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
