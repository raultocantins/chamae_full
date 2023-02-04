{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'pt'  ) }}
<div class="row mb-4 mt-20">
    <div class="col-md-12">
        <div class="card-header border-bottom">
            @if(empty($id))
                @php($action_text=__('admin.add'))
            @else
                @php($action_text=__('admin.edit'))

            @endif
            <h6 class="m-0"style="margin:10!important;">{{$action_text}} {{ __('Item') }}</h6>
        </div>
        <div class="form_pad">
        <form class="validateForm" files="true">
                @if(!empty($id))
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="{{$id}}">
                @endif
                <input type="hidden" name="store_id" value="{{$store_id}}">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="item_name">{{ __('store.admin.item.name') }}</label>
                        <input type="text" class="form-control" id="item_name" name="item_name" placeholder="{{ __('store.admin.item.name') }}" value="">
                    </div>
                    <div class="form-group col-md-6">
                     <label for="picture">{{ __('admin.picture') }}</label>
                        <div class="image-placeholder w-100">
                            <img width="100" height="100" />
                            <input type="file" name="picture" class="upload-btn picture_upload">
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="item_description">{{ __('store.admin.item.description') }}</label>
                        <textarea class="form-control" placeholder="{{ __('store.admin.item.description') }}" id="item_description" name="item_description"></textarea>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="item_discount_type">{{ __('store.admin.item.discount_type') }}</label>
                      <select class="form-control" name="item_discount_type">
                      <option value="PERCENTAGE">{{ __('store.admin.item.percentage') }}</option>
                      <option value="AMOUNT">{{ __('store.admin.item.amount') }}</option>
                      </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="store_category_description">{{ __('store.admin.item.category') }}</label>
                      <select class="form-control" name="store_category_id" id="store_category_id">
                      <option value="">Select</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                    <label for="item_price">{{ __('store.admin.item.price') }}</label>
                        <input type="number" class="form-control decimal" id="item_price" name="item_price" placeholder="{{ __('store.admin.item.price') }}" value="">
                    </div>

                </div>
                 <div class="form-row">
                <div class="form-group col-md-6">

                        <label for="item_discount">{{ __('store.admin.item.discount') }}</label>
                        <input type="number" class="form-control decimal" id="item_discount" name="item_discount" placeholder="{{ __('store.admin.item.discount') }}" value="">

                    </div>
                    <div id="is_veg" class="form-group col-md-6 d-none">
                    <label><input type="radio"  class="is_veg" value = "Pure Veg" name="is_veg"> {{ __('store.admin.shops.veg') }}</label>
                      <label><input type="radio" class="is_veg"value = "Non Veg" name="is_veg"> {{ __('store.admin.shops.nonveg') }}</label>
                    </div>
               </div>
             <div class="form-row">
                 <div class="form-group col-md-6">
					<label for="store_category_status" class="col-xs-2 col-form-label">{{ __('store.admin.cuisine.status') }}</label>
						<select name="store_category_status" class="form-control">
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
                    <div class="form-group col-md-6 addon_list">

                    </div>
				</div>

                <br>
                <button type="reset" class="btn btn-danger cancel">{{ __('Cancel') }}</button>
                <button type="submit" class="btn btn-accent float-right">{{$action_text}} {{ __('Item') }}</button>

            </form>
        </div>
    </div>
</div>



<script>
$(document).ready(function()
{

     basicFunctions();
     var id = "";

     var blobImage = '';
     var blobName = '';

     $('.picture_upload').on('change', function(e) {
      var files = e.target.files;
      var obj = $(this);
      if (files && files.length > 0) {
        blobName = files[0].name;
         cropImage(obj, files[0], obj.closest('.image-placeholder').find('img'), function(data) {
            blobImage = data;
         });
      }
    });

    $.ajax({
        type:"GET",
        url: getBaseUrl() + "/admin/store/addonslist/"+{{$store_id}},
        headers: {
            Authorization: "Bearer " + getToken("admin")
        },
        'beforeSend': function (request) {
                showInlineLoader();
            },
        success:function(data){
            console.log(data.responseData.length);
            if(data.responseData.length !=0){
               $('.addon_list').html(`<label for="addon_list">{{ __('store.admin.item.addon_list') }}</label><div>`);
               $.each(data.responseData,function(key,item){
                  $(".addon_list").append('<p><input type="checkbox" class="addon'+item.id+'" name="addon[]" value='+item.id+'>'+item.addon_name+'</p><p>{{ __('store.admin.item.price') }}</p><p><input type="number" class="form-control decimal addonprice'+item.id+'" name="addon_price['+item.id+']" value="0">');
               });
            }
                $('.addon_list').append(`</div>`);

                 hideInlineLoader();
        }

       });


    $.ajax({
        type:"GET",
        url: getBaseUrl() + "/admin/store/categorylist/"+{{$store_id}},
        headers: {
            Authorization: "Bearer " + getToken("admin")
        },
        'beforeSend': function (request) {
                showInlineLoader();
            },
        success:function(data){
                $("#store_category_id").empty();
                $("#store_category_id").append('<option value="">Select</option>');
                if(data.responseData.length != 0){
                    $.each(data.responseData,function(key,item){
                    $("#store_category_id").append('<option value="'+item.id+'">'+item.store_category_name+'</option>');

                    });
                    if(data.responseData[0].store.storetype.category =="FOOD"){
                        $('#is_veg').removeClass('d-none');
                     }else{
                        $("#is_veg").rules('remove', 'required');
                    }
                }

                hideInlineLoader();
             }

    });








     if($("input[name=id]").length){
        id = "/"+ $("input[name=id]").val();
        var url = getBaseUrl() + "/admin/store/items"+id;
        setTimeout(function(){
        $.ajax({
        type:"GET",
        url: url,
        headers: {
            Authorization: "Bearer " + getToken("admin")
        },
        'beforeSend': function (request) {
                showInlineLoader();
            },
        success:function(response){
            var data = parseData(response).responseData;
            for (var i in Object.keys(data)) {
            $('#'+Object.keys(data)[i]).val( Object.values(data)[i]);
             }
             $("input[name='is_veg'][value='"+data.is_veg +"']").prop('checked', true);

             if(data.picture){
                    $('.image-placeholder img').attr('src', data.picture);
              }
             if(data.itemsaddon.length !=0){
             $.each(data.itemsaddon,function(key,val){
             $('.addon'+val.store_addon_id).val(val.store_addon_id).attr('checked',true);
             $('.addonprice'+val.store_addon_id).val(val.price);
             });
             }
              hideInlineLoader();
             }
    });
}, 800);

     }



     $('.validateForm').validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		rules: {
            item_name: { required: true },
            store_category_id: { required: true },
            is_veg: { required: true },
            item_price: { required: true },

		},

		messages: {
			item_name: { required: "Item Name is required." },
			store_category_id: { required: "Category is required." },
			is_veg: { required: "Veg is required." },
			item_price: { required: " Price is required." },


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

            var data = new FormData();

            var formGroup = $(".validateForm").serialize().split("&");

            for(var i in formGroup) {
                var params = formGroup[i].split("=");
                data.append(decodeURIComponent(params[0]), decodeURIComponent(params[1]) );
            }

            if(blobImage != "") data.append('picture', blobImage, blobName);

            var url = getBaseUrl() + "/admin/store/items"+id;

            saveRow( url, table, data);

		}
    });

    $('.cancel').on('click', function(){
        $(".crud-modal").modal("hide");
    });


});
</script>
