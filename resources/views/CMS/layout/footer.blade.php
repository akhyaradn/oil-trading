<script src="{{asset('CMS/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('CMS/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{asset('CMS/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
<!--slimscroll JavaScript -->
<script src="{{asset('CMS/js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('CMS/js/waves.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{asset('CMS/js/custom.min.js')}}"></script>
<!-- Custom tab JavaScript -->
<script src="{{asset('CMS/js/cbpFWTabs.js')}}"></script>
<!-- wysuhtml5 Plugin JavaScript -->
<script src="{{asset('CMS/plugins/bower_components/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
(function() {
    [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
        new CBPFWTabs(el);
    });
})();
</script>
<!-- jQuery file upload -->
<script src="{{asset('CMS/plugins/bower_components/dropify/dist/js/dropify.min.js')}}"></script>
<!-- Switchery -->
<script src="{{asset('CMS/plugins/bower_components/switchery/dist/switchery.min.js')}}"></script>

<script type="text/javascript">
function serializeInput(identifier) {
    var values = {};
    $.each($(identifier).serializeArray(), function(i, field) {
        values[field.name] = field.value;
    });
    return values;
}

function serializeInputArray(identifier) {
    var values = [];
    values = $(identifier).map(function(){
                return $(this).val();
            }).get();
    return values;
}
</script>