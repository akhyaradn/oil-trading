<label for="">Publish</label>
<br>
<input type="checkbox" name="flag_active" {{$news && $news['flag_active'] == 1 ? 'checked' : '' }} class="js-switch"/>

@push('script')
<script>
    switch_element = document.querySelector('.js-switch');
    new Switchery(switch_element, $(this).data());
</script>
@endpush