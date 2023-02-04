@extends('common.admin.layout.base')
{{ App::setLocale(  isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : 'pt'  ) }}

@section('title') {{ __('admin.include.provider_earnings') }} @stop

@section('styles')
@parent
    <link rel="stylesheet" href="{{ asset('assets/plugins/data-tables/css/dataTables.bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/data-tables/css/responsive.bootstrap.min.css')}}">
@stop

@section('content')

<div class="main-content-container container-fluid px-4">
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">{{ __('admin.include.provider_earnings') }}</span>
            <h3 class="page-title">{{ __('admin.include.provider_earnings') }} </h3>
        </div>
    </div>
    <div class="row mb-4 mt-20">
        <div class="col-md-12">
            <div class="card card-small">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ __('admin.include.provider_earnings') }}</h6>
                </div>

                <div class="col-md-12">
                    <div class="note_txt">
                        @if(Helper::getDemomode() == 1)
                        <p>** Demo Mode : {{ __('admin.demomode') }}</p>
                        <span class="pull-left">(*personal information hidden in demo)</span>
                        @endif
                    </div>
                </div>

                <table id="data-table" class="table table-hover table_width display">
                <thead>
                    <tr>
                        <td>{{ __('admin.provides.provider_name') }}</td>
                        <td>{{ __('admin.mobile') }}</td>
                        <td>{{ __('admin.status') }}</td>
                        <td id="ridesCount">{{ __('admin.provides.Total_Rides') }}</td>
                        <td id="servicesCount">{{ __('admin.provides.Total_Services') }}</td>
                        <td id="ordersCount">{{ __('admin.provides.Total_Orders') }}</td>
                        <td>{{ __('admin.provides.Total_Earning') }}</td>
                        <td>{{ __('admin.provides.Joined_at') }}</td>
                     </tr>
                 </thead>


                </table>
            </div>
        </div>
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
<script>
var tableName = '#data-table';
var table = $(tableName);
$(document).ready(function() {

    var url = getBaseUrl() + "/admin/statement/provider";
    var keys = {full_name: "Provider Name", mobile: "Mobile", status: "Status", rides_count: "Total Rides", services_count: "Total Services", orders_count: "Total Orders", payment: "Total Earning", joined: "Joined at"};

    datatable_export(url, keys, {{Helper::getEncrypt()}});


    $('body').on('click', '.view', function(e) {
        e.preventDefault();
        alert("PROCESSING");

        // $.get("{{ url('admin/vehicletype/') }}/"+$(this).data('id')+"/view", function(data) {
        //     $('.crud-modal .modal-container').html("");
        //     $('.crud-modal .modal-container').html(data);
        // });
        // $('.crud-modal').modal('show');
    });


    table = table.DataTable( {
        "processing": true,
        "serverSide": true,
        "aoColumnDefs": [{ "bSortable": false, "aTargets": [1,2,3,4,5,6,7]}],
        "ajax": {
            "url": getBaseUrl() + "/admin/statement/provider",
            "type": "GET",
            'beforeSend': function (request) {
                showLoader();
            },
            "headers": {
                "Authorization": "Bearer " + getToken("admin")
            }, data: function(data){
                var info = $(tableName).DataTable().page.info();
                delete data.columns;
                data.page = info.page + 1;
                data.search_text = data.search['value'];
                data.order_by = $(tableName+' tr').eq(0).find('th').eq(data.order[0]['column']).data('value');
                data.order_direction = 'desc';
            },
            dataFilter: function(data){

                var json = parseData( data );

                json.recordsTotal = json.responseData.total;
                json.recordsFiltered = json.responseData.total;
                json.data = json.responseData.data;
                hideLoader();
                return JSON.stringify( json ); // return JSON string
            }
        },
        "columns": [
            { "data": "id", render: function (data, type, row) {
                    return row.first_name+" "+row.last_name;
                  }
            },
            { "data": function (data, type, dataToSet) {
                if({{Helper::getEncrypt()}} == 1){
                    return  protect_number(data.mobile);
                }
                else{
                    return  data.mobile;
                }
            } },
            { "data": "status", render: function (data, type, row) {
                    if(row.status= "approved"){
                        return `<span class="tag tag-success">`+row.status.charAt(0).toUpperCase()+row.status.slice(1)+`</span>`;
                    }
                    else if(row.status= "banned"){
                        return `<span class="tag tag-danger">`+row.status.charAt(0).toUpperCase()+row.status.slice(1)+`</span>`;
                    }
                    else{
                        return `<span class="tag tag-info">`+row.status.charAt(0).toUpperCase()+row.status.slice(1)+`</span>`;
                    }

                 }
            },
            { "data": "rides_count"},
            { "data": "services_count"},
            { "data": "orders_count"},
            { "data": "payment"},
            { "data": "joined" }
        ],
        "columnDefs": [
            {
                'targets': [3],
                'render': function (data, type, row, meta){
                    if(row.rides_count != undefined){
                        return row.rides_count;
                    }else{
                        table.columns([3]).visible(false);
                    }
                }
            },
            {
                'targets': [4],
                'render': function (data, type, row, meta){
                    if(row.services_count != undefined){
                        return row.services_count;
                    }else{
                        table.columns([4]).visible(false);
                    }
                }
            },
            {
                'targets': [5],
                'render': function (data, type, row, meta){
                    if(row.orders_count != undefined){
                        return row.orders_count;
                    }else{
                        table.columns([5]).visible(false);
                    }
                }
            }
        ],
        responsive: true,
        paging:true,
            info:true,
            lengthChange:false,
            dom: 'Bfrtip',
            buttons: [{
               extend: "copy",
               exportOptions: {
                   columns: [":visible :not(:last-child)"]
               }
            }, {
               extend: "csv",
               exportOptions: {
                   columns: [":visible :not(:last-child)"]
               }
            }, {
               extend: "excel",
               exportOptions: {
                   columns: [":visible :not(:last-child)"]
               }
            }, {
               extend: "pdf",
               exportOptions: {
                   columns: [":visible :not(:last-child)"]
               }
            }],"drawCallback": function () {

                var info = $(this).DataTable().page.info();
                if (info.pages<=1) {
                   $('.dataTables_paginate').hide();
                   $('.dataTables_info').hide();
                }else{
                    $('.dataTables_paginate').show();
                    $('.dataTables_info').show();
                }
            }
    } );


} );
</script>
@stop
