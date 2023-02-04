{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'pt'  ) }}
<!doctype html>
<html class="no-js h-100" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>@section('title') @show</title>
      <meta name="description" content="Xjek App">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="shortcut icon" type="image/png" href="{{ Helper::getFavIcon() }}"/>
      @section('styles')
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
	   <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}"/>
	   <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"/>
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
      <link rel='stylesheet' type='text/css' href="{{ asset('assets/plugins/clockpicker-wearout/css/jquery-clockpicker.min.css')}}"/>
      <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/plugins/chart/css/export.css')}}"/>
      <link rel="stylesheet" href="{{ asset('assets/plugins/extras/css/extras.min.css')}}">
      <link rel="stylesheet"  type='text/css' href="{{ asset('assets/plugins/intl-tel-input/css/intlTelInput.min.css')}}" />
      <link rel="stylesheet" href="{{ asset('assets/layout/css/admin-style.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/layout/css/dashboards.min.css')}}">
       @show
      <!-- <link rel="stylesheet" href="{{ asset('assets/layout/css/arabic_style.css')}}"> -->
      <script> window.Laravel = {csrfToken : '{{ csrf_token() }}'}; </script>
      <script src="{{ asset('assets/plugins/jquery-3.3.1.min.js')}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/pbkdf2.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/sha1.js"></script>
      <script src="https://momentjs.com/downloads/moment.min.js"></script>
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/sha512.js"></script> -->

      <script>
         var MyNameSpace = {
            config:
            {
                  adminurl: "{{ url('/admin/') }}"
            }
         }

      </script>
      <style type="text/css">
         .dz-preview .dz-image img{
          width: 100% !important;
          height: 100% !important;
          object-fit: cover;
      }

      .intl-tel-input{
          width: 100%;
          display: block !important;
      }
      </style>
   </head>
   <body class="h-100">
    <div id="btnSound" style="display: none;"></div>
   <!-- <div class="loader-container">
      <div class="lds-ripple"><div></div><div></div></div>
   </div> -->
      <!-- Color Change Setting Start -->
      <div class="container-fluid">
         <div class="row">
            <!-- Main Sidebar -->
            <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
               <div class="main-navbar">
                  <nav class="navbar align-items-stretch navbar-light flex-md-nowrap  p-0">
                     <a class="navbar-brand w-100 mr-0" href="{{ url('/admin/dashboard') }}">
                        <div class="d-table" style="margin-left: 24px;">
                        <img id="main-logo" class="d-inline-block align-top mr-1" src="{{ Helper::getSiteLogo() }}" alt="Logo" style="max-width: 100%;height: 40px;">
                        <!-- <span class="d-none d-md-inline ml-1" style="line-height: 3"> @if(isset(Helper::getSettings()->site->site_title)){{ Helper::getSettings()->site->site_title}} @endif</span> -->
                        </div>
                     </a>
                     <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                     <i class="material-icons">&#xE5C4;</i>
                     </a>
                  </nav>

               <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
                  <div class="input-group input-group-seamless ml-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                           <i class="fas fa-search"></i>
                        </div>
                     </div>
                     <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search">
                  </div>
               </form>
               @include('common.admin.includes.nav')
            </aside>
            <!-- End Main Sidebar -->
            <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
               <div class="main-navbar sticky-top bg-white">
                  <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
                     <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">

                        <div class="alert alert-danger alert-dismissible is_bankdetails  fade in">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>{{ __('admin.layout.please_fill_bank_details') }}</strong><a href="{{URL::to('admin/bankdetails')}}">{{ __('admin.layout.click_here') }}</a>.
                        </div>
                           <!-- <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> -->

                     </form>
                     <ul class="navbar-nav border-left flex-row ">
                        <li class="nav-item dropdown notifications">
                           <!-- <a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <div class="nav-link-icon__wrapper">
                                 <i class="material-icons">&#xE7F4;</i>
                                 <span class="badge badge-pill badge-danger">2</span>
                              </div>
                           </a> -->
                           <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
                              <a class="dropdown-item" href="#">
                                 <div class="notification__icon-wrapper">
                                    <div class="notification__icon">
                                       <i class="material-icons">&#xE6E1;</i>
                                    </div>
                                 </div>
                                 <div class="notification__content">
                                    <span class="notification__category">{{ __('admin.layout.analytics') }}</span>
                                    <p>{{ __('admin.layout.your_websites_active_users_count_increased_by') }}
                                       <span class="text-success text-semibold">28%</span> {{ __('admin.layout.in_the_last_week_great_job')}}
                                    </p>
                                 </div>
                              </a>
                              <a class="dropdown-item" href="#">
                                 <div class="notification__icon-wrapper">
                                    <div class="notification__icon">
                                       <i class="material-icons">&#xE8D1;</i>
                                    </div>
                                 </div>
                                 <div class="notification__content">
                                    <span class="notification__category">{{ __('admin.layout.sales') }}</span>
                                    <p>{{ __('admin.layout.last_week_your_stores_sales_count_decreased') }}
                                       <span class="text-danger text-semibold">5.52%</span>. {{ __('admin.layout.it_could_have_been_worse')}}
                                    </p>
                                 </div>
                              </a>
                              <a class="dropdown-item notification__all text-center" href="#"> {{ __('admin.layout.view_all_notifications') }} </a>
                           </div>
                        </li>
                        <li class="nav-item dropdown" style="text-align: center;">
                           <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                           <img class="user_picture rounded-circle mr-2" src="" alt="Profile" style="width: 40px;">
                           <span class="d-none d-md-inline-block user_name"></span>
                           </a>
                           <div class="dropdown-menu dropdown-menu-small">
                               @permission('account-settings')
                                 <a class="dropdown-item" href="{{ url('admin/profile')}}">
                                    <i class="material-icons">&#xE7FD;</i> {{ __('admin.layout.profile') }}
                                 </a>
                               @endpermission
                               @permission('change-password')
                                 <a class="dropdown-item" href="{{ url('admin/password')}}">
                                    <i class="material-icons">lock</i> {{ __('admin.layout.change_password') }}
                                 </a>
                               @endpermission
                              <!-- <a class="dropdown-item" href="{{url('admin/profile')}}">
                              <i class="material-icons">vertical_split</i> Blog Posts</a>
                              <a class="dropdown-item" href="add-new-post.html">
                              <i class="material-icons">note_add</i> Add New Post</a> -->
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item text-danger" href="{{url('/admin/logout') }}">
                                 <i class="material-icons text-danger">&#xE879;</i> {{ __('admin.layout.logout') }}
                              </a>
                           </div>
                        </li>
                       <!--  <li class="nav-item dropdown">
                           <div class="form-group">
                              <select class="lang_group custom-select" name="formal" onchange="javascript:inputSelect(this)">
                                 <option value="#" selected>Engilsh</option>
                                 <option value="arabic">Arabic</option>
                              </select>
                           </div>
                        </li> -->
                     </ul>
                     <nav class="nav">
                        <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"  data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                        <i class="material-icons">&#xE5D2;</i>
                        </a>
                     </nav>
                  </nav>
               </div>

               @component('common.admin.components.delete-modal')
               @endcomponent
               @component('common.admin.components.crud-modal')
               @endcomponent

               <div id="toaster" class="toaster">
               @include('common.admin.components.toast')
               </div>
               @yield('content')
               <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
                  <span class="copyright mr-auto my-auto mr-2">
                     @if(isset(Helper::getSettings()->site->site_copyright))
                     {!! Helper::getSettings()->site->site_copyright !!}
                     @endif
                  </span>
               </footer>
            </main>
         </div>
      </div>
      @section('scripts')

      <script src="{{ asset('assets/plugins/popper.min.js')}}"></script>
      <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
      <script src="{{ asset('assets/plugins/shards/js/shards.min.js')}}"></script>
      <script src="{{ asset('assets/plugins//jquery.sharrre.min.js')}}"></script>
      <script src="{{ asset('assets/plugins/extras/js/extras.min.js')}}"></script>

      <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}" ></script>

      <script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/plugins/clockpicker-wearout/js/jquery-clockpicker.min.js') }}"></script>
      <!-- <script src="{{ asset('assets/plugins/dashboard/js/dashboards.min.js')}}"></script> -->

      <script src="{{ asset('assets/layout/js/script.js')}}"></script>
      <script src="{{ asset('assets/layout/js/api.js')}}"></script>
      <script type="text/javascript" src="{{ asset('assets/plugins/intl-tel-input/js/intlTelInput-jquery.min.js') }}"></script>
      @show

      <script>
         window.room = '{{base64_decode(Helper::getSaltKey())}}';
         window.socket_url = '{{Helper::getSocketUrl()}}';
         window.VAPID_PUBLIC_KEY = "{{ env('VAPID_PUBLIC_KEY') }}";

         if(getToken("admin") == null) {
            window.location.replace("{{ url('/admin/login') }}");
         }

         checkAuthentication("admin");

         var adminSettings = getAdminDetails();
         if(adminSettings.type=="FLEET" && adminSettings.is_bankdetail==0){
            $('.is_bankdetails').addClass('show');
         }else{
            $('.is_bankdetails').removeClass('show');
         }

		 var token_str = getToken("admin"); //Added by Ed
		 var token = token_str.replace(/\./g, '*'); //Added by Ed
         //if("{{Session::get('user_id')}}" == "") {
            $.ajax({
               //url: "/admin/permission_list/"+adminSettings.id+"/token/"+getToken("admin"), //Commented by Ed
			   url: "/admin/permission_list/"+adminSettings.id+"/token/"+token, //Added by Ed
               type: "get",
               processData: false,
               contentType: false,
               success: function(response, textStatus, jqXHR) {
                  //window.location.replace("{{ url('/admin/dashboard') }}");
               },
            });
         //}

         $(document).ready(function() {
            $(".user_name").text(adminSettings.name != null ? adminSettings.name : "GoX" );

            if(adminSettings.picture){

               $(".user_name").text(adminSettings.name);
               $(".user_picture").attr('src', adminSettings.picture);

            }else{
               $(".user_picture").attr('src', "{{asset('assets/layout/images/admin/avatar.jpg')}}");
            }

            if($('#data-table').length > 0) {
               var dtable = $('#data-table').dataTable({
                order: [ 1, "desc" ]
               }).api();

               $(".dataTables_filter input")
               .unbind() // Unbind previous default bindings
               .bind("input", function(e) { // Bind our desired behavior
                  // If the length is 3 or more characters, or the user pressed ENTER, search
                  if(this.value.length >= 3 || e.keyCode == 13) {
                        // Call the API search function
                        dtable.search(this.value).draw();
                  }
                  // Ensure we clear the search if they backspace far enough
                  if(this.value == "") {
                        dtable.search("").draw();
                  }
                  return;
               });
            }

         });

         if ($('#data-table').find('tbody tr').length<1) {
         $('.dataTables_paginate').hide();
         }







// $('.open').click(function() {
//     $('.open').show();
// });

// $('.open').click(function() {
//     $('.open').hide();
// });



        var current_title=$(document).find("title").text();
        var site_name="{{Helper::getSettings()->site->site_title}}";
        $(document).find("title").text(site_name+' '+current_title);
          // $(document).ready(function(){
         //    $(".open").hide();
         // });
         $(document).ready(function(){

            $(".toggle-sidebar").click(function(){
            $('.main-sidebar').toggleClass('open');
         });
         });
      </script>
      <script src="{{ asset('assets/layout/js/enable-push.js')}}"></script>
      @if(Helper::getChatmode() == 1)
      <!-- Start of LiveChat (www.livechatinc.com) code -->
      <script type="text/javascript"  src="{{ asset('assets/layout/js/common-chat.js') }}"></script>
      <!-- End of LiveChat code -->
      @endif




   </body>
</html>
