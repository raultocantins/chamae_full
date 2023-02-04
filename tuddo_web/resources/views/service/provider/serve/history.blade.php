@extends('common.provider.layout.base')
{{ App::setLocale(   isset($_COOKIE['provider_language']) ? $_COOKIE['provider_language'] : 'en'  ) }}
@section('styles')
@parent
   <link rel='stylesheet' type='text/css' href="{{ asset('assets/plugins/data-tables/css/dataTables.bootstrap.min.css')}}"/>
   <style type="text/css">
     .form-inline {

    }
   </style>
@stop
@section('content')
<section class="taxi-banner z-1 content-box" id="booking-form">
      <div id="toaster" class="toaster"></div>
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
            @include('common.provider.includes.history-nav')
            </div>

            <div class="col-xs-12 col-sm-12 col-md-10 wrapper">
               <div class="col-md-12 col-lg-12 col-sm-12 p-0 table-responsive-sm transport-history">
                  <table id="service_grid" class="table  table-striped table-bordered w-100">
                     <thead>
                        <tr>
                           <th>{{ __('provider.s.no') }}</th>
                           <th>{{ __('provider.booking_id') }}</th>
                           <th>{{ __('provider.date') }}</th>
                           <th>{{ __('provider.category') }}</th>
                           <th>{{ __('provider.amount') }}</th>
                           <th>{{ __('provider.status') }}</th>
                           <th>{{ __('provider.action') }}</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
            </div>

            <!-- View Modal 1 Starts -->
            <div class="modal " id="service_modal">
            <div class="modal-dialog min-70vw">
                  <div class="modal-content">
                     <!-- Schedule Header -->
                     <div class="modal-header">
                        <h4 class="modal-title m-0">Service Details</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <!-- Schedule body -->
                     <div class="modal-body ">
                        <div class="col-lg-6 col-md-6 col-sm-12 float-left">
                           <div class="my-trip-left">
                              <h4 class="text-center">
                              <strong><span class ="service_name"></span> Service</strong>
                              </h4>
                              <div class="from-to row m-0">
                                 <div class="from">
                                    <h5>Service Location : <span class ="from_address"></span></h5>
                                    <h5>Service Type     : <span class ="service_category"></span></h5>
                                 </div>
                              </div>
                           </div>
                           <div class="mytrip-right">
                              <ul class="invoice">
                                 <li>
                                    <span class="fare">Booking Id</span>
                                    <span class="txt"><span class ="booking_id"></span></span>
                                 </li>
                                 <li>
                                    <span class="fare">Total Minutes</span>
                                     <span class ="txt hourly_fare"></span>
                                 </li>
                                 <li>
                                    <span class="fare">Base Fare</span>
                                    <span class =" txt base_fare"></span><span class="pricing">$</span>
                                 </li>
                                 <li>
                                    <span class="fare">Tax Fare</span>
                                     <span class ="txt tax_fare"></span><span class="pricing">$</span>
                                 </li>
                                 <li class="d-none li_extra_charges">
                                    <span class="fare">Extra Charges</span>
                                     <span class ="txt extra_charges"></span><span class="pricing">$</span>
                                 </li>

                                 <li class="d-none li_tips">
                                    <span class="fare">Tips</span>
                                     <span class ="txt tips"></span><span class="pricing">$</span>
                                 </li>

                                 <li>
                                    <span class="fare">Wallet Detection</span>
                                     <span class ="txt wallet_detection"></span><span class="pricing">$</span>
                                 </li>
                                 <li>
                                    <hr>
                                    <span class="fare" >Total</span>
                                    <span class ="txt totalamount"></span>
                                    <span class="txt-blue pull-right currency"></span>
                                    <hr>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-md-6 float-right">
                        <div class="header-section">
                           <div class="c-pointer dis-column" style="width:50%;">
                              <h5 class="text-left">Before</h5>
                              <div class="dis-center">
                                 <img class="beforeImage w-100 p-2" src="" class="w-100 p-2" alt="add_document">
                              </div>
                           </div>
                           <div class="c-pointer dis-column" style="width:50%;">
                              <h5 class="text-left">After</h5>
                              <div class="dis-center">
                                 <img class="afterImage w-100 p-2" src="" class="w-100 p-2" alt="add_document">
                              </div>
                           </div>
                        </div>
                           <div class="trip-user">
                              <!-- For image listing -->
                              <h4 class="modal-title m-0">User Details</h4><hr />
                              <div class="user-img"> </div>
                              <div class="user-right">
                                 <h5><span class ="customer_name"></h5>
                                 <div id="user_rating"></div>

                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Dispute Modal -->
      <div class="modal" id="disputeModal">
         <div class="modal-dialog">
            <div class="modal-content">
               <!-- Dispute Header -->
               <input type="hidden" name="id" value="id">
               <div class="modal-header">
                  <h4 class="modal-title">Dispute Details</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="from-to row m-0 getdisputedetails">
                     <div class="from">
                        <h5 class="text-left">Dispute Name :  <span class ="dispute_name txt-yellow ml-2"></span></h5>
                        <h5 class="text-left">Date :<span class ="created_at txt-yellow ml-2"></span></h5>
                        <h5 class="text-left">Status :<span class ="status txt-yellow ml-2"></span></h5>
                        <h5 class="text-left">Comments By :<span class ="comments_by txt-yellow ml-2"></span></h5>
                        <h5 class="text-left">Comments :<span class ="comments txt-yellow ml-2"></span></h5>
                     </div>

               </div>
               <!-- Dispute body -->
               <form class="validateForm getdispute"  style= "color:red;">
                  <input type ="hidden" name="dispute_type" value ="provider"/>
                  <div class="col-md-12 col-sm-12">
                     <h5 class=" no-padding"><strong>Dispute Name</strong></h5>
                     <select name="dispute_name" id="dispute_name" class="form-control" autocomplete="off">
                        <option value="">Select</option>
                     </select>
                  </div>
                  <div class="comments-section field-box mt-3 col-12" id ="dispute_comments">
                     <h5 class="no-padding"><strong>Dispute Comments</strong></h5>
                     <textarea class="form-control" rows="4" cols="50" id="comments" name="comments" placeholder="Dispute Comments..."></textarea>
                  </div>
                  <!-- Dispute footer -->
                  <div class="modal-footer">
                     <!-- <a  class="btn btn-primary btn-block" data-toggle="modal" data-target="#disputeModal" >Submit <i class="fa fa-check" aria-hidden="true"></i></a> -->
                      <button type="submit"  class="btn btn-primary btn-block">Submit <i class="fa fa-check" aria-hidden="true"></i></button>
                  </div>
               </form>
            </div>
         </div>
      </div>
<!-- Dispute Modal ends -->
      </div>
      </section>
@stop
@section('scripts')
@parent
   <script src="{{ asset('assets/plugins/data-tables/js/jquery.dataTables.min.js')}}"></script>
   <script src="{{ asset('assets/plugins/data-tables/js/dataTables.bootstrap.min.js')}}"></script>
   <script>
       var trips_table =$('#service_grid');
       $('#SERVICE').attr('checked',true);

       $('#TRANSPORT').change(function(){
         if($(this).is(":checked")) {
            window.location.replace('/provider/trips/transport');
         }
      });

      $('#ORDER').change(function(){
         if($(this).is(":checked")) {
            window.location.replace('/provider/trips/order');
         }
      });

      $('#SERVICE').change(function(){
         if($(this).is(":checked")) {
            window.location.replace('/provider/trips/service');
         }
      });
      // Header-Section
      function openNav() {
         document.getElementById("mySidenav").style.width = "50%";
      }

      function closeNav() {
         document.getElementById("mySidenav").style.width = "0";
      }
      $(document).ready(function() {
         $('#service_grid').DataTable();
      });


      $(document).ready(function(){
         $('input:checkbox').click(function() {
            $('input:checkbox').not(this).prop('checked', false);
         });
      });
   //For Dispute Details
   $.ajax({
      url:  getBaseUrl() + "/provider/services/dispute",
      type: "GET",
      headers: {
      Authorization: "Bearer " + getToken("provider")
         },
      success: function(data) {
         $("#dispute_name").empty()
            .append('<option value="">Select</option>');
         $.each(data.responseData, function(key, item) {
            $("#dispute_name").append('<option value="' + item.dispute_name + '">' + item.dispute_name + '</option>');
         });
         $("#dispute_name").append('<option value="others">Others</option>');

      }
   });
      //Get the comments text box
   $('#dispute_name').change(function(){
      var result = $("#dispute_name").val();
      if(result == 'others')
      {
         $('#dispute_comments').show();
      }else{
         $('#dispute_comments').hide();
      }
   });
  //For get the dispute name
   //for get dispute id
   var dispute_id = '';
   $('body').on('click', '.dispute', function(e) {
        e.preventDefault();
        $('#dispute_name,#comments').val('');
        $('#dispute_comments').hide();
        dispute_id = $(this).data('id');
        user_id = $(this).data('user_id');
        provider_id = $(this).data('provider_id');
         $.ajax({
            type: "GET",
            url: getBaseUrl() + "/provider/service/disputestatus/"+dispute_id,

            headers: {
            Authorization: "Bearer " + getToken("provider")
            },
            success: function(data) {
               var result = data.responseData;
               if(result !='')
               {
                 $('.getdispute').hide();
                 $('.getdisputedetails').show();
                 $('.dispute_name').text(result.dispute_name)
                 $('.created_at').text(result.created_time)
                 $('.status').text(result.status)
                 $('.comments_by').text(result.dispute_type)
                 $('.comments').text(result.comments)
               }else{
                  $('.getdisputedetails').hide();
                  $('.getdispute').show();
               }
            }
         });
    });
   //Submit dispute details
   $('.validateForm').validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		rules: {
         dispute_name: { required: true },
		},

		messages: {
			dispute_name: { required: "Dispute Name is required." },

		},
		highlight: function(element)
		{
			$(element).closest('.form-group').addClass('has-error');
		},
		success: function(label) {
			label.closest('.form-group').removeClass('has-error');
			label.remove();
		},

		submitHandler: function(form,e) {
            e.preventDefault();
            var formGroup = $(".validateForm").serialize().split("&");
            var data = new FormData();
            for(var i in formGroup) {
                var params = formGroup[i].split("=");
                data.append( params[0], decodeURIComponent(params[1]) );
            }
            data.append('id', dispute_id );
            data.append('user_id', user_id );
            data.append('provider_id', provider_id );
            var url = getBaseUrl() + "/provider/history-dispute/service";
            saveRow( url, null, data, "provider");
            $('#disputeModal').modal('hide');
		}
    });
       //Set the datatable for my trip details
      trips_table = trips_table.DataTable( {
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "lengthChange": false,
        "ajax": {
            "url": getBaseUrl() + "/provider/history/service",
            "type": "GET",
            "beforeSend": function (request) {
               showLoader();
            },
            "headers": {
                "Authorization": "Bearer " + getToken("provider")
            },data: function(data){

                var info = $('#service_grid').DataTable().page.info();
                delete data.columns;
                data.page = info.page + 1;
                data.search_text = data.search['value'];

            },
            dataFilter: function(data){
               var json = parseData( data );
               json.recordsTotal = json.responseData.service.total;
               json.recordsFiltered = json.responseData.service.total;
               json.data = json.responseData.service.data;
               hideLoader();
               return JSON.stringify( json ); // return JSON string
            }
        },
        "columns": [
         { "data": "id" ,render: function (data, type, row, meta) {
               return meta.row + meta.settings._iDisplayStart + 1;
              }
         },
         { "data": "booking_id" },
         { "data": "assigned_time" },
         /*,render: function (data, type, row) {
               return new Date( data ).toLocaleDateString("en-Us") + ' ' + new Date(data).toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
            }
         },*/
         { "data": "provider_id" ,render: function (data, type, row) {
               return row.service.service_name;
            }
         },
         { "data": "provider_id" ,render: function (data, type, row) {
               return row.payment != null ? row.user.currency_symbol+' '+row.payment.total:'NA';
            }
         },
         { "data": "status" },
         { "data": "id", render: function (data, type, row) {
               return `<span class="view-icon providertripdetails" data-toggle="modal" data-target="#service_modal" data-id = `+data+`> <i class="fa fa-eye"></i></span><span class="view-icon dispute mt-1" data-toggle="modal" data-target="#disputeModal" data-id = `+data+` data-user_id = `+row.user_id+` data-provider_id = `+row.provider_id+`><i class="fa fa-commenting-o"></i></span>`;
         }}
        ],
        "drawCallback": function () {
            $('.pagination').css('float','right');
            $('.dataTables_paginate li').addClass('page-item');
            $('.dataTables_paginate li a').addClass('page-link');
            $( trips_table.table().container() ).removeClass('form-inline');
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
      //$( trips_table.table().container() ).removeClass( 'form-inline' );
    //For Trip details
   $('body').on('click', '.providertripdetails', function(){
      var id = $(this).data('id');
      $.ajax({
         type:"GET",
         url: getBaseUrl() + "/provider/history/service/"+id,
         headers: {
               Authorization: "Bearer " + getToken("provider")
         },
         success:function(data){
            var result = data.responseData.service;
               $('.service_name').text(result.service.service_name);
               $('.service_category').text(result.service.service_category.service_category_name);
               if(result.payment){
                  $('.base_fare').html(result.payment.fixed);
                  $('.tax_fare').html(result.payment.tax);
                  $('.hourly_fare').html(result.payment.minute);
                  if(result.payment.extra_charges != 0){
                  $('.li_extra_charges').removeClass('d-none');
                  $('.extra_charges').html(result.payment.extra_charges);
                  }
                  if(result.payment.tips!=0){
                     $('.li_tips').removeClass('d-none');
                     $('.tips').html(result.payment.tips);
                  }
                  $('.wallet_detection').html(result.payment.wallet);
                  $('.totalamount').html(result.payment.total);
                  $('.payment_mode').html(result.payment_mode);
                  $('.charged_fare').html(result.payment.total);
               }

               $('.currency,.pricing').html(result.user.currency_symbol);

              if(result.before_image){
                $('.beforeImage').attr('src', result.before_image);
              }else{
               $('.beforeImage').attr('src','/assets/layout/images/common/svg/photo.svg');
              }
              if(result.after_image){
                $('.afterImage').attr('src', result.after_image );
              }else{
               $('.afterImage').attr('src', '/assets/layout/images/common/svg/photo.svg');
              }

               $('.map_key_img').attr('src', "https://maps.googleapis.com/maps/api/staticmap?autoscale=1&size=420x380&maptype=terrian&format=png&visual_refresh=true&markers=icon:"+window.url+"/assets/layout/images/common/marker-start.png%7C"+result.s_latitude+","+result.s_longitude+"&markers=icon:"+window.url+"/assets/layout/images/common/marker-end.png%7C"+result.d_latitude+","+result.d_longitude+"&path=color:0x191919|weight:3|enc:" + result.route_key + "&key=" + "{{Helper::getSettings()->site->browser_key}}");
               $('.user-img').css('background-image', 'url('+result.user.picture+')');
               var username = result.user.first_name + ' ' +result.user.last_name;
               $('.customer_name').text(username);
               $('.booking_id').text(result.booking_id);
               $('.total_distance').text(result.distance);

               $('.from_address').text(result.s_address);
               $('.pickup_date').text(new Date( result.schedule_time ).toLocaleDateString("en-Us") );
               $('.pickup_time').text(new Date( result.started_time).toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" }));
               $('.drop_date').text(new Date( result.finished_time ).toLocaleDateString("en-Us") );
               $('.drop_time').text(new Date( result.finished_time).toLocaleTimeString([], { hour: "2-digit", minute:
                  "2-digit" }));


               var userrate = Math.round(result.user.rating);
               var str ='';
               for(var i=0;i<userrate;i++){
                 var str = str + "<div class='rating-symbol' style='display:inline-block;position:relative;'><div class='fa fa-star-o' style='visibility:hidden'></div><div class='rating-symbol-foreground' style='display:inline-block;position:absolute;overflow:hidden;left:0px;right:0px;top:0px;width:auto'><span class='fa fa-star' aria-hidden='true'></span></div></div>";
               }
               $("#user_rating").html(str);


         }
      });
   });
   </script>
@stop
