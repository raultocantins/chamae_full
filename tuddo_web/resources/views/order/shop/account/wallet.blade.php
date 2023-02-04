@extends('order.shop.layout.base')

@section('title') Wallet @stop

@section('styles')
@parent
    <link rel="stylesheet" href="{{ asset('assets/plugins/data-tables/css/dataTables.bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/data-tables/css/responsive.bootstrap.min.css')}}">
@stop

@section('content')
<div class="main-content-container container-fluid px-4">
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Wallet</span>
            <h3 class="page-title">Wallet</h3>
        </div>
    </div>
    <div class="row mb-4 mt-20">
        <div class="col-md-12">
            <div class="card card-small">
                <div class="card-header border-bottom">
                    <h6 class="m-0 pull-left">Wallet</h6>
                    <!-- <a href="#" style="margin-left: 1em;" class="btn btn-success pull-right" data-toggle="modal" data-target="#add-money-modal"><i class="fa fa-plus"></i> Add Money to Wallet</a> -->
                </div>
              <table id="data-table" class="table table-hover table_width display">
                <thead>
                    <tr>
                        <th>{{ __('admin.id') }}</th>
                        <th>{{ __('provider.transaction_ref') }}</th>
                        <th>{{ __('provider.transaction_desc') }}</th>
                        <th>{{ __('provider.status') }}</th>
                        <th>{{ __('provider.amount') }}</th>
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
    var table = $(tableName)

     //For card listing details
     table = table.DataTable( {
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "ajax": {
            "url": getBaseUrl() + "/shop/wallet",
            "type": "GET",
            'beforeSend': function (request) {
                showLoader();
            },
            "headers": {
                "Authorization": "Bearer " + getToken("shop")
            },
            data: function(data){
                var info = $(tableName).DataTable().page.info();
                delete data.columns;

                data.page = info.page + 1;
                data.search_text = data.search['value'];
                data.order_by = $(tableName+' tr').eq(0).find('th').eq(data.order[0]['column']).data('value');
                data.order_direction = data.order[0]['dir'];

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
            { "data": "id" ,render: function (data, type, row, meta) {
               return meta.row + meta.settings._iDisplayStart + 1;
            } },

            { "data": "transaction_alias" },
            { "data": "transaction_desc" },

            { "data": "type" ,render: function (data, type, row, meta) {
               if(data=="C"){
                return "Credit";
               }else{
                return "Debit";
               }
            } },
            { "data": "amount" ,render: function (data, type, row, meta) {
               return  row.stores_details.currency_symbol+data;
            } },

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
</script>

@stop
