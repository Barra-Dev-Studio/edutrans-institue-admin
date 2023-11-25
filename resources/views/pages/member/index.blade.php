<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @if($lastChapter !== null)
            <a href="{{ route('member.play', [$lastChapter->course_id, $lastChapter->chapter_id]) }}">
                <div class="card bg-white cursor-pointer hover:bg-slate-50">
                    <div class="card-body flex flex-col justify-between h-full">
                        <div>
                            <div class="grid grid-cols-1 gap-5 items-center">
                                <div>
                                    <span class="text-gray-700 dark:text-zinc-100">Lanjutkan kursus</span>
                                    <h4 class="mt-4 text-xl text-gray-800 dark:text-gray-100 ">{{ $lastChapter->chapter_title }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <span class="text-gray-700 text-13 dark:text-zinc-100">{{ $lastChapter->course_title }}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endif
            <div class="card bg-white cursor-pointer hover:bg-slate-50">
                <div class="card-body flex flex-col justify-between h-full">
                    <div>
                        <div class="grid grid-cols-1 gap-5 items-center">
                            <div>
                                <span class="text-gray-700 dark:text-zinc-100">Total kursus</span>
                                <h4 class="mt-4 text-xl text-gray-800 dark:text-gray-100 ">{{ number_format($ownedCourse) }} Kursus</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center mt-4">
                        <span class="text-gray-700 text-13 dark:text-zinc-100">Total kursus yang dimiliki</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="border border-slate-200 p-4 mb-8 bg-slate-50">
        <livewire:pages.member.course-livewire></livewire:pages.member.course-livewire>
    </div>
</x-app-layout>
