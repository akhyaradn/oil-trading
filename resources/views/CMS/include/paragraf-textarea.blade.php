<div class="form-group">
    <div class="col-md-12">
        <label for="">{{$label}}</label>
        <textarea class="form-control" style="resize: none;" name="{{$name}}" id="" cols="30" rows="10">{{$product_service ? $product_service[$name] : ""}}</textarea>
    </div>
</div>