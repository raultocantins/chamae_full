{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'pt'  ) }}
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card-header border-bottom">
			@if(empty($id))
                @php($action_text=__('admin.add'))
            @else
                @php($action_text=__('admin.edit'))

            @endif
            <h6 class="m-0"style="margin:10!important;">{{$action_text}} {{ __('Custom Push') }}</h6>
        </div>
        <div class="form_pad">
            <form class="validateForm" method="POST" role="form" id="create_push">
                @csrf()
                @if(!empty($id))
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="{{$id}}">
                @endif

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="col-xs-2 col-form-label">{{ __('admin.push.Sent_to') }}</label>
						<div class="col-xs-10">
							<select class="form-control" name="send_to" onchange="switch_send(this.value)">
								<option value="ALL">{{ __('admin.push.all') }}</option>
								<option value="USERS">{{ __('admin.push.all_users') }}</option>
								<option value="PROVIDERS">{{ __('admin.push.all_providers') }}</option>
							</select>
						</div>
                    </div>
                </div>
                <div class="form-row">
                     <div class="form-group row" id="for_users" style="display: none;">
						<label class="form-group col-md-12 col-form-label">{{ __('admin.push.Condition') }}</label>
						<div class="form-group col-md-6">
							<select class="form-control" name="user_condition" onchange="switch_user_condition(this.value);">
								<option value="">{{ __('admin.push.none') }}</option>
								<option value="ACTIVE">{{ __('admin.push.who_active') }}</option>
								<option value="LOCATION">{{ __('admin.push.who_in') }}</option>
								<option value="RIDES">{{ __('admin.push.who_most') }}</option>
								<!-- <option value="AMOUNT"> who spent more than </option> -->
							</select>
						</div>
						<div class="form-group col-md-4" id="user_active" style="display: none;">
							<select class="form-control" name="user_active">
								<option value="HOUR">{{ __('admin.push.last_hour') }}</option>
								<option value="WEEK">{{ __('admin.push.last_week') }}</option>
								<option value="MONTH">{{ __('admin.push.last_month') }}</option>
							</select>
						</div>

						<div class="form-group col-md-4" id="user_rides"  style="display: none;">
							<input type="number" class="form-control" name="user_rides" placeholder="{{ __('admin.push.rides') }}">
						</div>

						<div class="form-group col-md-4" id="user_amount" style="display: none;">
							<input type="number" class="form-control" name="user_amount" placeholder="Amount Spent">
						</div>

						<div class="form-group col-md-4" id="location_group_user" style="display: none;">
							<input type="text" class="form-control"  name="user_search_location" id="user_search_location" placeholder="{{ __('admin.push.location') }}">
                            {{ __('admin.push.in_radius') }}
                            <input type="number" class="form-control"  name="search_radius_user" id="search_radius_user" placeholder="km">Km
							<input type="hidden" name="user_location" id="user_location">
						</div>

					</div>
                </div>
                <div class="form-row">
                    <div class="form-group row" id="for_providers" style="display: none;">
						<label class="form-group col-md-12 col-form-label">{{ __('admin.push.Condition') }}</label>
						<div class="col-md-6">
							<select class="form-control" name="provider_condition" onchange="switch_provider_condition(this.value);">
								<option value="">{{ __('admin.push.none') }}</option>
								<option value="ACTIVE">{{ __('admin.push.who_active') }}</option>
								<option value="LOCATION">{{ __('admin.push.who_in') }}</option>
								<option value="RIDES">{{ __('admin.push.who_most') }}</option>
								<!-- <option value="AMOUNT">  who earned more than </option> -->
							</select>
						</div>
						<div class="form-group col-md-4" id="provider_active" style="display: none;">
							<select class="form-control" name="provider_active">
								<option value="HOUR">{{ __('admin.push.last_hour') }}</option>
								<option value="WEEK">{{ __('admin.push.last_week') }}</option>
								<option value="MONTH">{{ __('admin.push.last_month') }}</option>
							</select>
						</div>

						<div class="form-group col-md-4" id="provider_rides"  style="display: none;">
							<input type="number" class="form-control" name="provider_rides" placeholder="{{ __('admin.push.rides') }}">
						</div>

						<div class="form-group col-md-4" id="provider_amount" style="display: none;">
							<input type="number" class="form-control" name="provider_amount" placeholder="Amount Spent">
						</div>

						<div class="form-group col-md-4" id="location_group_provider" style="display: none;">
							<input type="text" class="form-control" name="provider_search_location" id="provider_search_location" placeholder="{{ __('admin.push.location') }}">
                            {{ __('admin.push.in_radius') }}
							<input type="number" class="form-control"  name="search_radius_provider" id="search_radius_provider" placeholder="km">Km
                            <input type="hidden" name="provider_location" id="provider_location">
						</div>

					</div>
				</div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="message" class="col-xs-2 col-form-label">{{ __('admin.push.message') }}</label>
						<div class="col-xs-10">
							<textarea maxlength="200" class="form-control" rows="3" name="message" required id="message" placeholder="{{ __('admin.push.enter_message') }}" ></textarea>
							<div id="characterLeftDesc"></div>
						</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <!-- <label for="zipcode" class="col-xs-2 col-form-label"></label> -->
						<div class="col-xs-12">

							<button type="submit" class="btn btn-primary">{{ __('admin.push.Push_Now') }}</button>
							&nbsp;
							<button data-toggle="modal" data-target="#schedule_modal" type="button" class="btn btn-success">{{ __('admin.push.Schedule_Push') }}</button>
						   <button type="reset" class="btn btn-danger cancel pull-right">Cancel</button>
						</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    </div>
                </div>
                <br>
                <!-- <button type="reset" class="btn btn-danger cancel">Cancel</button>
                <button type="submit" class="btn btn-accent float-right">Add CustomPush</button> -->
     <!-- Schedule Modal -->
		<div id="schedule_modal" class="modal fade schedule-modal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close schedule_close">&times;</button>
				<h4 class="modal-title">{{ __('Schedule Push Notification') }}</h4>
			</div>
			<form>
				<div class="modal-body">

					<label>{{__('Date')}}</label>
					<input value="" class="form-control" type="text" id="datepicker" placeholder="" name="schedule_date">
					<label>{{ __('Time')}}</label>
					<input value="" class="form-control" type="text" id="timepicker" placeholder="" name="schedule_time">

				</div>
				<div class="modal-footer">
					<button type="reset" class="btn btn-danger schedule_close">{{ __('Cancel')}}</button>
					<button type="button" id="schedule_button" class="btn btn-default">{{ __('Schedule') }}</button>
				</div>
			</form>
			</div>

		</div>
		</div>
  </div>
</div>
<style type="text/css">
	.pac-container{
		z-index: 99999999999!important;
	}
</style>
<script>
		function switch_send(send_value){
			if(send_value == 'USERS'){
				$('#for_users').show();
				$('#for_providers').hide();
			}else if(send_value == 'PROVIDERS'){
				$('#for_users').hide();
				$('#for_providers').show();
			}else{
				$('#for_users').hide();
				$('#for_providers').hide();
			}
		}
		function switch_user_condition(condition_value){
			if(condition_value == 'ACTIVE'){
				$('#user_active').show();
				$('#location_group_user').hide();
				$('#user_amount').hide();
				$('#user_rides').hide();
			}else if(condition_value == 'LOCATION'){
				$('#user_active').hide();
				$('#location_group_user').show();
				$('#user_amount').hide();
				$('#user_rides').hide();
			}else if(condition_value == 'AMOUNT'){
				$('#user_active').hide();
				$('#location_group_user').hide();
				$('#user_amount').show();
				$('#user_rides').hide();
			}else if(condition_value == 'RIDES'){
				$('#user_active').hide();
				$('#location_group_user').hide();
				$('#user_amount').hide();
				$('#user_rides').show();
			}else{
				$('#user_active').hide();
				$('#location_group_user').hide();
				$('#user_amount').hide();
				$('#user_rides').hide();
			}
		}
		function switch_provider_condition(condition_value){
			if(condition_value == 'ACTIVE'){
				$('#provider_active').show();
				$('#location_group_provider').hide();
				$('#provider_amount').hide();
				$('#provider_rides').hide();
			}else if(condition_value == 'LOCATION'){
				$('#provider_active').hide();
				$('#location_group_provider').show();
				$('#provider_amount').hide();
				$('#provider_rides').hide();
			}else if(condition_value == 'AMOUNT'){
				$('#provider_active').hide();
				$('#location_group_provider').hide();
				$('#provider_amount').show();
				$('#provider_rides').hide();
			}else if(condition_value == 'RIDES'){
				$('#provider_active').hide();
				$('#location_group_provider').hide();
				$('#provider_amount').hide();
				$('#provider_rides').show();
			}else{
				$('#provider_active').hide();
				$('#location_group_provider').hide();
				$('#provider_amount').hide();
				$('#provider_rides').hide();
			}
		}
		$('#schedule_button').click(function(){
			$("#schedule_modal").modal("hide");
                $("#datepicker").clone().attr('type','hidden').appendTo($('#create_push'));
                $("#timepicker").clone().attr('type','hidden').appendTo($('#create_push'));
                //document.getElementById('create_push').submit();
					var formGroup = $(".validateForm").serialize().split("&");
					var data = new FormData();
					for(var i in formGroup) {
						var params = formGroup[i].split("=");
						data.append( params[0], decodeURIComponent(params[1]) );
					}
					var url = getBaseUrl() + "/admin/custompush";
					saveRow( url, table, data);


        });
		var date = new Date();
        date.setDate(date.getDate()-1);
        $('#datepicker').datepicker({
            startDate: date
        });
        $('#timepicker').timepicker({showMeridian : false});


$(document).ready(function()
{

	basicFunctions();



    $('#characterLeftDesc').text('100');

	$('#message').keyup(function () {
	    var max = 100;
	    var len = $(this).val().length;
	    if (len >= max) {
	        $('#characterLeftDesc').text('-');
	    } else {
	        var ch = max - len;
	        $('#characterLeftDesc').text(ch + '');
	    }
	});
	 var id = "";

     if($("input[name=id]").length){
        id = "/"+ $("input[name=id]").val();
        var url = "{{env('BASE_URL')}}/admin/custompush"+id;
        setData( url );
     }
     $('.validateForm').validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		rules: {
            user_condition: { required: true },
			provider_condition: { required: true },
            message: { required: true },
		},

		messages: {
			user_condition: { required: "User Condition is required." },
			provider_condition: { required: "Provider Condition is required." },
			content: { required: "Message is required." },
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
            var url = getBaseUrl() + "/admin/custompush"+id;
            saveRow( url, table, data);

        }
    });

    $('.cancel').on('click', function(){
        $(".crud-modal").modal("hide");
		location.reload();
	});

	$('.schedule_close').on('click', function(){
        $("#schedule_modal").modal("hide");

    });

});


var autocomplete, autocompleteprovider;

    function initAutocomplete() {

        autocomplete = new google.maps.places.Autocomplete(document.getElementById('user_search_location'));
        autocompleteprovider = new google.maps.places.Autocomplete(document.getElementById('provider_search_location'));

        autocomplete.addListener('place_changed', function(){
            var place = autocomplete.getPlace().geometry.location;
            set_location_to_user(place.lat(),place.lng());
        });

        autocompleteprovider.addListener('place_changed', function(){
            var providerplace = autocompleteprovider.getPlace().geometry.location;
            set_location_to_provider(providerplace.lat(),providerplace.lng());
        });

    }

    function set_location_to_user(lat,lng){
        document.getElementById('user_location').value = lat+','+lng;
    }

    function set_location_to_provider(lat,lng){
        document.getElementById('provider_location').value = lat+','+lng;
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{Helper::getSettings()->site->browser_key}}&libraries=places&callback=initAutocomplete" async defer></script>
