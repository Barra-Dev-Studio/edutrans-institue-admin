<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu rtl:right-0 fixed ltr:left-0 bottom-0 top-16 h-screen border-r bg-slate-50 border-gray-50 print:hidden dark:bg-zinc-800 dark:border-neutral-700 z-10">
    <div data-simplebar class="h-full">
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-heading px-4 py-3.5 text-xs font-medium text-gray-500 cursor-default" data-key="t-menu">Menu</li>
                @can("access-admin")
                    <li>
                        <a href="{{ route('dashboard.index') }}" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="home"></i>
                            <span data-key="t-dashboard" class="prose"> Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-heading px-4 py-3 text-xs font-medium text-gray-500 cursor-default" data-key="t-elements">Courses</li>
                    <li>
                        <a href="{{ route('dashboard.course.index') }}" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="book"></i>
                            <span data-key="t-course" class="prose"> Course</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.mentor.index') }}" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="users"></i>
                            <span data-key="t-mentor" class="prose"> Mentor</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.category.index') }}" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="list"></i>
                            <span data-key="t-category" class="prose"> Course Categories</span>
                        </a>
                    </li>
                    <li class="menu-heading px-4 py-3 text-xs font-medium text-gray-500 cursor-default" data-key="t-elements">Transactions</li>
                    <li>
                        <a href="{{ route('dashboard.transaction.index') }}" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="shopping-cart"></i>
                            <span data-key="t-transaction" class="prose"> Transactions</span>
                        </a>
                    </li>
                    <li class="menu-heading px-4 py-3 text-xs font-medium text-gray-500 cursor-default" data-key="t-elements">Blog & Post</li>
                    <li>
                        <a href="{{ route('dashboard.post.index') }}" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="clipboard"></i>
                            <span data-key="t-post" class="prose"> Posts</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.categorypost.index') }}" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="list"></i>
                            <span data-key="t-categorypost" class="prose"> Post Categories</span>
                        </a>
                    </li>
                    <li class="menu-heading px-4 py-3 text-xs font-medium text-gray-500 cursor-default" data-key="t-elements">Admin area</li>
                    <li>
                        <a href="{{ route('dashboard.user.index') }}" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="user"></i>
                            <span data-key="t-user" class="prose"> Users</span>
                        </a>
                    </li>
                @endcan
                @can("access-member")
                    <li>
                        <a href="{{ route('member.index') }}" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="home"></i>
                            <span data-key="t-dashboard" class="prose"> Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('member.transaction') }}" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="shopping-cart"></i>
                            <span data-key="t-transaction" class="prose"> Transactions</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
