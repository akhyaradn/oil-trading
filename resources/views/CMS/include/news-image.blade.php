<label for="input-file-now">Image</label>
<input type="file" name="img" id="newsimg" class="dropify" data-default-file="{{$news ? asset('img_cover/'.$news->img) : '' }}"/>

@push('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.dropify').dropify();
    });
</script>
@endpush