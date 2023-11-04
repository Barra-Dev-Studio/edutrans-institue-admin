<nav class="bg-slate-200 px-4">
    <div class="flex items-center justify-between px-8">
        <div class="flex items-center gap-4 prose">
            <a class="text-lg font-semibold !no-underline">Edutrans Intitute</a>
        </div>
        <div class="">
            <ul class="flex gap-8 items-center list-none">
                <li><a href="#" class="!no-underline prose hover:font-semibold">Home</a></li>
                <li><a href="#" class="!no-underline prose hover:font-semibold">My course</a></li>
                <li><a href="#" class="!no-underline prose hover:font-semibold">My transaction</a></li>
                <li>
                    <div>
                        <div class="dropdown relative">
                            <button type="button"
                                class="flex items-center px-4 py-5 dropdown-toggle dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100"
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
            </ul>
        </div>
    </div>
</nav>
