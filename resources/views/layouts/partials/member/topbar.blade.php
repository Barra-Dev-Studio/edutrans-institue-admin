<nav class="md:px-16">
    <div class="flex items-center justify-between px-6 md:px-8 py-6 md:py-0">
        <div class="flex items-center gap-4">
            <img src="{{ asset('assets/images/logo.png') }}" class="hidden md:block" height="50" width="50" alt="">
            <div class="prose flex flex-col md:flex-row gap-2">
                <a href="{{ route('home') }}" class="text-lg font-semibold !no-underline">Edutrans Intitute</a>
                <span class="font-handwrite text-lg font-semibold">by Hendi Pratama</span>
            </div>
        </div>
        <div class="py-5 hidden md:block">
            <ul class="flex gap-8 items-center list-none">
                <li><a href="{{ route('home') }}" class="!no-underline prose hover:text-black">Home</a></li>
                <li><a href="#" class="!no-underline prose hover:text-black">Instructors</a></li>
                <li><a href="#" class="!no-underline prose hover:text-black">Categories</a></li>
                <li><a href="{{ route('courses') }}" class="!no-underline prose hover:text-black">Courses</a></li>
            </ul>
        </div>
        <div class="py-5">
            <ul class="flex gap-4 md:gap-2 items-center list-none">
                @if(Auth()->user())
                <li><a href="#" class="!no-underline prose hover:text-black text-xl"><i class="bx bx-cart-alt"></i></a></li>
                <li>
                    <div>
                        <div class="dropdown relative">
                            <button type="button"
                                class="flex items-center md:px-4 dropdown-toggle dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100"
                                id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <img class="h-8 w-8 rounded-full ltr:xl:mr-2"
                                    src="https://ui-avatars.com/api/?background=random&name={{ \Str::slug(\Auth()->user()->name) }}"
                                    alt="Header Avatar">
                                <span class="fw-medium hidden xl:block prose">{{ \Auth()->user()->name }}</span>
                                <i class="mdi mdi-chevron-down align-bottom hidden xl:block"></i>
                            </button>
                            <div class="dropdown-menu absolute top-0 md:-left-3 z-50 hidden w-40 list-none rounded bg-white shadow dark:bg-zinc-800"
                                id="profile/log">
                                <div class="border border-gray-50 dark:border-zinc-600" aria-labelledby="navNotifications">
                                    <ul class="flex flex-col gap-4 items-start list-none md:hidden px-3 py-2">
                                        <li><a href="{{ route('home') }}" class="!no-underline prose hover:text-black">Home</a></li>
                                        <li><a href="#" class="!no-underline prose hover:text-black">Instructors</a></li>
                                        <li><a href="#" class="!no-underline prose hover:text-black">Categories</a></li>
                                        <li><a href="{{ route('courses') }}" class="!no-underline prose hover:text-black">Courses</a></li>
                                    </ul>
                                    <hr class="border-gray-50 dark:border-gray-700 block md:hidden">
                                    <div class="dropdown-item dark:text-gray-100">
                                        <a class="px-3 py-2 hover:bg-gray-50/50 block dark:hover:bg-zinc-700/50 prose !no-underline"
                                            href="{{ route('member.index') }}">
                                            <i class="mdi mdi-home text-16 align-middle mr-1"></i> Dashboard
                                        </a>
                                    </div>
                                    <div class="dropdown-item dark:text-gray-100">
                                        <a class="px-3 py-2 hover:bg-gray-50/50 block dark:hover:bg-zinc-700/50 prose !no-underline"
                                            href="{{ route('dashboard.profile') }}">
                                            <i class="mdi mdi-face-man text-16 align-middle mr-1"></i> Profile
                                        </a>
                                    </div>
                                    <hr class="border-gray-50 dark:border-gray-700">
                                    <div class="dropdown-item dark:text-gray-100">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        <a class="p-3 hover:bg-gray-50/50 block dark:hover:bg-zinc-700/50 prose !no-underline"
                                            href="{{ route('logout')}}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="mdi mdi-logout text-16 align-middle mr-1"></i> Logout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @else
                <li class="box-border hidden md:block"><a href="{{ route('login') }}" class="!no-underline prose hover:text-white hover:bg-sky-800 hover:border-none text-sky-700 py-3 px-6 rounded border border-sky-700">Masuk</a></li>
                <li class="hidden md:block"><a href="{{ route('register') }}"
                        class="!no-underline prose bg-sky-800 text-white py-3 px-6 rounded hover:bg-sky-700 hover:text-white">Mulai belajar</a>
                </li>
                @endif
            </ul>
        </div>
        @guest
        <div class="dropdown relative md:hidden">
            <button type="button"
                class="btn py-2.5 dropdown-toggle shadow-md shadow-gray-100 dark:shadow-zinc-600 border bg-sky-800 border-gray-500 text-white text-xl leading-tight"
                id="menumobile" data-bs-toggle="dropdown"><i class="bx bx-menu-alt-right"></i></button>

            <ul class="dropdown-menu min-w-max absolute bg-white z-50 pt-2 pb-4 px-4 list-none text-left mt-1 rounded-lg shadow-lg bg-clip-padding border-none dark:bg-zinc-700 hidden"
                aria-labelledby="menumobile"
                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);"
                data-popper-placement="bottom-start">
                <li><a href="{{ route('home') }}" class="!no-underline prose hover:text-black dropdown-item py-2 block w-full whitespace-nowrap" >Home</a></li>
                <li><a href="#" class="!no-underline prose hover:text-black dropdown-item py-2 block w-full whitespace-nowrap">Instructors</a></li>
                <li><a href="#" class="!no-underline prose hover:text-black dropdown-item py-2 block w-full whitespace-nowrap">Categories</a></li>
                <li><a href="{{ route('courses') }}" class="!no-underline prose hover:text-black dropdown-item py-2 block w-full whitespace-nowrap mb-4">Courses</a></li>
                <li class="box-border hover:text-white hover:bg-sky-800 hover:border-none text-sky-700 rounded border border-sky-700  py-2 px-4 mb-2"><a href="{{ route('login') }}"
                        class="!no-underline prose">Masuk</a>
                </li>
                <li class="bg-sky-800 py-3 px-6 rounded hover:bg-sky-700 hover:text-white"><a href="{{ route('register') }}" class="text-white !no-underline prose">Mulai belajar</a>
                </li>
            </ul>
        </div>
        @endguest
    </div>
</nav>
