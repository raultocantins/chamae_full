@extends('common.admin.layout.base')
{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'pt'  ) }}

@section('title') {{ __('admin.include.dashboard') }} @stop

@section('styles')
@parent
    <link rel="stylesheet" href="{{ asset('assets/plugins/chart/css/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/data-tables/css/dataTables.bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/data-tables/css/responsive.bootstrap.min.css')}}">

@stop

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row  py-4">
        <div class="col-12  text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">{{ __('admin.include.dashboard') }}</span>
        <h3 class="page-title">{{ __('admin.include.overview') }}</h3>
        <div class="col-md-12">
            <div class="note_txt">
                @if(Helper::getDemomode() == 1)
                <p>** Demo Mode : {{ __('admin.demomode') }}</p>
                <span class="pull-left">(*personal information hidden in demo)</span>
                @endif

            </div>
        </div>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Small Stats Blocks -->

    @permission('dashboard-menus')
    <div class="row mt-10">
        <div class="col-lg-3 col-md-6 col-sm-6 offset-lg-9">
            <small>{{ __('admin.dashboard.graph_by_country') }}</small>
            <select class="form-control country">
                @foreach(Helper::getCountryList() as $key => $country)
                    <option value={{$key}}>{{$country}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card dashboard_card">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">person</i>
                    </div>
                    <p class="card-category stats-small__label text-uppercase">{{ __('admin.dashboard.users') }}</p>
                    <h3 class="card-title user_data">0</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card dashboard_card">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">motorcycle</i>
                    </div>
                    <p class="card-category stats-small__label text-uppercase"><b>{{ __('admin.dashboard.providers') }}</b></p>
                    <h3 class="card-title provider_data">0</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card dashboard_card">
                <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">device_hub</i>
                    </div>
                    <p class="card-category stats-small__label text-uppercase">{{ __('admin.dashboard.fleets') }}</p>
                    <h3 class="card-title fleet_data">0</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card dashboard_card">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">store</i>
                    </div>
                    <p class="card-category stats-small__label text-uppercase">{{ __('admin.dashboard.shops') }}</p>
                    <h3 class="card-title shop_data">0</h3>
                </div>
            </div>
        </div>

    </div>
    @endpermission

    <!-- End Small Stats Blocks -->
    <div class="row">
        <!-- Rides Stats -->
        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
        <div class="card card-small">
            <div class="card-header border-bottom">
                <h6 class="m-0">{{ __('admin.dashboard.total_transports') }}</h6>
            </div>
            <div class="card-body pt-0">
                <canvas id="canvas"></canvas>

            </div>
        </div>
        </div>
        <!-- End Ride Stats -->
        <!-- Xuber Stats -->
        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
               <div class="card-header border-bottom">
                    <h6 class="m-0">{{ __('admin.dashboard.total_services') }}</h6>
                </div>
                <div class="card-body pt-0">
                    <canvas id="canvas1"></canvas>
                </div>
            </div>
        </div>

        <!-- Order Stats -->
        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ __('admin.dashboard.total_orders') }}</h6>
                </div>
                <div class="card-body pt-0">
                    <canvas id="canvas2"></canvas>

                </div>
            </div>
        </div>
        <!-- End Order Stats -->
        <!-- Over all Stats -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
            <div class="card card-small h-100">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ __('admin.dashboard.overall_summary') }}</h6>
                </div>
                <div class="card-body d-flex py-0">
                   <canvas id="chart-area"></canvas>
                </div>
            </div>
        </div>
        <!-- End Over all Stats -->


        <!-- Top Referrals Component -->
        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ __('admin.dashboard.wallet_summary') }}</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                        <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">{{ __('admin.dashboard.admin_credit') }}</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray admin_credit">$46.07</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">{{ __('admin.dashboard.provider_credit') }}</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray provider_credit">$14.49</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">{{ __('admin.dashboard.provider_debit') }}</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray provider_debit">$-23.27</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">{{ __('admin.dashboard.fleet_credit') }}</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray fleet_credit">$0.00</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">{{ __('admin.dashboard.fleet_debit') }}</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray fleet_debit">$0.00</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">{{ __('admin.dashboard.admin.dashboard.commission') }}</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray commission">$12.82</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">{{ __('admin.dashboard.discount') }}</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray discount">$-0.78</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">{{ __('admin.dashboard.tax_amount') }}</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray tax_amount">$12.25</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- End Top Referrals Component -->
    </div>
</div>
@stop
@section('scripts')
@parent
<script src="{{ asset('assets/plugins/data-tables/js/buttons.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/jszip.min.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/plugins/data-tables/js/buttons.html5.min.js')}}"></script>
<!-- <script src="{{ asset('assets/plugins/chart/js/jquery-jvectormap.min.js')}}"></script>
<script src="{{ asset('assets/plugins/chart/js/jquery-jvectormap-world-mill.js')}}"></script> -->
<script src="{{ asset('assets/plugins/chart/js/chart.min.js')}}"></script>
<script src="{{ asset('assets/plugins/chart/js/utils.js')}}"></script>
<!-- <script src="{{ asset('assets/plugins/chart/js/export.min.js')}}"></script>
<script src="{{ asset('assets/plugins/chart/js/light.js')}}"></script>
<script src="https://www.chartjs.org/dist/2.8.0/Chart.min.js"></script>-->
<script src="{{ asset('assets/plugins/chart/js/utils.js')}}"></script>

<script src="{{ asset('assets/plugins/chart/js/jquery-jvectormap.min.js')}}"></script>
<script src="{{ asset('assets/plugins/chart/js/jquery-jvectormap-world-mill.js')}}"></script>

<script type="text/javascript">
var overalldata=[];
/* Admin Data  */
var country_id = localStorage.getItem("mycountry");

if(country_id === null){
    var country_id = $('.country').val();
    localStorage.setItem('mycountry', country_id);
}else{
    $('.country option[value="'+country_id+'"]').prop('selected',true);
}

function dashboarddata(id){
$.ajax({
        type:"GET",
        url: getBaseUrl() + "/admin/dashboard/"+id,
        'beforeSend': function (request) {
                showLoader();
            },
        headers: {
            Authorization: "Bearer " + getToken("admin")
        },
        success:function(data){
            var total_data=data.responseData;
            if(total_data){
                var adminCredit = total_data.admin ? parseFloat(total_data.admin).toFixed(2) :0;
                var adminDiscount = total_data.admin_discount ? parseFloat(total_data.admin_discount).toFixed(2):0;
                var adminTax = total_data.admin_tax ? parseFloat(total_data.admin_tax).toFixed(2) :0;
                var adminCommission = total_data.admin_commission ? parseFloat(total_data.admin_commission).toFixed(2) : 0;
                var providerCredit = total_data.provider_credit[0].total_credit && total_data.provider_credit[0].total_credit != null ? parseFloat(total_data.provider_credit[0].total_credit).toFixed(2) : 0;
                var providerDebit = total_data.provider_debit[0].total_debit && total_data.provider_debit[0].total_debit != null ? parseFloat(total_data.provider_debit[0].total_debit).toFixed(2) :0 ;
                var fleetCredit = total_data.fleet_credit[0].total_credit && total_data.fleet_credit[0].total_credit != null ? parseFloat(total_data.fleet_credit[0].total_credit).toFixed(2) : 0;
                var fleetDebit = total_data.fleet_debit[0].total_debit && total_data.fleet_debit[0].total_debit != null ? parseFloat(total_data.fleet_debit[0].total_debit).toFixed(2) :0 ;
                var currency = total_data.currency && total_data.currency.currency != null ? total_data.currency.currency :"$" ;

                $('.user_data').text((total_data.userdata ? total_data.userdata:0));
                $('.provider_data').text((total_data.providerdata ? total_data.providerdata:0));
                $('.fleet_data').text((total_data.fleetdata ? total_data.fleetdata:0));
                $('.admin_credit').text(currency+adminCredit);
                $('.provider_credit').text(currency+ providerCredit);
                $('.provider_debit').text(currency+ providerDebit);
                $('.fleet_credit').text(currency+ fleetCredit);
                $('.fleet_debit').text(currency+ fleetDebit);
                $('.commission').text(currency+ adminCommission);
                $('.discount').text(currency+adminDiscount);
                $('.tax_amount').text(currency+ adminTax);
            }
            hideLoader();
        }
    });

}

/* end   */


/* Shop data  */
function shopdata(id){
$.ajax({
        type:"GET",
        url: getBaseUrl() + "/admin/store/dashboards/"+id,
        'beforeSend': function (request) {
                showLoader();
            },
        headers: {
            Authorization: "Bearer " + getToken("admin")
        },
        success:function(data){
            var total_data=data.responseData;
            if(total_data){
              $('.shop_data').text(total_data.storedata);
              overalldata[1]=total_data.overall_data;
            }

            hideLoader();
        }
});
}

/* end   */

$('.country').change(function(){
    var country_id=$('.country').val();
    localStorage.setItem("mycountry", country_id);

    location.reload();
});




    //https://www.chartjs.org/samples/latest/charts/pie.html
     var GetTransportData = function (id) {

            $.ajax({
                url: getBaseUrl() + "/admin/transportdashboard/"+id,
                type:"GET",
                'beforeSend': function (request) {
                showLoader();
                },
                headers: {
                    Authorization: "Bearer " + getToken("admin")
                },
                success: function (data) {
                    var cancel_data=data.responseData.cancelled_data;
                    var complete_data=data.responseData.completed_data;
                    var max = data.responseData.max;
                    overalldata[0] = data.responseData.overall;
                    config = {
                    type: 'line',
                    data: {
                        labels: window.Months2,
                        datasets: [ {
                            label: '{{ __('admin.dashboard.completed_rides') }}',
                            data:complete_data,
                            backgroundColor: window.chartColors.green,
                            borderColor: window.chartColors.green,
                            fill: false,
                            pointHoverRadius: 10,
                        }, {
                            label: '{{ __('admin.dashboard.cancelled_rides') }}',
                            data:cancel_data,
                            backgroundColor: window.chartColors.red,
                            borderColor: window.chartColors.red,
                            fill: false,
                            pointHitRadius: 20,
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'bottom',
                        },
                        hover: {
                            mode: 'index'
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: '{{ __('admin.include.month') }}'
                                }
                            }],
                            yAxes: [{
                                display: (max > 0 ? true : false),
                                scaleLabel: {
                                    display: (max > 0 ? true : false),
                                    labelString: '{{ __('admin.include.value') }}'
                                },ticks: {
                                    min: 0,
                                    max: max,

                                    // forces step size to be 5 units
                                    stepSize: (Math.round(max / 100) * 100)/10
                                }
                            }]
                        },
                        title: {
                            display: true,
                            text: ''
                        }
                    }
                }
                var ctx = document.getElementById('canvas').getContext('2d');
                window.myLine = new Chart(ctx, config);
               hideLoader();

               }

            })
      };


      var GetServiceData = function (id) {
        $.ajax({
                url: getBaseUrl() + "/admin/service/Servicedashboard/"+id,
                type:"GET",
                'beforeSend': function (request) {
                showLoader();
                },
                headers: {
                    Authorization: "Bearer " + getToken("admin")
                },
                success: function (data) {
                    var cancel_data=data.responseData.cancelled_data;
                    var complete_data=data.responseData.completed_data;
                    var max=data.responseData.max;
                    overalldata[2]=data.responseData.overall;
                    config = {
                    type: 'line',
                    data: {
                        labels: window.Months2,
                        datasets: [ {
                            label: '{{ __('admin.dashboard.completed_services') }}',
                            data:complete_data,
                            backgroundColor: window.chartColors.green,
                            borderColor: window.chartColors.green,
                            fill: false,
                            pointHoverRadius: 10,
                        }, {
                            label: '{{ __('admin.dashboard.cancelled_services') }}',
                            data:cancel_data,
                            backgroundColor: window.chartColors.red,
                            borderColor: window.chartColors.red,
                            fill: false,
                            pointHitRadius: 20,
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'bottom',
                        },
                        hover: {
                            mode: 'index'
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: '{{ __('admin.include.month') }}'
                                }
                            }],
                            yAxes: [{
                                display: (max > 0 ? true : false),
                                scaleLabel: {
                                    display: (max > 0 ? true : false),
                                    labelString: '{{ __('admin.include.value') }}'
                                },ticks: {
                                    min: 0,
                                    max: max,

                                    // forces step size to be 5 units
                                    stepSize: (Math.round(max / 100) * 100)/10
                                }
                            }]
                        },
                        title: {
                            display: true,
                            text: ''
                        }
                    }
                }
                var ctx = document.getElementById('canvas1').getContext('2d');
                window.myLine = new Chart(ctx, config);
               hideLoader();

               }

            })
      };


      var GetStoreData = function (id) {
         $.ajax({
                url: getBaseUrl() + "/admin/store/Storedashboard/"+id,
                type:"GET",
                'beforeSend': function (request) {
                showLoader();
                },
                headers: {
                    Authorization: "Bearer " + getToken("admin")
                },
                success: function (data) {
                    var cancel_data=data.responseData.cancelled_data;
                    var complete_data=data.responseData.completed_data;
                    var max=data.responseData.max;
                    config = {
                    type: 'line',
                    data: {
                        labels: window.Months2,
                        datasets: [ {
                            label: '{{ __('admin.dashboard.completed_orders') }}',
                            data:complete_data,
                            backgroundColor: window.chartColors.green,
                            borderColor: window.chartColors.green,
                            fill: false,
                            pointHoverRadius: 10,
                        }, {
                            label: '{{ __('admin.dashboard.cancelled_orders') }}',
                            data:cancel_data,
                            backgroundColor: window.chartColors.red,
                            borderColor: window.chartColors.red,
                            fill: false,
                            pointHitRadius: 20,
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'bottom',
                        },
                        hover: {
                            mode: 'index'
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: '{{ __('admin.include.month') }}'
                                }
                            }],
                            yAxes: [{
                                display: (max > 0 ? true : false),
                                scaleLabel: {
                                    display: (max > 0 ? true : false),
                                    labelString: '{{ __('admin.include.value') }}'
                                },ticks: {
                                    min: 0,
                                    max: max,

                                    // forces step size to be 5 units
                                    stepSize: (Math.round(max / 100) * 100)/10
                                }
                            }]
                        },
                        title: {
                            display: true,
                            text: ''
                        }
                    }
                }

                var ctx = document.getElementById('canvas2').getContext('2d');
                window.myLine = new Chart(ctx, config);
                hideLoader();

               }

            })
      };



function pie (){
 var config1 = {
            type: 'pie',
            data: {
                datasets: [{
                    data:[overalldata[0],overalldata[1],overalldata[2]],
                    backgroundColor: [
                        window.chartColors.red,
                        window.chartColors.blue,
                        window.chartColors.yellow
                    ],
                    label: '{{ __('admin.include.overral') }}'
                }],
                labels: [
                    '{{ __('admin.include.transport') }}',
                    '{{ __('admin.include.orders') }}',
                    '{{ __('admin.provides.services') }}'
                ]
            },
            options: {
                responsive: true
            }
        };
var ctx1 = document.getElementById('chart-area').getContext('2d');
           window.myPie = new Chart(ctx1, config1);

}

//$(".country").trigger('change');

dashboarddata(country_id);
    shopdata(country_id);
    GetTransportData(country_id);
    GetServiceData(country_id);
    GetStoreData(country_id);
    setTimeout(function(){  pie();  }, 1500);



</script>

@stop
