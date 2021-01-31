<table class="table table-bordered table-striped" id="data-table-news">
    <thead>
        <tr>
            <th class="text-left" width="5%">#</th>
            <th class="text-left" width="85%">Title</th>
            <th class="text-left" width="10%">Action</th>
        </tr>
    </thead>
</table>
<input type="hidden" id="datatableflag" value="{{$datatable_flag && $datatable_flag == 'draft' ? 0 : 1}}">

@push('script')
<script>
$("table[id='data-table-news']").DataTable({
    "ordering": false,
    "processing": true,
    "serverSide": true,
    "ajax":{
                "url": "{{ route('datatableNews') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ 
                    'flag': $("#datatableflag").val(),
                    _token: "{{csrf_token()}}"
                }
            },
    "columns": [
        { "data": "no" },
        { "data": "judul" },
        { "data": "detail" }
    ]
});
</script>
@endpush
