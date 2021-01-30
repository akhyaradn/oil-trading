<label for="input-file-now">Image</label>
<input type="file" name="img" id="newsimg" class="dropify" data-default-file="{{$news ? asset('img_cover/'.$news->img) : '' }}"/>
<input type="hidden" name="status_img" id="status-img" value="{{$news ? 1 : 0 }}">

@push('script')
<script type="text/javascript">
    $(document).ready(function(){
        evt = $('.dropify').dropify();
        evt.on('dropify.afterClear', function(event, element){
            $("#status-img").val(0);
        });
    });
</script>
@endpush