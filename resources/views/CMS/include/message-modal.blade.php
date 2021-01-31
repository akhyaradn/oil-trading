<div class="modal fade bs-example-modal-lg" id="message-detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Detail message</h4> </div>
            <div class="modal-body">
                    <div class="media m-b-30 p-t-20">
                        <h4><b id="nama"></b></h4>
                        <hr>
                        <div class="media-body"> <span class="media-meta pull-right" id="created_at"></span>                            
                            <h4 id="company_name" class="text-danger m-0"></h4>
                            <small style="color:black;" id="company_address" class="text-muted"></small><br>
                            <small style="color:black;" id="email" class="text-muted"></small><br>
                            <small style="color:black;" id="contact" class="text-muted"></small><br>
                        </div>
                    </div>
                    <p id="message"></p>
                    <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@push('script')
<script>
$("#message-detail").on("shown.bs.modal", function(e){
    nama = $(e.relatedTarget).data("nama");
    company_name = $(e.relatedTarget).data("company_name");
    company_address = $(e.relatedTarget).data("company_address");
    email = $(e.relatedTarget).data("email");
    message = $(e.relatedTarget).data("message");
    created_at = $(e.relatedTarget).data("created_at");
    contact = $(e.relatedTarget).data("contact");

    $("#nama").html(nama);
    $("#company_name").html(company_name);
    $("#company_address").html(company_address);
    $("#email").html(email);
    $("#message").html(message);
    $("#created_at").html(created_at);
    $("#contact").html(contact);
});
</script>
@endpush