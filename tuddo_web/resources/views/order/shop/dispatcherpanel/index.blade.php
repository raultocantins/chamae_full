@extends('order.shop.layout.base')

@section('title') {{ __('Dispatcher Panel') }} @stop

@section('styles')
@parent
    <link rel="stylesheet" href="{{ asset('assets/plugins/data-tables/css/dataTables.bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/data-tables/css/responsive.bootstrap.min.css')}}">
@stop

@section('content')
<div id="btnSound" style="display: none;"></div>
<div class="main-content-container container-fluid px-4">
   <!-- Page Header -->
   <div class="page-header row no-gutters py-4">
	  <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		 <span class="text-uppercase page-subtitle">{{ __('Dashboard') }}</span>
		 <h3 class="page-title">{{ __('Dispatcher') }}</h3>
	  </div>
   </div>
   <!-- TabMenu Start -->
   <div class="row mb-4 mt-20 mt-4">
	  <div class="col-md-12">
		 <div class="card card-small">
			<div class="card-header border-bottom">
			   <h6 class="m-0">{{ __('Request List') }}</h6>
			</div>
			<div class="col-md-12">
				<div id="root"></div>
			</div>
		 </div>
	  </div>
   </div>
   <!-- TabMenu End -->
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


<script crossorigin src="https://unpkg.com/babel-standalone@6.26.0/babel.min.js"></script>
<!-- <script crossorigin src="https://unpkg.com/react@16.8.0/umd/react.production.min.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@16.8.0/umd/react-dom.production.min.js"></script> -->

<script crossorigin src="https://unpkg.com/react@16.8.0/umd/react.development.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@16.8.0/umd/react-dom.development.js"></script>


<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
<script  type="text/babel" src="{{ asset('assets/layout/js/shopdispatcher.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/layout/js/dispatcher-map.js') }}"></script>

<script  type="text/javascript" src="{{ asset('assets/layout/js/qztray.js') }}"></script>
<script  type="text/javascript" src="{{ asset('assets/layout/js/qz_jsrsasign.js') }}"></script>
<script  type="text/javascript" src="{{ asset('assets/layout/js/qz_sign-message.js') }}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key={{Helper::getSettings()->site->browser_key}}&libraries=places" async defer></script>


<script>
    var printerName = '{{Helper::getSettings()->site->printer_name}}';
	//var printerData = '      Pedido: #123456\n\n      03 - X-Tudo\n      01 - CocaCola 2L';
    var printerData = '';

	var tableName = '#data-table';
	var table = $(tableName);
	window.salt_key = '{{Helper::getSaltKey()}}';
	//showLoader();

    function checkPrint(){

        qz.security.setCertificatePromise(function(resolve, reject) {
        resolve("-----BEGIN CERTIFICATE-----\n" +
            "MIIEHTCCAwWgAwIBAgIUfCxpnedjuLoGRPpnnsLrijj0O1UwDQYJKoZIhvcNAQEL\n" +
            "BQAwgZwxCzAJBgNVBAYTAkJSMRIwEAYDVQQIDAlTYW8gUGF1bG8xEjAQBgNVBAcM\n" +
            "CVNhbyBQYXVsbzEQMA4GA1UECgwHTW9iaWxlcjEQMA4GA1UECwwHTW9iaWxlcjEe\n" +
            "MBwGA1UEAwwVKi5tb2JpbGVyc3VwZXIuY29tLmJyMSEwHwYJKoZIhvcNAQkBFhJk\n" +
            "ZXZAbW9iaWxlci5jb20uYnIwIBcNMjIwODExMTg1NzI5WhgPMjA1NDAyMDMxODU3\n" +
            "MjlaMIGcMQswCQYDVQQGEwJCUjESMBAGA1UECAwJU2FvIFBhdWxvMRIwEAYDVQQH\n" +
            "DAlTYW8gUGF1bG8xEDAOBgNVBAoMB01vYmlsZXIxEDAOBgNVBAsMB01vYmlsZXIx\n" +
            "HjAcBgNVBAMMFSoubW9iaWxlcnN1cGVyLmNvbS5icjEhMB8GCSqGSIb3DQEJARYS\n" +
            "ZGV2QG1vYmlsZXIuY29tLmJyMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKC\n" +
            "AQEAzQQxlC9CCXc2kcFcmoTKYFyPW9nH88ZPVZyO5UZmcGqhyem82vK7l6Vn32Yz\n" +
            "KvBhuQkZuuHrc/u1X5BjELoX0wTzuzhth7A5XbgLq7bNZJBhZxwu1wH/R8lOki9Q\n" +
            "pGf0tenwlERxCMey3o96de9deIeqvdxnpeFbQHn1KqjGc5O/G+2+h7fFF4J5AAD3\n" +
            "sDPf95rj+3S7WvFf1rpm54tvxn86zdc72p+97rvdGeIvpPoHIB5TpqPHz1tTLWEK\n" +
            "hP45SHRyTuRfm5vHHLi9taxBs03ZGWBPuITnmrREUo8cRjl0CnFh+zBnuB55Gj3c\n" +
            "MuqCgB8WCfwT8piq8dp3pclqfQIDAQABo1MwUTAdBgNVHQ4EFgQUhUpl2mX2jzyU\n" +
            "8FTSL437aYPrS0MwHwYDVR0jBBgwFoAUhUpl2mX2jzyU8FTSL437aYPrS0MwDwYD\n" +
            "VR0TAQH/BAUwAwEB/zANBgkqhkiG9w0BAQsFAAOCAQEAQELHNmcfkMEFSnP/yjkg\n" +
            "cXPIZiUIU76y51KCfARAmtvepnG8ebryc+lS0hpgUCXXypvYWTmfaAy/bzOsbvxO\n" +
            "FncmlTwa+RGyEuXytNBupgmswx/qrdIPwIRNRSnTa9Z+ehhQhYWvvtson1hj+wlL\n" +
            "4nuDQxO0k+znpth3HujSyfHeRL/mKplmQiiPI389qgFXWKPPOEGRK6ctVKx4Tzv8\n" +
            "FZ3US256UA1Jv6cXARvxIwIkfTYX+oE1yW1TnwPRcojtDLCa+Fjz/nsn23P9ci/s\n" +
            "aFihvskSSC6t9h7CfJiRK3iJ7zrllgc8nv01Oju2MvNmS39Mgy5PoiIdYOQXOHuu\n" +
            "jQ==\n" +
            "-----END CERTIFICATE-----\n");
        });

    }

    function printOrder(_data){
        qz.websocket.connect().then(() => {
            return qz.printers.find(printerName);
        }).then(( found ) => {
            var config = qz.configs.create(found);
            var data = [
                '-----------------------',
                '\n',
                '\n',
                _data,
                '\n',
                '\n',
                '-----------------------',
                '\n',
                '\n',
                '\n',
                '\n',
                '\n',
                '\n',
                '\n',
                '\n',
                '\n',
                '\n',
                '\n',
                '\n'
            ];

            return qz.print(config, data);
        }).catch((e) => {
            console.log(e);
        }).finally(() => {
            return qz.websocket.disconnect();
        });
    }

	$(document).ready(function() {
		$('.add').on('click', function(e) {
			e.preventDefault();
			$.get("{{ url('admin/user/create') }}", function(data) {
				$('.crud-modal .modal-container').html("");
				$('.crud-modal .modal-container').html(data);
			});
			$('.crud-modal').modal('show');
		});

		$('body').on('click', '.edit', function(e) {
			e.preventDefault();
			$.get("{{ url('admin/user/') }}/"+$(this).data('id')+"/edit", function(data) {
				$('.crud-modal .modal-container').html("");
				$('.crud-modal .modal-container').html(data);
			});
			$('.crud-modal').modal('show');
		});

		table = table.DataTable( {
			"processing": true,
			"serverSide": true,
			"pageLength": 10,
			"ajax": {
				"url": getBaseUrl() + "/admin/users",
				"type": "GET",
				'beforeSend': function (request) {
					showLoader();
				},
				"headers": {
					"Authorization": "Bearer " + getToken("admin")
				},
				data: function(data){
					var info = $(tableName).DataTable().page.info();
					delete data.columns;

					data.page = info.page + 1;
					data.search_text = data.search['value'];
					data.order_by = $(tableName+' tr').eq(0).find('th').eq(data.order[0]['column']).data('value');
					data.order_direction = data.order[0]['dir'];



				},
				dataFilter: function(response){
                var json = parseData(response);

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
				}
				},
				{ "data": "first_name" },
				{ "data": "last_name" },
				{ "data": "email" },
				{ "data": "mobile" },
				{ "data": "rating" },
				{ "data": "wallet_balance" },
				{ "data": "id", render: function (data, type, row) {
					return "<button data-id='"+data+"' class='btn btn-block btn-success edit'>Edit</button> <button data-id='"+data+"' class='btn btn-block btn-danger delete'>Delete</button>";
				}}

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

		$('body').on('click', '.delete', function() {
			var id = $(this).data('id');
			var url = getBaseUrl() + "/admin/users/"+id;
			deleteRow(id, url, table);
		});

	} );
</script>
@stop
