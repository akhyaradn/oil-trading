<label for="input-file-now">News image cover</label>
<input type="file" name="img" id="newsimg" class="dropify"/>

@push('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.dropify').dropify();
    });
</script>
@endpush