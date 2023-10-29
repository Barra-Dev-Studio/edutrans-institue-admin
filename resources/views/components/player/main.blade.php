@props(['playerPlaybackUrl'])
<div>
    <div id="mediaPlayer" class="rounded"></div>
    @push('js')
    <script>
        var player = new Playerjs({ id: "mediaPlayer", file: "{{ $playerPlaybackUrl }}" });
    </script>
    @endpush
</div>
