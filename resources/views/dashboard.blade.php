<x-app-layout>
  <x-breadcrumb>
    <x-slot name="title">Dashboard</x-slot>
  </x-breadcrumb>

  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
    <div class="card bg-white">
        <div class="card-body flex flex-col justify-between h-full">
            <div>
                <div class="grid grid-cols-1 gap-5 items-center">
                    <div>
                        <span class="text-gray-700 dark:text-zinc-100">Total kursus aktif</span>
                        <h4 class="mt-4 text-xl text-gray-800 dark:text-gray-100 ">{{ number_format($widgets['course'][0]) }} Kursus
                        </h4>
                    </div>
                </div>
            </div>
            <div class="flex items-center mt-4 prose">
                <span class="text-gray-700 text-13 dark:text-zinc-100">Dari total {{ number_format($widgets['course'][1]) }} kursus</span>
            </div>
        </div>
    </div>
    <div class="card bg-white">
        <div class="card-body flex flex-col justify-between h-full">
            <div>
                <div class="grid grid-cols-1 gap-5 items-center">
                    <div>
                        <span class="text-gray-700 dark:text-zinc-100">Total member aktif</span>
                        <h4 class="mt-4 text-xl text-gray-800 dark:text-gray-100 ">{{ number_format($widgets['user'][0]) }} Member
                        </h4>
                    </div>
                </div>
            </div>
            <div class="flex items-center mt-4 prose">
                <span class="text-gray-700 text-13 dark:text-zinc-100">Dari total {{ number_format($widgets['user'][1]) }} member</span>
            </div>
        </div>
    </div>
    <div class="card bg-white">
        <div class="card-body flex flex-col justify-between h-full">
            <div>
                <div class="grid grid-cols-1 gap-5 items-center">
                    <div>
                        <span class="text-gray-700 dark:text-zinc-100">Total transaksi berhasil</span>
                        <h4 class="mt-4 text-xl text-gray-800 dark:text-gray-100 ">{{ number_format($widgets['transaction'][0]) }} Transaksi
                        </h4>
                    </div>
                </div>
            </div>
            <div class="flex items-center mt-4 prose">
                <span class="text-gray-700 text-13 dark:text-zinc-100">Dari total {{ number_format($widgets['transaction'][1]) }} transaksi. Lihat detail transaksi <a href="{{ route('dashboard.transaction.index') }}">disini</a></span>
            </div>
        </div>
    </div>
    <div class="card bg-white">
        <div class="card-body flex flex-col justify-between h-full">
            <div>
                <div class="grid grid-cols-1 gap-5 items-center">
                    <div>
                        <span class="text-gray-700 dark:text-zinc-100">Total post diterbitkan</span>
                        <h4 class="mt-4 text-xl text-gray-800 dark:text-gray-100 ">{{ number_format($widgets['post'][0]) }} Post
                        </h4>
                    </div>
                </div>
            </div>
            <div class="flex items-center mt-4 prose">
                <span class="text-gray-700 text-13 dark:text-zinc-100">Dari {{ number_format($widgets['post'][1]) }} post. Lihat detail blog <a href="{{ route('dashboard.post.index') }}">disini</a></span>
            </div>
        </div>
    </div>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
    <div class="card bg-white">
        <div class="card-body flex items-center justify-between h-full">
            <div class="flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 428 389.11">
                    <circle cx="214.15" cy="181" r="171" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="20">
                    </circle>
                    <path
                        d="M413 134.11H15.29a15 15 0 0 0-15 15v15.3C.12 168 0 171.52 0 175.11c0 118.19 95.81 214 214 214 116.4 0 211.1-92.94 213.93-208.67 0-.44.07-.88.07-1.33v-30a15 15 0 0 0-15-15Z">
                    </path>
                </svg>
                <span class="text-gray-700 dark:text-zinc-100">Analytics by Umami</span>
            </div>
            <div>
                <a target="_blank" href="https://analytics.eu.umami.is/websites/690e8481-ce7b-4556-bba7-b5e9fe0ef587" class="border rounded px-6 py-2 flex gap-2 items-center hover:bg-slate-50 cursor-pointer"><i class="bx bx-link-external"></i> <span>View</span></a>
            </div>
        </div>
    </div>
  </div>
</x-app-layout>
