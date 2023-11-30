<nav
    class="border-b border-slate-100 dark:bg-zinc-800 print:hidden flex items-center fixed top-0 right-0 left-0 bg-white z-10 dark:border-zinc-700">
    <div class="flex items-center justify-between w-full">
        <div class="topbar-brand flex items-center">
            <div
                class="navbar-brand flex items-center justify-between shrink pr-5 pl-6 h-[70px] border-r bg-slate-50 border-r-gray-50 dark:border-zinc-700 dark:bg-zinc-800">
                <a href="{{ url('/') }}" class="flex items-center font-bold  dark:text-white">
                    <img src="{{ asset('assets/images/logo.png') }}" class="inline-block h-6 mr-2" alt="Logo Edutrans Institute">
                    <span class="hidden xl:block align-middle">Edutrans Institute</span>
                </a>
            </div>
            <button type="button"
                class="text-gray-600 dark:text-white h-[70px] -ml-10 mr-6 vertical-menu-btn"
                id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>
        <div class="flex items-center">
            <div>
                <div class="dropdown relative ">
                    <div class="relative">
                        <button type="button"
                            class="btn border-0 h-[70px] dropdown-toggle px-4 text-gray-500 dark:text-gray-100"
                            aria-expanded="false" data-dropdown-toggle="notification">
                            <i data-feather="bell" class="h-5 w-5"></i>
                        </button>
                    </div>
                    <div class="dropdown-menu absolute z-50 hidden w-80 list-none rounded bg-white shadow dark:bg-zinc-800 "
                        id="notification">
                        <div class="border border-gray-50 dark:border-gray-700 rounded" aria-labelledby="notification">
                            <div class="grid grid-cols-12 p-4">
                                <div class="col-span-6">
                                    <h6 class="m-0 text-gray-700 dark:text-gray-100"> Notifications </h6>
                                </div>
                                <div class="col-span-6 justify-self-end">
                                    <a href="#!" class="text-xs underline dark:text-gray-400"> Unread (0)</a>
                                </div>
                            </div>
                            <div class="max-h-56" data-simplebar>
                                <div>
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="flex px-4 py-2 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50">
                                            <div class="flex-grow">
                                                <h6 class="mb-1 text-gray-700 dark:text-gray-100">Tidak ada notifikasi</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div>
                <div class="dropdown relative ltr:mr-4 rtl:ml-4">
                    <button type="button"
                        class="flex items-center px-4 py-5 dropdown-toggle dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100"
                        id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true">
                        <img class="h-8 w-8 rounded-full ltr:xl:mr-2 rtl:xl:ml-2"
                            src="https://ui-avatars.com/api/?background=random&name={{ \Str::slug(\Auth()->user()->name) }}"
                            alt="Header Avatar">
                        <span class="fw-medium hidden xl:block prose">{{ \Auth()->user()->name }}</span>
                        <i class="mdi mdi-chevron-down align-bottom hidden xl:block"></i>
                    </button>
                    <div class="dropdown-menu absolute top-0 md::-left-3 z-50 hidden w-40 list-none rounded bg-white shadow dark:bg-zinc-800"
                        id="profile/log">
                        <div class="border border-gray-50 dark:border-zinc-600" aria-labelledby="navNotifications">
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
        </div>
    </div>
</nav>
