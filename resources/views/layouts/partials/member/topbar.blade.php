<nav class="md:px-16">
    <div class="flex items-center justify-between px-6 md:px-8 py-6 md:py-0">
        <div class="flex items-center gap-4 prose">
            <a href="{{ route('home') }}" class="text-lg font-semibold !no-underline">Edutrans Intitute</a>
        </div>
        <div class="py-5 hidden md:block">
            <ul class="flex gap-8 items-center list-none">
                <li><a href="{{ route('home') }}" class="!no-underline prose hover:text-black">Home</a></li>
                <li><a href="#" class="!no-underline prose hover:text-black">Instructors</a></li>
                <li><a href="#" class="!no-underline prose hover:text-black">Categories</a></li>
                <li><a href="{{ route('courses') }}" class="!no-underline prose hover:text-black">Courses</a></li>
            </ul>
        </div>
        <div class="py-5 hidden md:block">
            <ul class="flex gap-2 items-center list-none">
                @if(Auth()->user())
                <li><a href="#" class="!no-underline prose hover:text-black text-xl"><i class="bx bx-cart-alt"></i></a></li>
                <li>
                    <div>
                        <div class="dropdown relative">
                            <button type="button"
                                class="flex items-center px-4 dropdown-toggle dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100"
                                id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <img class="h-8 w-8 rounded-full ltr:xl:mr-2"
                                    src="https://ui-avatars.com/api/?background=random&name={{ \Str::slug(\Auth()->user()->name) }}"
                                    alt="Header Avatar">
                                <span class="fw-medium hidden xl:block prose">{{ \Auth()->user()->name }}</span>
                                <i class="mdi mdi-chevron-down align-bottom hidden xl:block"></i>
                            </button>
                            <div class="dropdown-menu absolute top-0 ltr:-left-3 z-50 hidden w-40 list-none rounded bg-white shadow dark:bg-zinc-800"
                                id="profile/log">
                                <div class="border border-gray-50 dark:border-zinc-600" aria-labelledby="navNotifications">
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
                <li class="box-border"><a href="{{ route('login') }}" class="!no-underline prose hover:text-white hover:bg-sky-800 hover:border-none text-sky-700 py-3 px-6 rounded border border-sky-700">Masuk</a></li>
                <li><a href="{{ route('register') }}"
                        class="!no-underline prose bg-sky-800 text-white py-3 px-6 rounded hover:bg-sky-700 hover:text-white">Mulai belajar</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
