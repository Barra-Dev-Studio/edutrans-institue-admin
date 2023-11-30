<x-guest-layout>
    <div class="bg-sky-900 pt-16 md:px-16">
        <div class="px-6 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 items-end gap-8">
                <div class="col-span-2 pb-16 md:pb-12">
                    <p class="text-slate-300 mb-4 prose">Kategori {{ $course->category->name }}</p>
                    <h1 class="text-white text-5xl leading-snug">{{ $course->title }}</h1>
                    <div class="flex items-center gap-4 mt-4">
                        <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-zinc-500" src="{{ \Storage::url($course->mentor->photo) }}" alt="{{ $course->mentor->name }}">
                        <div>
                            <h5 class="text-white">{{ $course->mentor->name }}</h5>
                            <p class="text-slate-300">{{ $course->mentor->speciality }}</p>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="h-[250px] overflow-hidden">
                        <img src="{{ \Storage::url($course->thumbnail) }}" class="rounded-t h-full w-full" alt="{{ $course->title }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:pages.course.course-detail-livewire :$course :$previews :$chapters></livewire:pages.course.course-detail-livewire>
</x-guest-layout>
