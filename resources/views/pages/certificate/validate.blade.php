<x-guest-layout>
    <div class="md:p-16">
        <div class="flex justify-center flex-col px-6 md:px-8 mb-16 w-full">
            <div class="flex justify-center w-full">
                <img src="{{ asset('assets/images/logo.png') }}" class="mb-4" height="150" width="150" alt="">
            </div>
            <div class="w-full flex justify-center">
                <div class="card bg-white w-full md:w-[400px]">
                    <div class="card-body border-b border-slate-200 text-center">
                        <p class="text-lg">Certificate Number {{ $certificate->certificate_number }}</p>
                    </div>
                    <div class="card-body border-b border-slate-200">
                        <p class="text-lg prose">Issued to <span class="font-medium">{{ $certificate->member->name }}</span></p>
                        <p class="text-lg prose">for the achievements in completing the course entitled
                            <span class="italic">"{{ $certificate->ownedCourse->title }}"</span>
                            by Edutrans Institute
                        </p>
                    </div>
                    <div class="card-body">
                        <p class="text-lg">Last issued at {{ \Carbon\Carbon::parse($certificate->last_issued_at)->format('d-m-Y') }}</p>
                        <p class="text-lg">Valid until {{ \Carbon\Carbon::parse($certificate->last_issued_at)->addYear(1)->format('d-m-Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
