
<h3 class="box-title m-b-0">News content</h3>
<textarea name="news" id="news-tinymce"></textarea>

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        tinymce.init({
            selector: "textarea#news-tinymce",
            theme: "modern",
            height: 300,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "save table contextmenu directionality emoticons template paste textcolor"
            ],
            menubar: false,
            toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | preview | forecolor backcolor",
        });
    });
</script>
@endsection