<div class="form-group">
    <label class="col-lg-1 control-label" for="example-input-normal">{{$label}}</label>
    <div class="input-group col-lg-11">
        <span class="input-group-addon" id="basic-addon1">Rp</span>
        <input type="text" class="form-control numeric" name="{{$name}}[]" onkeypress="allowOnlyNumbers(event)">
    </div>
</div>

@push('script')
<!-- Only accept numeric on mining, industry, shipping -->
<script>
function allowOnlyNumbers(event) {
    var value = $(event.target).val();

    if (
        event.key.length === 1 && 
        !/\d/.test(event.key)
    ) {
        event.preventDefault();
    }

    if(value.length <= 1 && event.key == 0) {
        event.preventDefault();
    }
}
</script>
@endpush