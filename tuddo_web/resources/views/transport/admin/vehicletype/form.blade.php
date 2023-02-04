{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'pt'  ) }}
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card-header border-bottom">
        @if(empty($id))
                @php($action_text=__('transport.admin.transporttype.add'))
            @else
                @php($action_text=__('transport.admin.transporttype.edit'))
            @endif
            <h6 class="m-0">{{$action_text}}</h6>
        </div>
        <div class="form_pad">
            <form class="validateForm">
                @csrf()
                @if(!empty($id))
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="{{$id}}">
                @endif

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="ride_name">{{ __('transport.admin.transporttype.ride_name') }}</label>
                        <input type="text" class="form-control" id="ride_name" name="ride_name" placeholder="ride name" value="" autocomplete="off">
                    </div>
                </div>
                <div class="form-row">
                @if(!empty($id))
                    <div class="form-group col-md-12">
    					<label for="notify_status" class="col-xs-2 col-form-label">{{ __('admin.status') }}</label>
    						<select name="status" class="form-control">
                            <option value="">select</option>
    							<option value="1">Active</option>
    							<option value="0">Inactive</option>
    						</select>
    					</div>
    				</div>
                @endif

                <button type="submit" class="btn btn-accent">{{$action_text}}</button>
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

     if($("input[name=id]").length){
        id = "/"+$("input[name=id]").val();
        var url = getBaseUrl() + "/admin/vehicletype"+id;
        setData( url );
     }

     $('.validateForm').validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		rules: {
            ride_name: { required: true },
            status: { required: true },
		},

		messages: {
			ride_name: { required: "Ride Name is required." },
            status: { required: "Status is required." },

		},
		highlight: function(element)
		{
			$(element).closest('.form-group').addClass('has-error');
		},
		success: function(label) {
			label.closest('.form-group').removeClass('has-error');
			label.remove();
		},

		submitHandler: function(form) {

            var formGroup = $(".validateForm").serialize().split("&");
            var data = new FormData();
            for(var i in formGroup) {
                var params = formGroup[i].split("=");
                data.append( params[0], decodeURIComponent(params[1]) );
            }
            var url = getBaseUrl() + "/admin/vehicletype"+id;
            saveRow( url, table, data);
		}
    });

    $('.cancel').on('click', function(){
        $(".crud-modal").modal("hide");
    });

});
</script>
