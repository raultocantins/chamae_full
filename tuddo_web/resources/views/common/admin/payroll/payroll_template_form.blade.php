{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'pt'  ) }}

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card-header border-bottom">
            @if(empty($id))
                @php($action_text=__('admin.add'))
            @else
                @php($action_text=__('admin.edit'))

            @endif
            <h6 class="m-0" style="margin:10!important;"> {{$action_text}} {{ __('Payroll Template') }}</h6>
        </div>
        <div class="form_pad">
            <form class="validateForm" files="true">
                @csrf()
                @if(!empty($id))
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="{{$id}}">
                @endif




                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city_id">{{ __('admin.zone_name') }}</label>
                        <select name="zone_id" id="zone_id" class="form-control">
						</select>
                    </div>
                </div>

                 <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name">{{ __('admin.name') }}</label>
                        <input type="text" class="form-control" id="template_name" name="template_name" placeholder="Name" value="" autocomplete="off">
                    </div>

                </div>



                <br>
                <button type="submit" class="btn btn-accent">{{$action_text}} {{ __('Payroll Template') }}</button>
                <button type="reset" class="btn btn-danger cancel">Cancel</button>

            </form>
        </div>
    </div>
</div>

<script>



$(document).ready(function()
{

    basicFunctions();


    var id = "";


        $.ajax({
            type:"GET",
            url: getBaseUrl() + "/admin/zone",
            headers: {
                Authorization: "Bearer " + getToken("admin")
            },
            'beforeSend': function (request) {
                showInlineLoader();
            },
            success:function(response){
                var data = parseData(response);
                $("#zone_id").empty();
                $("#zone_id").append('<option>Select</option>');
                $.each(data.responseData.data,function(key,item){
                    $("#zone_id").append('<option value="'+item.id+'">'+item.name+'</option>');
                });

                hideInlineLoader();
            }
        });


    if($("input[name=id]").length){

        id = "/" +$("input[name=id]").val();
        var url = getBaseUrl() + "/admin/payroll-template"+id;
        setData( url );
    }


    $('.validateForm').validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		rules: {
            name: { required: true },
            country_id: { required: true },
            city_id: { required: true },
		},

		messages: {
			name: { required: "Template name is required." },
            zone_id: { required: "Zone is required." }
		},

		highlight: function(element)
		{
			$(element).closest('.form-group').addClass('has-error');

		},

		success: function(label) {
			label.closest('.form-group').removeClass('has-error');
			label.remove();
            $('.selected-flag').css('height','100%');
		},

		submitHandler: function(form) {

            var formGroup = $(".validateForm").serialize().split("&");

            var data = new FormData();

            for(var i in formGroup) {
                var params = formGroup[i].split("=");
                data.append( params[0], decodeURIComponent(params[1]) );
            }

            var url = getBaseUrl() + "/admin/payroll-template"+id;

            saveRow( url, table, data);

		}
    });

    $('.cancel').on('click', function(){
        $(".crud-modal").modal("hide");
    });

});
</script>
