@extends('common.user.layout.base')

@section('scripts')
@parent
<script>

$.ajax({
        type:"POST",
        url: getBaseUrl() + "/user/logout",
        headers: {
            Authorization: "Bearer " + getToken("user")
        },
        beforeSend: function() {
            showLoader();
        },
        success:function(data){
            hideLoader();
			removeStorage('user');
            window.location.replace("{{ url('/user/login') }}");
        }, 
        error: (jqXHR, textStatus, errorThrown) => {
            hideLoader();
            removeStorage('user');
            window.location.replace("{{ url('/user/login') }}");
        }
    });

</script>
@stop
