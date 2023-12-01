<x-app-layout>
  <x-breadcrumb>
    <x-slot name="title">Dashboard</x-slot>
  </x-breadcrumb>

  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
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
</x-app-layout>
