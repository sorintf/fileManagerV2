$(document).ready(function() {
    tinymce.init({
        height: '400',
        selector: '.txt-tinymce',
        content_style: 'body { font-family: inherit; }',
        menubar: false,
        toolbar: [
            'styleselect fontsizeselect',
            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
            'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | code'
            ],
        plugins: 'advlist autolink link image lists charmap code'
    });
});
