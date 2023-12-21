<div>
    <textarea wire:model.live="value" id="ckeditor" class="!text-left"></textarea>
    <script src="{{ asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            ClassicEditor
                .create(document.querySelector('#ckeditor'), {
                    language: 'en',
                    contentsLangDirection: 'ltr',
                    toolbar: {
                        items: [
                            'undo', 'redo',
                            '|', 'heading',
                            '|', 'bold', 'italic',
                            '|', 'link', 'insertTable', 'blockQuote',
                            '|', 'bulletedList', 'numberedList', 'outdent', 'indent'
                        ]
                    },
                })
                .then(function (editor) {
                    editor.model.document.on('change:data', () => {
                        @this.dispatch('{{ $this::EVENT_VALUE_UPDATED }}', {value: editor.getData()})
                    })
                })
                .catch( function(error) {
                    console.error( error );
                });
        });
    </script>
</div>
