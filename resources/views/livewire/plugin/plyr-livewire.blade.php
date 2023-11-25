<div class="rounded overflow-hidden">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/plyr-theme.css') }}" />
    <div id="mediaPlayer" data-plyr-provider="youtube" data-plyr-embed-id="{{ $embedId }}"></div>
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script>
        const plyr = new Plyr('#mediaPlayer', {
            autoplay: true,
        })
    </script>
</div>
