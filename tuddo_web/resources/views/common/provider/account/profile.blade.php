@extends('common.provider.layout.base')
{{ App::setLocale(   isset($_COOKIE['provider_language']) ? $_COOKIE['provider_language'] : 'en'  ) }}
@section('styles')
@parent
<link rel="stylesheet"  type='text/css' href="{{ asset('assets/plugins/cropper/css/cropper.css')}}" />
@stop
@php

      $paymentConfig = json_decode(json_encode(Helper::getSettings()->payment), true);

      $cardObject = array_values(array_filter($paymentConfig, function($e) {
         return $e['name'] == 'card';
      }));
      $card = 0;

      $stripe_publishable_key = "";

      if (count($cardObject) > 0) {
         $card = $cardObject[0]['status'];

         $stripePublishableObject = array_values(array_filter($cardObject[0]['credentials'], function($e) {
               return $e['name'] == 'stripe_publishable_key';
         }));


         if (count($stripePublishableObject) > 0) {
               $stripe_publishable_key = $stripePublishableObject[0]['value'];
         }
      }

@endphp
@section('content')
@include('common.provider.includes.image-modal')
      <section class="z-1 content-box" id="profile-form">
         <div class="profile-section">
            <div class="dis-center col-md-12 p-0 dis-center">
               <ul class="nav nav-tabs " role="tablist">
                  <li class="nav-item col-sm-12 col-md-4 col-lg-4 p-0">
                     <a class="nav-link active general" data-toggle="tab" href="#general_info" role="tab" data-toggle="tab">{{ __('provider.general_info') }}</a>
                  </li>
                  <li class="nav-item col-sm-12 col-md-4 col-lg-4 p-0">
                     <a class="nav-link password" data-toggle="tab" href="#password" role="tab" data-toggle="tab">{{ __('provider.change_password') }} </a>
                  </li>
                  <li class="nav-item col-sm-12 col-md-4 col-lg-4 p-0">
                     <a class="nav-link payment-method payment_method" data-toggle="tab" href="#payment_method" role="tab" data-toggle="tab">{{ __('provider.payment_methods') }}</a>
                  </li>

               </ul>
            </div>
            <div class="clearfix tab-content">
               <div role="tabpanel" class="tab-pane active col-sm-12 col-md-12 col-lg-12 p-0 general"  id="general_info">
                  <div class="col-md-12">
                     <div class="profile-content">
                        <div class="row m-0">
                        <form class="w-100 validateForm" style= "color:red;">
                              <div class="col-md-12 col-sm-12 pro-form dis-ver-center p-0">
                                 <div class="col-md-6 col-sm-12">
                                    <h5 class=""><strong>{{ __('provider.profile_picture') }}</strong></h5>
                                    <div class="photo-section">
                                       <!-- <div class="img-outer">
                                          <img src="../img/svg/user-2.svg" alt="user">
                                       </div> -->
                                       <img class = "user-img" height ="200px;" width ="200px;" />
                                       <div class="fileUpload up-btn profile-up-btn">
                                          <input type="file" id="profile_img_upload_btn" name="picture" class="upload" accept="image/x-png, image/jpeg">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-lg-4 col-sm-12 p-0">
                                 <div class=" top small-box green">
                                          <div class="left">
                                             <h2>{{ __('provider.balance') }}</h2>
                                             <h4><i class="material-icons">account_balance_wallet</i></h4>
                                             <h1 class='account_balance_wallet'></h1>
                                          </div>
                                       </div>
                                 </div>
                              </div>
                              <div class="col-md-12 col-sm-12 pro-form dis-ver-center p-0">
                                 <div class="col-md-6 col-sm-12">
                                    <h5 class=""><strong>{{ __('provider.profile.first_name') }}</strong></h5>
                                    <input class="form-control" type="text" id ="first_name" name="first_name" placeholder="First Name">
                                 </div>
                                 <div class="col-md-6 col-sm-12">
                                    <h5 class=" no-padding"><strong>{{ __('provider.profile.last_name') }}</strong></h5>
                                    <input class="form-control" id ="last_name" name="last_name" placeholder="Last Name">
                                 </div>
                              </div>
                              <div class="col-md-12 pro-form dis-ver-center p-0">
                                 <div class="col-md-6 col-sm-12">
                                    <h5 class=""><strong>{{ __('provider.email') }}</strong></h5>
                                    <input class="form-control" type="email" id ="profile_email" name="email" placeholder="Email">
                                 </div>
                                 <div class="col-md-6 col-sm-12">
                                    <h5 class=""><strong>{{ __('provider.profile.phone') }}</strong></h5>
                                    <input class="form-control numbers" type="text" id ="mobile" name="mobile" placeholder="Mobile" readonly>
                                    <input type="hidden" class="mobile_number" value="">
                                    <input type="hidden" class="country_code" value="">
                                    <span>
                                       <i class="fa fa-edit  user_edit" style=" position: absolute; right: 10%; top: 61%;color: #495057;font-size: 18px;cursor: pointer;"></i>
                                   </span>
                                   <span>
                                       <i class="fa fa-check user_update" style=" position: absolute; right: 5%; top: 61%;color: #495057;font-size: 18px;cursor: pointer;"></i>
                                   </span>
                                 </div>
                              </div>
                              <div class="col-md-12 pro-form dis-ver-center p-0 otp d-none">
                                 <div class="col-md-6 col-sm-12">

                                 </div>
                                 <div class="col-md-6 col-sm-12">
                                    <h5 class=""><strong>{{ __('user.profile.otp') }}</strong></h5>
                                    <input class="form-control numbers" type="text" id ="otp" placeholder="{{ __('user.profile.otp') }}">
                                    <span>
                                    <i class="fa fa-check verify_otp" style=" position: absolute; right: 5%; top: 61%;color: #495057;font-size: 18px;cursor: pointer;"></i>
                                    </span>
                                 </div>
                              </div>
                              <div class="col-md-12 pro-form dis-ver-center p-0">
                                 <div class="col-md-6 col-sm-12">
                                    <h5 class=""><strong>{{ __('provider.profile.country') }}</strong></h5>
                                    <select id="country" name="country_id"  class=" mb-4 form-control">
                                          <option>{{ __('provider.select_country') }}</option>
                                    </select>
                                 </div>
                                 <div class="col-md-6 col-sm-12">
                                    <h5 class=""><strong>{{ __('provider.profile.city') }}</strong></h5>
                                    <select id="city" name="city_id" @if(Helper::getDemomode() == 1) disabled="disabled" @endif required=""  class=" mb-4 form-control">
                                          <option value="">{{ __('provider.select_city') }}</option>
                                    </select>
                                 </div>
                               </div>
                              <div class="col-md-12 pro-form dis-ver-center p-0">
                                 <!-- <div class="col-md-6 col-sm-12">
                                    <h5 class=""><strong>Wallet Balance</strong></h5>
                                    <input class="form-control" type="number" name="$0.00" placeholder="" required>
                                 </div> -->
                                 <div class="col-md-6 col-sm-12">
                                    <h5 class=""><strong>{{ __('provider.profile.language') }}</strong></h5>
                                    <select class="form-control" name="language" id="language" @if(Helper::getDemomode() == 1) disabled="true" @endif>
                                       @foreach(Helper::getSettings()->site->language as $language)
                                       <option value="{{$language->key}}">{{$language->name}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="col-md-6 col-sm-12">
                                    <h5 class=""><strong>{{ __('provider.profile.update_location') }}</strong></h5>
                                    <input type="text" class="form-control current_location" name="current_location" id="address"  placeholder="Location" >
                                    <input type="hidden" name="latitude" id="latitude" />
                                    <input type="hidden" name="longitude" id="longitude" />
                                </div>
                              </div>
                               <button type="submit"  class="btn btn-success edit-profile mt-5 save" >{{ __('provider.save') }}</button>
                         </form>
                        </div>
                     </div>
                  </div>
               </div>
               <!--password !-->
               <div role="tabpanel" class="tab-pane col-sm-12 col-md-12 col-lg-12 p-0 password" id="password">
            <div class="col-md-12">
               <div class="profile-content">
                  @if(Helper::getDemomode() == 1)
                     <div class="alert alert-danger">
                        "CRUD Feature" has been disabled on the Demo Admin Panel. This feature will be enabled on your product which you will be purchasing, meahwhile if you have any queries feel free to contact our 24/7 support at info@appdupe.com.
                     </div>
                  @endif
                  <div class="row m-0">
                     <form class="w-100 validatepasswordForm" style= "color:red;">
                        <div class="col-md-12 pro-form p-0">
                           <div class="col-md-6">
                              <h5 class=""><strong>{{ __('provider.old_password') }}</strong></h5>
                              <input class="form-control" type="password" name="old_password" placeholder="Old Password">
                           </div>
                        </div>
                        <div class="col-md-12 pro-form p-0">
                           <div class="col-md-6">
                              <h5 class=""><strong>{{ __('provider.new_password') }}</strong></h5>
                              <input class="form-control" id="password1" type="password" name="password" placeholder="Password">
                           </div>
                        </div>
                        <div class="col-md-12 pro-form p-0">
                           <div class="col-md-6">
                              <h5 class=""><strong>{{ __('provider.confirm_password') }}</strong></h5>
                              <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
                           </div>
                        </div>
                           <button type="submit"  class="btn btn-primary edit-profile mt-5" >{{ __('provider.save') }}</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <!--Password end !-->
         <!--Add card details !-->
               <div role="tabpanel" class="tab-pane col-sm-12 col-md-12 col-lg-12 p-0  min-46vh payment_method" id="payment_method">
                  <div class="col-lg-12 col-md-12 col-sm-12 p-0 dis-column payment border-bottom pb-3">
                  <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                  <h4><strong class="title-bor">{{ __('provider.bank_details') }}</strong></h4> <br>
                     <form class="bankForm" style= "color:red;">
                      </form>
                    </div>
                     @if($card==1)
                     <div class=" col-lg-12 col-md-12 col-sm-12 p-0 dis-ver-center flex-wrap mt-3">
                        <div id="card_container" class="col-lg-4 col-md-12 col-sm-12 c-pointer p-0 dis-center" data-toggle="modal" data-target="#add_card">
                              <div class="add-card">
                                 <div class="add-img">
                                    <img src="{{asset('assets/layout/images/common/svg/add.svg')}}">
                                 </div>
                              </div>
                           </div>
                        <!-- Add Card Modal -->
                       <div class="modal" id="add_card">
                           <div class="modal-dialog min-50vw">
                              <div class="modal-content password-change">
                                 <!-- Add Card Header -->
                                 <div class="modal-header">
                                    <h4 class="modal-title">{{ __('provider.card.add_card') }}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 </div>
                                 <!-- Add Card body -->
                                 <div class="modal-body">
                                    <form id="payment-form"  class="w-100 validatepaymentForm" style= "color:red;">
                                       <div class="col-lg-12 col-md-12 col-sm-12 card-section p-0 b-0">
                                          <div class ="payment-errors"></div>
                                          <div class="col-sm-12 p-0 card-form">
                                             <div class="col-sm-12 p-0">
                                                <h5 class=""><strong>{{ __('user.card.fullname') }}</strong></h5>
                                                <input data-stripe="name" autocomplete="off" class="form-control" type="text"  required placeholder="{{ __('user.card.fullname') }}">
                                                <input type="hidden"  data-stripe="currency" value="USD" />
                                             </div>
                                             <div class="col-sm-12 p-0">
                                                <h5 class=""><strong>{{ __('user.card.card_no') }}</strong></h5>
                                                <input class="form-control numbers" type="text"  data-stripe="number" required autocomplete="off" maxlength="16" placeholder="{{ __('user.card.card_no') }}" >
                                             </div>
                                             <div class="col-sm-12 dis-row p-0">
                                                <div class="col-sm-4">
                                                   <h5 class=""><strong>{{ __('user.card.month') }}</strong></h5>
                                                   <input class="form-control numbers" type="text" maxlength="2" required autocomplete="off" data-stripe="exp-month" class="form-control" placeholder="MM">
                                                </div>
                                                <div class="col-sm-4">
                                                   <h5 class=""><strong>YY</strong></h5>
                                                   <input class="form-control numbers" type="text"  maxlength="2" required autocomplete="off" data-stripe="exp-year" class="form-control"  placeholder="YY">
                                                </div>
                                                <div class="ml-2 col-sm-4">
                                                   <h5 class=""><strong>{{ __('user.card.cvv') }}</strong></h5>
                                                   <input class="form-control numbers" type="text" data-stripe="cvc" autocomplete="off" required maxlength="4"  placeholder="{{ __('user.card.cvv') }}">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       @if(Helper::getDemomode() == 0)
                                          <div class="modal-footer">
                                             <button type="submit" class="btn btn-primary btn-block" >{{ __('provider.save') }}</button>
                                          </div>
                                       @endif
                                    </form>
                                 </div>
                                 <!-- Add Card body -->

                              </div>
                           </div>
                        </div>
                        <!-- Add Card Modal -->
                        <!-- Add Card Modal -->
                     </div>
                     @endif
                  </div>
               </div>

            </div>
         </div>
      </section>

@stop
@section('scripts')
@parent
<script type = "text/javascript" src = "https://js.stripe.com/v2/" > </script>

<script src = "{{ asset('assets/plugins/cropper/js/cropper.js')}}" > </script>
<script src = "{{ asset('assets/plugins/data-tables/js/jquery.dataTables.min.js')}}" > </script>
<script src = "{{ asset('assets/plugins/data-tables/js/dataTables.bootstrap.min.js')}}" > </script>
<script src = "{{ asset('assets/layout/js/crop.js')}}" > </script>
<script >
   $('#country').attr('readonly', true);
   $('#country').css('pointer-events', 'none');
   $('.user_edit').click(function() {
      $("#mobile").attr('readonly', false);
      $(".save").attr('disabled', true);
   });

   var blobImage = '';
   var blobName = '';

   $('#profile_img_upload_btn').on('change', function(e) {
      var files = e.target.files;
      if (files && files.length > 0) {
         blobName = files[0].name;
         cropImage($(this), files[0], $('.user-img'), function(data) {
            blobImage = data;
         });
      }
   });

   $('.user_update').click(function(){
      var countryCode = $('.country_code').val();
      var phoneNumber = $('#mobile').val();
      var mob=$('.mobile_number').val();
      if(phoneNumber != "") {
            var data = new FormData();
            data.append('country_code',countryCode);
            data.append('mobile', phoneNumber);
            data.append('salt_key', '{{Helper::getSaltKey()}}');

               $.ajax({
                  type:'POST',
                  url: getBaseUrl() + "/provider/send-otp",
                  data: data,
                  processData: false,
                  contentType: false,
                  headers: {
                        Authorization: "Bearer " + getToken("provider")
                  },
                  beforeSend: function(request) {
                        showLoader();

                  },
                  success:function(data){
                     hideLoader();
                     $('.otp').removeClass('d-none');
                     alertMessage("Success", data.message, "success");
                  }, error: (jqXHR, textStatus, errorThrown) => {
                     hideLoader();

                  }
               });
         }
      });

      $('.verify_otp').on('click', function() {

         var countryCode = $('.country_code').val();
         var phoneNumber = $('#mobile').val();
         var otp = $('#otp').val();
         showLoader();

         if(phoneNumber != "") {
            $.post(getBaseUrl() + "/provider/verify-otp",{
               country_code : countryCode,
               mobile : phoneNumber,
               otp : otp,
               salt_key: '{{Helper::getSaltKey()}}'
            })
            .done(function(response){
               hideLoader();
               $('.otp').addClass('d-none');
               $('.save').prop('disabled',false);
            })
            .fail(function(xhr, status, error) {
               hideLoader();
               var mob=$('.mobile_number').val();
               $('#mobile').val(mob);
               $('#mobile').prop('readonly',true);
               $('.save').prop('disabled',false);
               alertMessage('Error', xhr.responseJSON.message, "danger");

            });
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
      basicFunctions();
      var id = "";

      $.ajax({
         url: getBaseUrl() + "/provider/bankdetails/template",
         type: "get",
         async: false,
         headers: {
               Authorization: "Bearer " + getToken("provider")
         },
         success: (data, textStatus, jqXHR) => {
               var bankform = data.responseData;
               if (bankform.length != 0) {
                  var html = `<div class="row">`;
                  for (var i in bankform) {
                     html += `<div class="col-md-4 "><h5 class=""><strong>` + bankform[i].label + `</strong></h5>`;
                     var type = 'number';
                     if (bankform[i].type == 'VARCHAR') {
                           type = 'text';
                     }
                     var editid = "";
                     var inputvalue = "";
                     if (bankform[i].bankdetails) {
                           inputvalue = bankform[i].bankdetails.keyvalue;
                           editid = bankform[i].bankdetails.id;
                     }
                     html += `<input type="hidden" name ="bankform_id[` + i + `]" value ="` + bankform[i].id + `">
                        <input type="` + type + `" class="form-control" name="keyvalue[` + i + `]" value ="` + inputvalue + `" placeholder="` + bankform[i].label + `" >
                        <input type="hidden" class="editid" name ="id[` + i + `]" value ="` + editid + `"> </div>`;
                  }
                  html += `</div><button type="submit" id="submit-button"  class="btn btn-primary mt-3">Save</button><br>`;
                  $('.bankForm').html(html);
               }
         },
         error: (jqXHR, textStatus, errorThrown) => {
               alertMessage(textStatus, jqXHR.responseJSON.message, "danger");
         }
      });

      $('.bankForm').validate({
         errorElement: 'span',
         errorClass: 'help-block txt-red',
         focusInvalid: false,
         highlight: function(element) {
               $(element).closest('.form-group').addClass('has-error');
         },

         success: function(label) {
               label.closest('.form-group').removeClass('has-error');
               label.remove();
         },
         submitHandler: function(form, e) {
               var data = new FormData();
               var formGroup = $(".bankForm").serialize().split("&");
               for (var i in formGroup) {
                  var params = formGroup[i].split("=");
                  data.append(decodeURIComponent(params[0]), decodeURIComponent(params[1]));
               }
               var bankdetails_id = $('.editid').val();
               if (!bankdetails_id)
                  var url = getBaseUrl() + "/provider/addbankdetails";
               else
                  var url = getBaseUrl() + "/provider/editbankdetails";
               savefunction(data, url)
         }
      });

      function savefunction(data, url) {
         $.ajax({
               url: url,
               type: "post",
               data: data,
               headers: {
                  Authorization: "Bearer " + getToken("provider")
               },
               processData: false,
               contentType: false,
               success: function(response, textStatus, jqXHR) {
                  var data = parseData(response);
                  var providerdata = localStorage.getItem('provider');
                  providerdata = JSON.parse(decodeHTMLEntities(providerdata));
                  providerdata.is_bankdetail = 1;
                  setProviderDetails(providerdata);
                  document.cookie="provider_language="+providerdata.language+"; path=/";
                  alertMessage("Success", data.message, "success");
                  setTimeout(function() {
                     window.location.replace('/provider/profile/payment_method');
                  }, 1000);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                  alertMessage(textStatus, jqXHR.responseJSON.message, "danger");
               }
         });
      }
      $.ajax({
         url: getBaseUrl() + "/user/countries",
         type: "post",
         async: false,
         data: {
               salt_key: '{{Helper::getSaltKey()}}'
         },
         success: (data, textStatus, jqXHR) => {
               var countries = data.responseData;
               for (var i in countries) {
                  $('select[name=country_id]').append(`<option value="` + countries[i].id + `">` + countries[i].country_name + `</option>`);
               }

               $('select[name=country_id]').on('change', function() {
                  $('select[name=city_id]').html("");
                  $('select[name=city_id]').append(`<option value="">Select City</option>`);
                  var country_id = $(this).val();

                  var cities = countries.filter((item) => item.id == country_id)[0].city;

                  for (var j in cities) {
                     $('select[name=city_id]').append(`<option value="` + cities[j].id + `">` + cities[j].city_name + `</option>`);
                  }

               });
         },
         error: (jqXHR, textStatus, errorThrown) => {}
      });

      //For stripe details



      Stripe.setPublishableKey("{{ $stripe_publishable_key }}");
      var stripeResponseHandler = function(status, response) {
         var $form = $('#payment-form');
         if (response.error) {
               // Show the errors on the form
               $form.find('.payment-errors').text(response.error.message);
               $form.find('button').prop('disabled', false);
               console.log(response.error.message);

         } else {
               // token contains id, last4, and card type
               var data = new FormData();

               data.append('stripe_token', response.id);

               $.ajax({
                  type: 'POST',
                  url: getBaseUrl() + "/provider/card",
                  data: data,
                  processData: false,
                  contentType: false,
                  headers: {
                     Authorization: "Bearer " + getToken("provider")
                  },
                  success: function(data) {
                     alertMessage("Success", data.message, "success");
                     $('#add_card').modal('hide');
                     setTimeout(function() {
                           window.location.replace('/provider/profile/payment_method');
                     }, 1000);
                  },
                  error: (jqXHR, textStatus, errorThrown) => {
                     $form.find('.payment-errors').text(jqXHR.responseJSON.message);
                  }
               });
               // var url = getBaseUrl() + "/provider/card";
               // saveRow( url, null, data, "provider");
               // $('#add_card').modal('hide');
         }
      };

      $('#payment-form').submit(function(e) {
         e.preventDefault();
         if ($('#stripeToken').length == 0) {
               var $form = $(this);
               $form.find('button').prop('disabled', true);
               Stripe.card.createToken($form, stripeResponseHandler);
               return false;
         }
      });
      //For get stripe card  details
      $.ajax({
         type: "GET",
         url: getBaseUrl() + "/provider/card",
         headers: {
               Authorization: "Bearer " + getToken("provider")
         },
         success: function(data) {
               var html = ``;
               var result = data.responseData;
               $.each(result, function(key, item) {
                  html += `<div class="col-lg-4 col-md-12 col-sm-12 card-section">
                              <h5 class="p-0"><strong>` + item.holder_name + ` Card</strong></h5>
                              <div class="card-img">
                                 <img src="{{asset('assets/layout/images/common/svg/card-2.svg')}}">
                                 <div class="card-number">
                                 <span>XXXX</span> <span>XXXX</span><span>XXXX</span><span class ="last_four">` + item.last_four + `</span><br>
                                    <small></small><br>`;
                  if (item.holder_name) {
                     html += `<span class = "holder_name">` + item.holder_name + `</span>`;
                  }
                  html += `</div>
                              </div>
                              <div class="col-sm-12 p-0 card-form dis-center">
                                 <button  class="btn btn-danger change-pswrd mt-1 delete" data-toggle="modal" data-target="#edit_account" data-id ="` + item.id + `">Delete</button>
                              </div>
                           </div>`;
               });
               $('#card_container').before(html);
         }
      });
      //List the provider wallet  details
      $.ajax({
         type: "GET",
         url: getBaseUrl() + "/provider/list",
         headers: {
               Authorization: "Bearer " + getToken("provider")
         },
         success: function(data) {
               var result = data.responseData;

               $('.account_balance_wallet').text((result.currency_symbol) + ' ' + (result.wallet_balance).toFixed(2));
         }
      });
      //For delete stripe record  details
      $(document).on('click', '.delete', function() {
         var id = $(this).data('id');
         var result = confirm("Are You sure Want to delete?");
         $.ajax({
               type: "Delete",
               url: getBaseUrl() + "/provider/card/" + id,
               headers: {
                  Authorization: "Bearer " + getToken("provider")
               },
               success: function(data) {
                  var result = data.responseData;
               }
         });
      });

      //List the profile details
      $.ajax({
         type: "GET",
         url: getBaseUrl() + "/provider/profile",
         headers: {
               Authorization: "Bearer " + getToken("provider")
         },
         success: function(data) {
               var result = data.responseData;
               if(result.language!=''){
                  $('#language').val(result.language).prop('readonly',true);
               }
               $('#first_name').val(result.first_name);
               $('#last_name').val(result.last_name);
               $('#profile_email').val(result.email);
               $('#country').val(result.country_id).change();
               $('#mobile').val(result.mobile);
               $('.mobile_number').val(result.mobile);
               $('.country_code').val(result.country_code);
               $('.user-img').attr('src', result.picture);
               $('#city').val(result.city_id);
               $('#latitude').val(result.latitude);
               $('#longitude').val(result.longitude);
               $('.current_location').val(result.current_location);

         }
      });
//console.log(getProviderDetails());
      //For profile details
      $('.validateForm').validate({
         errorElement: 'span', //default input error message container
         errorClass: 'help-block', // default input error message class
         focusInvalid: false, // do not focus the last invalid input
         rules: {
               first_name: {
                  required: true
               },
               last_name: {
                  required: true
               },
               email: {
                  required: true
               },
               mobile: {
                  required: true
               },
               language: {
                  required: true
               },
               city_id: {
                  required: true
               },
         },

         messages: {
               first_name: {
                  required: "First Name is required."
               },
               last_name: {
                  required: "First Name is required."
               },
               email: {
                  required: "Email is required."
               },
               mobile: {
                  required: "Mobile is required."
               },
               language: {
                  required: "Language is required."
               },
               city_id: {
                  required: "{{__('auth.city_required')}}"
               },

         },
         highlight: function(element) {
               $(element).closest('.form-group').addClass('has-error');
         },
         success: function(label) {
               label.closest('.form-group').removeClass('has-error');
               label.remove();
         },
         submitHandler: function(form) {
               var formGroup = $(".validateForm").serialize().split("&");
               var data = new FormData();

               if(blobImage != "") data.append('picture', blobImage, blobName);

               for (var i in formGroup) {
                  var params = formGroup[i].split("=");
                  data.append(decodeURIComponent(params[0]), decodeURIComponent(params[1]));
               }

               $.ajax({
                  url: getBaseUrl() + "/provider/profile",
                  type: "post",
                  data: data,
                  processData: false,
                  contentType: false,
                  headers: {
                        Authorization: "Bearer " + getToken('provider')
                  },
                  beforeSend: function (request) {
                        showInlineLoader();
                  },
                  success: function(response, textStatus, jqXHR) {
                        var data = parseData(response);

                        setProviderDetails(data.responseData);
                        document.cookie="provider_language="+data.responseData.language+"; path=/";

                        alertMessage("Success", data.message, "success");
                        hideInlineLoader();

                        setTimeout(function(){
                           window.location.replace("/provider/profile/general");
                        }, 1000);
                  },
                  error: function(jqXHR, textStatus, errorThrown) {

                        if (jqXHR.status == 401 && getToken(guard) != null) {
                           refreshToken(guard);
                        } else if (jqXHR.status == 401) {
                           window.location.replace("/provider/login");
                        }

                        if (jqXHR.responseJSON) {

                           alertMessage(textStatus, jqXHR.responseJSON.message, "danger");
                        }
                        hideInlineLoader();
                  }
               });


         }
      });

      //Change Password
      $('.validatepasswordForm').validate({
         errorElement: 'span', //default input error message container
         errorClass: 'help-block', // default input error message class
         focusInvalid: false, // do not focus the last invalid input
         rules: {
               old_password: {
                  required: true
               },
               password: {
                  required: true
               },
               password_confirmation:{
                  required:true,
                  equalTo: "#password1"
               }
         },
         messages: {
               old_password: {
                  required: "Old Password is required."
               },
               password: {
                  required: "Password is required."
               },
               password_confirmation: {
                  required: "Confirm Password is required.",
                  equalTo:"Confirm Password and Password not matches"
               },
         },
         highlight: function(element) {
               $(element).closest('.form-group').addClass('has-error');
         },
         success: function(label) {
               label.closest('.form-group').removeClass('has-error');
               label.remove();
         },
         submitHandler: function(form) {
               var formGroup = $(".validatepasswordForm").serialize().split("&");
               var data1 = new FormData();

               for (var i in formGroup) {
                  var params = formGroup[i].split("=");
                  data1.append(decodeURIComponent(params[0]), decodeURIComponent(params[1]));
               }

               $.ajax({
                  url: getBaseUrl() + "/provider/password",
                  type: "post",
                  data: data1,
                  processData: false,
                  contentType: false,
                  headers: {
                        Authorization: "Bearer " + getToken('provider')
                  },
                  beforeSend: function (request) {
                        showInlineLoader();
                  },
                  success: function(response, textStatus, jqXHR) {
                        var data = parseData(response);

                        alertMessage("Success", data.message, "success");
                        hideInlineLoader();

                        setTimeout(function(){
                           window.location.replace("/provider/profile/password");
                        }, 1000);
                  },
                  error: function(jqXHR, textStatus, errorThrown) {

                        if (jqXHR.status == 401 && getToken(guard) != null) {
                           refreshToken(guard);
                        } else if (jqXHR.status == 401) {
                           window.location.replace("/provider/login");
                        }

                        if (jqXHR.responseJSON) {

                           alertMessage(textStatus, jqXHR.responseJSON.message, "danger");
                        }
                        hideInlineLoader();
                  }
               });

         }
      });

});
$('.' + '{{$type}}').trigger('click');

function initMap() {
    var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var long = place.geometry.location.lng();
        $('#latitude').val(lat);
        $('#longitude').val(long);

    });
}

</script>
<script src = "https://maps.googleapis.com/maps/api/js?key={{Helper::getSettings()->site->browser_key}}&libraries=places&callback=initMap"
async defer > < /script>
@stop
