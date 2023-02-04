{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'pt'  ) }}

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card-header border-bottom">
            @if(empty($id))
                @php($action_text=__('admin.add'))
            @else
                @php($action_text=__('admin.edit'))

            @endif
            <h6 class="m-0" style="margin:10!important;"> {{$action_text}} {{ __('Payroll') }}</h6>
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
                        <label for="city_id">{{ __('admin.template_name') }}</label>
                        <select name="template_id" id="template_id" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="single_service_error"></div>
                <div class="row">
                <table id="data-table-provider" class="table table-hover table_width display">
                <thead>
                    <tr>
                        <th><input type="checkbox" checked name="select_all" value="1" id="example-select-all"></th>
                        <th data-value="first_name">{{ __('admin.first_name') }}</th>
                        <th data-value="last_name">{{ __('admin.last_name') }}</th>
                        <th data-value="wallet_balance">{{ __('admin.users.Wallet_Amount') }}</th>
                        <!-- <th data-value="status">Status</th> -->
                        <th>{{ __('admin.action') }}</th>
                    </tr>
                 </thead>


                </table>
                </div>



                <br>
                <button type="submit" class="btn btn-accent">{{$action_text}} {{ __('Payroll') }}</button>
                <button type="reset" class="btn btn-danger cancel">{{ __('Cancel') }}</button>

            </form>
        </div>
    </div>
</div>
<script>
var poptableName = '#data-table-provider';
var poptable = $(poptableName);
var provider_list = [];

$(document).ready(function()
{


    @if(!empty($id))

    var id = '{{$id}}';
    @else

    var id = '';
    @endif
    var  template_id = 0;
      poptable = poptable.DataTable( {
        "processing": false,
        "serverSide": false,
                "data":provider_list,
                "columns": [
                    { "data": "id" ,
                    'searchable':false,
                    'orderable':false,
                    'className': 'dt-body-center',
                    render: function (data, type, row, meta) {
                       //return meta.row + meta.settings._iDisplayStart + 1;
                       return '<input type="checkbox" checked name="pid[]" value="' + $('<div/>').text(data).html() + '">';
                      }
                    },
                    { "data": "first_name" },
                    { "data": "last_name" },
                    { "data": "wallet_balance",render:function(data, type, row, meta){
                        //console.log(row.id);
                        return '<input class="form-control" id="wallet" name="wallet['+row.id+']" type="text"  value = ' + data + '  >';
                    }},
                    /*{ "data": "status" },*/
                    { "data": function (data, type, row) {

                        var button ='';
                        if({{Helper::getDemomode()}} != 1){
                         var button='<a href="javascript:;" data-id="'+data.id+'" class="dropdown-item popdelete"><i class="fa fa-trash"></i> Delete</a> ';
                        }
                         return  button;

                    }}

                ],
                responsive: false,
                paging:false,
                    info:false,
                    lengthChange:false,
                    dom: '',
                    buttons: [
                       /* 'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'*/
                    ],"drawCallback": function () {

                        var info = $(this).DataTable().page.info();
                        if (info.pages<=1) {
                           $('.dataTables_paginate').hide();
                           $('.dataTables_info').hide();
                        }else{
                            $('.dataTables_paginate').show();
                            $('.dataTables_info').show();
                        }
                    }
            });


      $('#template_id').on('change', function(){

        template_id =$("#template_id").val();
        var url = getBaseUrl() + "/admin/zoneprovider/"+template_id;


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
                //var provider_list = response.responseData;
                poptable.clear();
                poptable.rows.add(response.responseData).draw();
                hideInlineLoader();
            }
        });
    });


    $('#example-select-all').on('click', function(){
       // Get all rows with search applied
       var rows = poptable.rows({ 'search': 'applied' }).nodes();
       // Check/uncheck checkboxes for all rows in the table
       $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });


    $('body').on('click', '.popdelete', function() {

        poptable
        .row( $(this).parents('tr') )
        .remove()
        .draw();
    });

     $.ajax({
            type:"GET",
            url: getBaseUrl() + "/admin/payroll-template",
            headers: {
                Authorization: "Bearer " + getToken("admin")
            },
            'beforeSend': function (request) {
                showInlineLoader();
            },
            success:function(response){
                var data = parseData(response);
                $("#template_id").empty();
                $("#template_id").append('<option>Select</option>');
                $.each(data.responseData.data,function(key,item){
                    $("#template_id").append('<option value="'+item.id+'">'+item.template_name+'</option>');
                });

                hideInlineLoader();
            }
        });


    $('.validateForm').validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		rules: {
            'pid[]': { required: true, minlength: 1 },
            'wallet[]': { required: true, minlength: 1 },

		},

		messages: {
			'pid[]': { required: "checked atleast anyone checkbox" },
			'wallet[]': { required: "wallet is required." }
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

       errorPlacement: function(error, element) {
            //if ($("#checkboxes").has(element).size() > 0) {
                error.insertAfter($("#example-select-all"));
            //} else {
                //error.insertAfter(element);
            //}
        },

		submitHandler: function(form) {

            var formGroup = $(".validateForm").serialize().split("&");
            //console.log(formGroup);
            var data = new FormData();

            for(var i in formGroup) {
                var params = formGroup[i].split("=");
                ///console.log(decodeURIComponent(params[0]));
                data.append( decodeURIComponent(params[0]), decodeURIComponent(params[1]) );
            }
            //console.log(data);
            var url = getBaseUrl() + "/admin/payroll"+id;
            saveRow( url, table, data);

		}
    });

    $('.cancel').on('click', function(){
        $(".crud-modal").modal("hide");
    });


});
</script>
