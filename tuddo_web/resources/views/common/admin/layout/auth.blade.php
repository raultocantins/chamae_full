<?php $currentPage = 'index';?>
<!doctype html>
<html class="no-js h-100" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ Helper::getSettings()->site->site_title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="{{ Helper::getFavIcon() }}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/layout/css/dashboards.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/extras/css/extras.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/chart/css/export.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/layout/css/admin-style.css')}}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/layout/css/arabic_style.css')}}"> -->

  </head>
  <body >
  <div id="toaster" class="toaster"></div>
  @yield('content')
  @section('scripts')
    <script src="{{ asset('assets/plugins/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}" ></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/clockpicker-wearout/js/jquery-clockpicker.min.js') }}"></script>

    <script src="{{ asset('assets/layout/js/script.js')}}"></script>
    <script src="{{ asset('assets/layout/js/api.js')}}"></script>
    <script>

        if(getToken("admin") != null && getToken("admin") != 'false' ) {
            window.location.replace("{{ url('/admin/dashboard') }}");
        }
        var settings = '<?php echo json_encode(Helper::getSettings()) ?>';

        setSiteSettings(settings.replace(/&quot;/g, '"'));

    </script>
  @show
  @if(Helper::getChatmode() == 1)
      <!-- Start of LiveChat (www.livechatinc.com) code -->
      <script type="text/javascript"  src="{{ asset('assets/layout/js/common-chat.js') }}"></script>
      <!-- End of LiveChat code -->
   @endif
</body>
</html>
