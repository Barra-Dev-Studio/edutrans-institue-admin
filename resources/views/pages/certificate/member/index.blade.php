<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">My Certificate</x-slot>
        <x-breadcrumb-item>My Certificate</x-breadcrumb-item>
    </x-breadcrumb>
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Certificate</h5>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                @forelse($certificates as $certificate)
                    <a href="{{ route('member.certificate.download', $certificate->id) }}" data-tooltip-target="certificate-{{ $loop->iteration }}">
                        <div class="bg-white p-2 rounded cursor-pointer hover:border hover:border-slate-200 h-full">
                            <img src="{{ route('member.certificate.my', $certificate->id) }}" alt="{{ $certificate->title }}">
                            <h6 class="mt-4">{{ $certificate->title }}</h6>
                        </div>
                        <div id="certificate-{{ $loop->iteration }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Klik untuk download
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </a>
                @empty
                <span class="col-span-4 text-slate-600">Belum ada sertifikat yang bisa ditampilkan. Silakan selesaikan course bersertifikat untuk mendapatkan sertifikat. Sertifikat akan otomatis tampil jika sudah menyelesaikan course bersertifikat</span>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
