<table class="table table-bordered table-striped" id="data-table-message">
    <thead>
        <tr>
            <th class="text-left" width="5%">#</th>
            <th class="text-left" width="10%">Name</th>
            <th class="text-left" width="10%">Company</th>
            <th class="text-left" width="55%">Message</th>
            <th class="text-left" width="10%">Date</th>
            <th class="text-left" width="10%">Action</th>
        </tr>
    </thead>
</table>
<input type="hidden" id="datatableflag" value="{{$datatable_flag && $datatable_flag == 'trash' ? 0 : 1}}">

@push('script')
<script>
$("table[id='data-table-message']").DataTable({
    "ordering": false,
    "processing": true,
    "serverSide": true,
    "ajax":{
                "url": "{{ route('datatableContactUs') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ 
                    'flag': $("#datatableflag").val(),
                    _token: "{{csrf_token()}}"
                }
            },
    "columns": [
        { "data": "no" },
        { "data": "nama" },
        { "data": "company_name" },
        { "data": "message" },
        { "data": "date" },
        { "data": "detail" }
    ]
});
</script>
@endpush
