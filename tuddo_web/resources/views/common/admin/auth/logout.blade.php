@extends('common.admin.layout.base')

@section('scripts')
@parent
<script>

$.ajax({
        type:"POST",
        url: getBaseUrl() + "/admin/logout",
        headers: {
            Authorization: "Bearer " + getToken("admin")
        },
        beforeSend: function() {
            showLoader();
        },
        success:function(data){
            hideLoader();
			removeStorage('admin');
            window.location.replace("{{ url('/admin/login') }}");
        }, 
        error: (jqXHR, textStatus, errorThrown) => {
            hideLoader();
            removeStorage('admin');
            window.location.replace("{{ url('/admin/login') }}");
        }
    });

</script>
@stop