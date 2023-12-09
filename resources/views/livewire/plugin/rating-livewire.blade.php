<div>
    <link rel="stylesheet" href="{{ asset('assets/css/star-rating-svg.css') }}">

    <div id="rating"></div>

    @push('js')
    <script src="{{ asset('assets/js/jquery.star-rating-svg.min.js') }}"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            $("#rating").starRating({
                starSize: 30,
                ratedColor: 'gold',
                initialRating: @this.value,
                callback: function(currentRating, $el){
                    @this.dispatch('rate-updated', {rating: currentRating})
                }
            });
        })
    </script>
    @endpush
</div>
