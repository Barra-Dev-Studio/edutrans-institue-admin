<div class="rounded overflow-hidden">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/plyr-theme.css') }}" />
    <video id="{{ $id }}" playsinline controls data-poster="/path/to/poster.jpg">
        <source src="{{ $embedId }}" type="video/mp4" />
    </video>
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            const plyr = new Plyr('#{{ $id }}', {
                autoplay: @this.autoplay,
            })
        })
    </script>
</div>
