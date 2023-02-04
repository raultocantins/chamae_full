class MainComponent extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            status: 'SEARCHING',
            defaultComponent: 'DISPATCHER-LIST',
            request: []
        };
    }

    handleUpdateStatus = (status, defaultComponent) => {
        this.setState({
            status:status,
            defaultComponent: defaultComponent
        });
    }

    handleProvider = (request, e) => {

        this.setState({
            status:status,
            defaultComponent: 'DISPATCHER-ASSIGN',
            request: request
        });
    }

    render() {

        let defaultComponent = null;

        if(this.state.defaultComponent == "DISPATCHER-LIST") {
            defaultComponent =  <DispatcherListComponent status={this.state.status} assignProvider={this.handleProvider }  />;
        } else if(this.state.defaultComponent == "DISPATCHER-ASSIGN") {
            defaultComponent =  <DispatcherAssignComponent status={this.state.status} request={this.state.request}  />;
        } else if(this.state.defaultComponent == "ASSIGNED-LIST") {
            defaultComponent =  <AssignedListComponent status={this.state.status}  />;
        } else if(this.state.defaultComponent == "CANCELLED-LIST") {
            defaultComponent =  <CancelledListComponent status={this.state.status}  />;
        } else if(this.state.defaultComponent == "ADD-REQUEST") {
            defaultComponent =  <DispatcherRequestComponent status={this.state.status}  />;
        }

        return (<div>
                    <div className="tabs">
                        <div className="tab-button-outer">
                            <ul id="tab-button" style={{ cursor: 'pointer'}}>
                                <li className={this.state.status == "SEARCHING" ? "is-active" : "" } onClick={this.handleUpdateStatus.bind(this, 'SEARCHING', 'DISPATCHER-LIST')}><a><i className="fa fa-search"></i> Pesquisando</a></li>
                                <li className={this.state.status == "ASSIGNED" ? "is-active" : "" } onClick={this.handleUpdateStatus.bind(this, 'ASSIGNED', 'ASSIGNED-LIST')}><a><i className="fa fa-user"></i> Atribuído</a></li>
                                <li className={this.state.status == "CANCELLED" ? "is-active" : "" } onClick={this.handleUpdateStatus.bind(this, 'CANCELLED', 'CANCELLED-LIST')}><a><i className="fa fa-times"></i> Cancelado</a></li>
                                <li className={this.state.status == "REQUEST" ? "is-active" : "" } onClick={this.handleUpdateStatus.bind(this, 'REQUEST', 'ADD-REQUEST')}><a><i className="fa fa-plus"></i> Adicionar</a></li>
                            </ul>
                        </div>
                    </div>
                    {
                        defaultComponent
                    }
                </div>);
    }
}

class DispatcherListComponent extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            requests: []
        };
    }

    componentDidMount() {
        this.getStatus();
        //window.polling = setInterval(() => this.getStatus(), 5000);

        var that = this;
        var socket = io.connect(window.socket_url);
        socket.emit('joinCommonRoom', `room_${window.room}`);
        socket.off().on('socketStatus', function (data) {
            console.log('You are connected to common room');
        });
        socket.off().on('newRequest', function (data) {
            that.getStatus();
        });
        setTimeout(() => {
            initMap();
        }, 2000);

    }

    componentWillUnmount() {
       //clearInterval(window.polling);
    }

    handleClick(request, e) {
        if(request.request.request_type == "MANUAL") {
            this.props.assignProvider(request);
        } else {
            alertMessage("Error", "Auto assigned requests cannot be assigned", "danger");
        }

    }

    handleCancel(request, e) {
        e.stopPropagation();
        if(request.request.request_type == "MANUAL") {

            var url = '';

            if(request.request.ride_type_id != "" || request.request.ride_type_id != "null") {
                url = getBaseUrl() + "/admin/dispatcher/ride/cancel";
            } else {
                url = getBaseUrl() + "/admin/dispatcher/service/cancel";
            }

            $.ajax({
                url: url,
                type: "post",
                headers: {
                    Authorization: "Bearer " + getToken("admin")
                },
                data: {
                    id: request.request.id,
                    admin_service: request.service.admin_service,
                    city_id: request.city_id,
                },
                success: (response, textStatus, jqXHR) => {
                    location.reload();
                }, error: (jqXHR, textStatus, errorThrown) => {}
            });
        } else {
            alertMessage("Error", "Auto assigned requests cannot be assigned", "danger");
        }
    }

    getStatus() {
        $.ajax({
            url: getBaseUrl() + "/admin/dispatcher/trips?type="+this.props.status,
            type: "get",
            processData: false,
            contentType: false,
            headers: {
                Authorization: "Bearer " + getToken("admin")
            },
            success: (response, textStatus, jqXHR) => {
                var data = parseData(response);
                this.setState({
                    requests: (data.responseData.length > 0) ? data.responseData : [],
                });
            }, error: (jqXHR, textStatus, errorThrown) => {}
        });
    }

    render() {

        let requests = this.state.requests;

        return (
                    <div className="tab-contents row">
                        <div className="col-md-4 p-0 bg-body">
                            <div className="tab_sub_title">
                                <h6 className="m-0">Lista de Pesquisa</h6>
                            </div>

                            <div className="tab_body fnt_weight_400 c-pointer">

                            {(requests.length > 0) ?

                            requests.map((request) =>
                                <div key={request.id} onClick={ this.handleClick.bind(this, request) } className="bg-white m-lr-20 shadow-sm">
                                  {(() => {
                                   switch(request.service.admin_service) {
                                        case 'TRANSPORT':
                                        return <div>
                                            <div className="ribbon">{request.service.display_name} {request.request.ride_type ? ' - ' + request.request.ride_type.ride_name : ''}</div>
                                            <a className="btn btn-sm btn-green float-right m-2">{request.request.status}</a>
                                            <div className="p-2">
                                                <p className="font_16 txt_clr_2 fnt_weight_500">{request.user.first_name} {request.user.last_name}</p>
                                                <p className="font_14">De: {request.request.s_address}</p>
                                                <p className="font_14">Para: {request.request.d_address}</p>
                                                <p className="font_14">Pagamento: {request.request.payment_mode}</p>
                                                <p className="font_16"> {(request.request.request_type == "MANUAL") ? "Manual" : "Auto" } Atribuído : {request.request.assigned_time}</p>
                                                {/* <a className="btn btn-sm btn-blue m-2">Invoice</a> */}
                                                <a className=" m-2 c-pointer btn btn-red" href="javascript:;" onClick={ this.handleCancel.bind(this, request) }>Cancelar <i className="material-icons">cancel</i></a>
                                            </div> </div>

                                        case 'SERVICE':
                                        return <div>
                                            <div className="ribbon">{request.service.display_name} {request.request.service ? ' - ' + request.request.service.service_category.service_category_name : ''}</div>
                                            <a className="btn btn-sm btn-green float-right m-2">{request.request.status}</a>
                                            <div className="p-2">
                                                <p className="font_16 txt_clr_2 fnt_weight_500">{request.user.first_name} {request.user.last_name}</p>
                                                <p className="font_14">De: {request.request.s_address}</p>
                                                <p className="font_14">Para: {request.request.d_address}</p>
                                                <p className="font_14">Pagamento: {request.request.payment_mode}</p>
                                                <p className="font_16"> {(request.request.request_type == "MANUAL") ? "Manual" : "Auto" } Atribuído : {request.request.assigned_time}</p>
                                                {/* <a className="btn btn-sm btn-blue m-2">Invoice</a> */}
                                                <a className=" m-2 c-pointer btn btn-red" href="javascript:;" onClick={ this.handleCancel.bind(this, request) }>Cancelar <i className="material-icons">cancel</i></a>
                                            </div> </div>
                                       case 'ORDER':
                                       return <div>
                                           <div className="ribbon">{request.service.admin_service} - {request.request.invoice.items[0].store.store_name}</div>
                                            <a className="btn btn-sm btn-green float-right m-2">{request.request.status}</a>
                                            <div className="p-2">
                                                <p className="font_16 txt_clr_2 fnt_weight_500">{request.user.first_name} {request.user.last_name}</p>
                                                <p className="font_14">End. Estabelecimento: {request.request.pickup.store_location}</p>
                                                <p className="font_14">End. Usuário: {request.request.delivery.map_address}</p>
                                                {/* <a className="btn btn-sm btn-blue m-2">Invoice</a> */}
                                                <a className=" m-2 c-pointer btn btn-red" href="javascript:;" onClick={ this.handleCancel.bind(this, request) }>Cancel <i className="material-icons">cancel</i></a>
                                            </div> </div>
                                    }
                                })()}


                                </div>
                                )
                            : <p className="ml-10">Nenhum resultado</p> }


                            </div>

                        </div>

                        <div className="col-md-8">
                            <div className="tab_sub_title">
                                <h6 className="m-0">Mapa</h6>
                            </div>
                            <div id="map" style={{ height: '500px'}}></div>
                        </div>
                    </div>
        );
    }
}

class DispatcherRequestComponent extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            request: {
                first_name: '',
                last_name: '',
                email: '',
                mobile: '',
                country: '',
                city: '',
                s_address: '',
                d_address: '',
                ride_type_id: '',
                sub_category_id: '',
                provider_service: '',
                distance: '',
                auto_assign: '1' },
            errors: {},
            main_service: [],
            selected_main_service: '',
            provider_subcategory: [],
            service: [],
            countries: [],
            currency: '',
        };
        this.handleChild = this.handleChild.bind(this);
    }

    componentDidMount() {
        //initMap();
        this.setState({currency: $('#getCurrency').attr('data-value')})

        window.createRideInitialize();

        $(".phone").intlTelInput({
            initialCountry: window.country_code,
          });

        $('input[name=schedule_date]').datepicker({
            rtl: false,
            orientation: "left",
            todayHighlight: true,
            autoclose: true,
            startDate:new Date()
        });

        $('input[name=schedule_time]').clockpicker();

        $.ajax({
            url: getBaseUrl() + "/admin/services/main/list",
            type: "get",
            headers: {
                Authorization: "Bearer " + getToken("admin")
            },
            beforeSend: function (request) {
                showInlineLoader();
            },
            success: (response, textStatus, jqXHR) => {
                var data = parseData(response);
                this.setState({main_service: data.responseData });
                hideInlineLoader();
            }, error: (jqXHR, textStatus, errorThrown) => {
                hideInlineLoader();
            }
        });

        $.ajax({
            url: getBaseUrl() + "/user/countries",
            type: "post",
            data: {
               salt_key: window.salt_key
            },
            success: (data, textStatus, jqXHR) => {
               var countries = data.responseData;
               this.setState({countries: countries});
            },
            error: (jqXHR, textStatus, errorThrown) => {}
         });

    }

    validate = () => {

        const errors = {};

        const request = this.state.request;

        if(request.first_name.trim() === '')
            errors.first_name = 'Preencha o primeiro nome';

        if(request.last_name.trim() === '')
            errors.last_name = 'Preencha o último nome';

        if(request.email.trim() === '')
            errors.email = 'Preencha o Email';

        if(request.mobile.trim() === '')
            errors.mobile = 'Preencha o celular';

        if(request.country.trim() === '')
            errors.country = 'Preencha o País';

        if(request.city.trim() === '')
            errors.city = 'Preencha a Cidade';

        if(request.s_address.trim() === '')
            errors.source_address = 'Preencha o endereço de partida';

        if(request.d_address.trim() === '' && $('select[name=admin_service] option:selected').data('service') == 'TRANSPORT')
            errors.destination_address = 'Preencha o endereço de destino';

        if(request.provider_service.trim() === '')
            errors.provider_service = 'Preencha o tipo de serviço';

        return Object.keys(errors).length === 0 ? null : errors;
    }

    handleChild(e) {
        console.log(e)
        let obj = {
            method: 'GET',
            headers: {
                Authorization: "Bearer " + getToken("admin")
            }
        }
        let root = this
        let url = getBaseUrl() + '/admin/services/child/list/'+e.target.value
        fetch(url, obj).then(function(res) {
            return res.json();
        }).then(function(resJson) {
            root.setState({provider_subcategory: resJson.responseData})
        })
        const errors = { ...this.state.errors };
        const request = {...this.state.request};
        if(e.target.value !== '' ) {
            delete errors['provider_service'];
        }

        request['provider_service'] = e.target.value;
        this.setState({request, errors});
    }

    handleChange = ({currentTarget: input}) => {
        const errors = { ...this.state.errors };
        const request = {...this.state.request};

        if(input.value.trim() !== '' ) {
            delete errors[input.name];
        }

        request[input.name] = input.value;
        this.setState({request, errors});
    }

    handleSubmit = e => {
        e.preventDefault();

        const errors = this.validate();
        this.setState({errors: errors || {} });

        if(errors) return;

        var url = '';

        if($('select[name=admin_service] option:selected').data('service') == "TRANSPORT") {
            url = getBaseUrl() + "/admin/dispatcher/ride/request";
        } else if($('select[name=admin_service] option:selected').data('service') == "SERVICE") {
            url = getBaseUrl() + "/admin/dispatcher/service/request";
        }

        $.ajax({
            url: url,
            type: "post",
            headers: {
                Authorization: "Bearer " + getToken("admin")
            },
            beforeSend: function (request) {
            showInlineLoader();
            },
            data: {
                first_name: $('input[name=first_name]').val(),
                last_name: $('input[name=last_name]').val(),
                email: $('input[name=email]').val(),
                country_code: $('.phone').intlTelInput('getSelectedCountryData').dialCode,
                mobile: $('input[name=mobile]').val(),
                country_id: $('select[name=country]').val(),
                city_id: $('select[name=city]').val(),
                s_address: $('input[name=s_address]').val(),
                s_latitude: $('input[name=s_latitude]').val(),
                s_longitude: $('input[name=s_longitude]').val(),
                d_address: $('input[name=d_address]').val(),
                d_latitude: $('input[name=d_latitude]').val(),
                d_longitude: $('input[name=d_longitude]').val(),
                schedule_date: $('input[name=schedule_date]').val(),
                schedule_time: $('input[name=schedule_time]').val(),
                service_id: $('select[name=provider_service]').val(),
                provider_subcategory_id: $('select[name=provider_subcategory]').val(),
                ride_type_id: $('select[name=ride_type_id]').val(),
                provider_service_id: $('select[name=provider_service]').val(),
                sub_category_id: $('select[name=sub_category_id]').val(),
                distance: $('input[name=distance]').val(),
                provider_id: $('input[name=provider_id]').val(),
            },
            success: (response, textStatus, jqXHR) => {
                 hideInlineLoader();
                location.reload();
                // console.log(response);
            }, error: (jqXHR, textStatus, errorThrown) => {
                 hideInlineLoader();
                alertMessage(textStatus, jqXHR.responseJSON.message, "danger");
            }
        });
    }

    getService = e => {

        const request = {...this.state.request};
        request['ride_type_id'] = '';
        this.setState({request: request, service: [] });

        if(e.currentTarget.value != "") {
            var selectedText = e.currentTarget.options[e.currentTarget.selectedIndex].getAttribute('data-service');
            $('.d_address').show();
            if(selectedText != "TRANSPORT") {
                $('.d_address').hide();
            }

            $.ajax({
                url: getBaseUrl() + "/admin/services/list/"+selectedText,
                type: "get",
                headers: {
                    Authorization: "Bearer " + getToken("admin")
                },
                success: (response, textStatus, jqXHR) => {
                    var data = parseData(response);
                    this.setState({selected_main_service: selectedText, service: data.responseData });
                }, error: (jqXHR, textStatus, errorThrown) => {}
            });
        }
    }

    render() {

        let {request, errors } = this.state;

        return (
                    <div className="tab-contents row">

                        <div className="modal" id="providerModal">
                            <div className="modal-dialog">
                                <div className="modal-content">
                                    <div className="modal-header">
                                    <h4 className="modal-title">Lista de Provedores</h4>
                                    <button type="button" className="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div className="modal-body">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="col-md-4" style={{maxHeight:'500px', overflowY:'auto'}}>
                            <div className="tab_sub_title">
                                <h6 className="m-0">Detalhes da Corrida</h6>
                            </div>

                            <form onSubmit={this.handleSubmit} id="form-create-ride">
                                <div className="form-row ">
                                    <div className="form-group col-md-6">
                                        <label htmlFor="first_name">Primeiro Nome</label>
                                        <input type="text" className="form-control" id="first_name" placeholder="Primeiro Nome" name="first_name" onChange={this.handleChange} value={request.first_name} />
                                        {errors && <div className="text-danger">{errors.first_name}</div>}
                                    </div>
                                    <div className="form-group col-md-6">
                                        <label htmlFor="last_name">Último Nome</label>
                                        <input type="text" className="form-control" id="last_name" placeholder="Último Nome" name="last_name" onChange={this.handleChange} value={request.last_name} />
                                        {errors && <div className="text-danger">{errors.last_name}</div>}
                                    </div>
                                </div>
                                <div className="form-row">
                                    <div className="form-group col-md-6">
                                        <label htmlFor="email">Email</label>
                                        <input type="email" className="form-control" id="email" placeholder="Email" name="email" onChange={this.handleChange} value={request.email} />
                                        {errors && <div className="text-danger">{errors.email}</div>}
                                    </div>
                                    <div className="form-group col-md-6">
                                        <label htmlFor="mobile">Telefone</label>
                                        <input type="text" className="form-control intl-tel phone" id="mobile" placeholder="Telefone" name="mobile" onChange={this.handleChange} value={request.mobile} />
                                        {errors && <div className="text-danger">{errors.mobile}</div>}
                                    </div>
                                </div>
                                <div className="form-row">
                                    <div className="form-group col-md-6">
                                        <label htmlFor="country">País</label>
                                        <select name="country" className="mb-4 form-control" onChange={this.handleChange} >
                                            <option value="">Selecione</option>
                                            {this.state.countries.map((country, index) => {
                                                return <option key={`a_${index}`} value={country.id}>{country.country_name}</option>;
                                            })}
                                        </select>
                                        {errors && <div className="text-danger">{errors.country}</div>}
                                    </div>
                                    <div className="form-group col-md-6">
                                        <label htmlFor="city">Cidade</label>
                                        <select name="city" className="mb-4 form-control" onChange={this.handleChange}>
                                            <option value="">Selecione</option>
                                            { ((this.state.countries.filter((item) => item.id == this.state.request.country)).length > 0) ? this.state.countries.filter((item) => item.id == this.state.request.country)[0].city.map((city, index) => {
                                                return <option key={`b_${index}`} value={city.id}>{city.city_name}</option>;
                                            }) : "" }
                                        </select>
                                        {errors && <div className="text-danger">{errors.city}</div>}
                                    </div>
                                </div>

                                <div className="form-group">
                                    <label htmlFor="admin_service">Serviço</label>
                                    <select name="admin_service" className="form-control" id="admin_service" onChange={this.getService}>
                                        <option value="">Selecione</option>
                                        {this.state.main_service.map((service, index) => {
                                            return <option key={`c_${index}`} data-service={service.admin_service} value={service.id}>{service.display_name}</option>;
                                        })}
                                    </select>
                                </div>



                                {(() => {
                                        switch (this.state.selected_main_service) {
                                        case "TRANSPORT":

                                        return <div>
                                                <div className="form-group">
                                                <label htmlFor="admin_service">Categoria</label>
                                                <select name="ride_type_id" className="form-control" onChange={this.handleChange}>
                                                    <option value="">Selecione</option>
                                                    {this.state.service.map((service, index) => {
                                                        return <option key={`d_${index}`} value={service.id}>{service.ride_name}</option>;
                                                    })}
                                                </select>
                                            </div>

                                            <div className="form-group">
                                            <label htmlFor="provider_service">Serviço</label>
                                            <select name="provider_service" id="provider_service" className="form-control" onChange={this.handleChange}>
                                                <option value="">Selecione</option>

                                                { ((this.state.service.filter((item) => item.id == this.state.request.ride_type_id)).length > 0) ? this.state.service.filter((item) => item.id == this.state.request.ride_type_id)[0].servicelist.map((service, index) => {
                                                        return <option key={`e_${index}`} value={service.id}>{service.vehicle_name}</option>;
                                                    }) : "" }
                                            </select>
                                            {errors && <div className="text-danger">{errors.provider_service}</div>}
                                        </div>

                                        </div>;
                                        case "SERVICE":

                                        return <div>
                                                    <div className="form-group">
                                                        <label htmlFor="admin_service">Categoria</label>
                                                        <select name="sub_category_id" className="form-control" onChange={this.handleChange}>
                                                            <option value="">Selecione</option>
                                                            {this.state.service.map((service, index) => {
                                                                return <option key={`d_${index}`} value={service.id}>{service.service_category_name}</option>;
                                                            })}
                                                        </select>
                                                    </div>

                                                    <div className="form-group">
                                                        <label htmlFor="provider_service">Sub Categoria</label>
                                                        <select name="provider_subcategory" id="provider_subcategory" value={this.state.selected_service} className="form-control" onChange={this.handleChild}>
                                                            <option value="">Selecione</option>

                                                            { ((this.state.service.filter((item) => item.id == this.state.request.sub_category_id)).length > 0) ? this.state.service.filter((item) => item.id == this.state.request.sub_category_id)[0].subcategories.map((service, index) => {
                                                                    return <option key={`e_${index}`} value={service.id}>{service.service_subcategory_name}</option>;
                                                                }) : "" }
                                                        </select>
                                                        {errors && <div className="text-danger">{errors.provider_service}</div>}
                                                    </div>

                                                    <div className="form-group">
                                                        <label htmlFor="provider_subcategory">Serviço</label>
                                                        <select name="provider_service" id="provider_service" className="form-control">
                                                            <option value="">Selecione</option>
                                                            {this.state.provider_subcategory.map((service, index) => {
                                                                return <option key={`d_${index}`} value={service.id}>{service.service_name}</option>;
                                                            })}
                                                        </select>
                                                        {errors && <div className="text-danger">{errors.provider_subcategory}</div>}
                                                    </div>

                                            </div>;
                                        }
                                    })()}



                                <div className="form-group">
                                    <label htmlFor="s_address">{ this.state.selected_main_service == "SERVICE" ? "Endereço do Serviço" : "Endereço de Partida" }</label>
                                    <input type="text" className="form-control" id="s_address" name="s_address" placeholder={ this.state.selected_main_service == "SERVICE" ? "Endereço do Serviço" : "Endereço de Partida" } onChange={this.handleChange} />
                                    <input type="hidden" id="s_latitude" name="s_latitude" onChange={this.handleChange} />
                                    <input type="hidden" id="s_longitude" name="s_longitude" onChange={this.handleChange} />
                                    {errors && <div className="text-danger">{errors.source_address}</div>}
                                </div>
                                <div className="form-group d_address">
                                    <label htmlFor="d_address">Endereço de Destino</label>
                                    <input type="text" className="form-control" id="d_address" name="d_address" placeholder="Endereço de Destino" onChange={this.handleChange} />
                                    <input type="hidden" id="d_latitude" name="d_latitude" onChange={this.handleChange} />
                                    <input type="hidden" id="d_longitude" name="d_longitude" onChange={this.handleChange} />
                                    {errors && <div className="text-danger">{errors.destination_address}</div>}
                                </div>
                                <div className="form-group">
                                    <label htmlFor="schedule_time" style={{ float: 'left', width: '100%' }} >Horario Agendado</label>
                                    <input className="form-control col-md-6" style={{ float: 'left' }} type="text" name="schedule_date"  placeholder="Date" />
                                    <input className="form-control col-md-6" style={{ float: 'left' }} type="text" name="schedule_time"  placeholder="Time" />
                                </div>
                                <input type="hidden" id="distance" name="distance" onChange={this.handleChange} />
                                <div className="form-group selected_provider">

                                </div>
                                <div className="form-group">
                                    <label htmlFor="estimated" className="estimate_amount">Valor Estimado : {this.state.currency} <span id="estimated">0</span></label>
                                </div>

                                <br />
                                <button type="reset" className="btn btn-danger">Cancelar</button>
                                <button type="submit" className="btn btn-accent float-right">Enviar</button>
                            </form>

                        </div>

                        <div className="col-md-8">
                            <div className="tab_sub_title">
                                <h6 className="m-0">Mapa</h6>
                            </div>
                            <div id="map" style={{ height: '500px'}}></div>
                        </div>
                    </div>
        );
    }
}

class DispatcherAssignComponent extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            providers: []
        };
    }

    componentDidMount() {
        if(this.props.request.service.admin_service=="ORDER"){
            var url =getBaseUrl() + "/admin/dispatcher/get/providers?store_type_id="+this.props.request.request.pickup.store_type_id+"&latitude="+this.props.request.request.pickup.latitude+"&longitude="+this.props.request.request.pickup.longitude;
        } else if(this.props.request.service.admin_service=="TRANSPORT"){
            var url =getBaseUrl() + "/admin/dispatcher/get/providers?provider_service_id="+this.props.request.request.provider_service_id+"&latitude="+this.props.request.request.s_latitude+"&longitude="+this.props.request.request.s_longitude;
        }

        $.ajax({
            url:url,
            type: "get",
            processData: false,
            contentType: false,
            headers: {
                Authorization: "Bearer " + getToken("admin")
            },
            success: (response, textStatus, jqXHR) => {
                var data = parseData(response);
                this.setState({ providers: []  });

                if((data.responseData).length > 0 ) {
                    this.setState({
                        providers: response.responseData
                    });
                    window.assignProviderShow(response.responseData, this.props.request);
                } else {
                    alertMessage("Error", "Nenhum Provedor disponível", "danger");
                }

            }, error: (jqXHR, textStatus, errorThrown) => {}
        });

    }

    handleClick = (provider) => {
        window.assignProviderPopPicked(provider);
    }

    render() {
        return (<div className="tab-contents row">
        <div className="col-md-4 p-0 bg-body">
            <div className="tab_sub_title">
                <h6 className="m-0">Provedor Atribuído</h6>
            </div>

            <div className="tab_body fnt_weight_400">
                {this.state.providers.map((provider, index) =>
                <div key={index} className="bg-white m-lr-20 shadow-sm" style={{display: 'flex'}} onClick={this.handleClick.bind(this, provider)}>
                    <img className="avt" style={{width: 128, height: 128}} src={provider.picture} />
                    <div className="p-2">
                        <p className="font_16 txt_clr_2 fnt_weight_500"> {provider.first_name}  {provider.last_name}  </p>
                        <p className="font_14">Avaliaçäo: {provider.rating} </p>
                        <p className="font_14">Telefone: {provider.mobile}</p>
                        <p className="font_14">Nome do Serviço : {(provider.service.ride_vehicle ? provider.service.ride_vehicle.vehicle_name : provider.service.vehicle.vehicle_make)} </p>
                    </div>
                </div>
                )}
            </div>

        </div>

        <div className="col-md-8">
            <div className="tab_sub_title">
                <h6 className="m-0">Mapa</h6>
            </div>
            <div id="map" style={{ height: '500px'}}></div>
        </div>
    </div>);
    }
}

class AssignedListComponent extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            requests: []
        };
    }

    componentDidMount() {
        this.getStatus();
        //window.polling = setInterval(() => this.getStatus(), 5000);

        var that = this;
        var socket = io.connect(window.socket_url);
        socket.emit('joinCommonRoom', `room_${window.room}`);
        socket.off().on('socketStatus', function (data) {
            console.log('You are connected to common room');
        });
        socket.off().on('newRequest', function (data) {
            that.getStatus();
        });

        initMap();
    }

    handleClick(request, e) {
        ongoingInitialize(request);
    }

    componentWillUnmount() {
        //clearInterval(window.polling);
    }

    getStatus() {
        $.ajax({
            url: getBaseUrl() + "/admin/dispatcher/trips?type="+this.props.status,
            type: "get",
            processData: false,
            contentType: false,
            headers: {
                Authorization: "Bearer " + getToken("admin")
            },
            success: (response, textStatus, jqXHR) => {
                var data = parseData(response);
                this.setState({
                    requests: (data.responseData.length > 0) ? data.responseData : [],
                });
            }, error: (jqXHR, textStatus, errorThrown) => {}
        });
    }

    render() {

        let requests = this.state.requests;

        return (
                    <div className="tab-contents row">
                        <div className="col-md-4 p-0 bg-body">
                            <div className="tab_sub_title">
                                <h6 className="m-0">Lista de Atribuiçöes</h6>
                            </div>

                            <div className="tab_body fnt_weight_400">

                            {(requests.length > 0) ?

                            requests.map((request) =>
                                <div key={request.id} onClick={ this.handleClick.bind(this, request) } className="bg-white m-lr-20 shadow-sm">
                                    {(() => {
                                   switch(request.admin_service) {
                                        case 'TRANSPORT':
                                        return <div>
                                            <div className="ribbon">{request.service.display_name} {request.request.ride_type ? ' - ' + request.request.ride_type.ride_name : ''}</div>
                                            <a className="btn btn-sm btn-green float-right m-2">{request.request.status}</a>
                                            <div className="p-2">
                                                <p className="font_16 txt_clr_2 fnt_weight_500">{request.user.first_name} {request.user.last_name}</p>
                                                <p className="font_14">De: {request.request.s_address}</p>
                                                <p className="font_14">Para: {request.request.d_address}</p>
                                                <p className="font_14">Pagamento: {request.request.payment_mode}</p>
                                                {request.provider?
                                                <p className="font_14">Provedor Atribuído: {request.provider.first_name}  {request.provider.last_name}</p>
                                                :''}
                                                <p className="font_16"> {(request.request.request_type == "MANUAL") ? "Manual" : "Auto" } Atribuiçäo : {new Date( request.request.assigned_time ).toLocaleDateString("en-Us")}{" "} {new Date( request.request.assigned_time ).toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })}</p>
                                                {/* <a className="btn btn-sm btn-blue m-2">Invoice</a> */}
                                            </div> </div>
                                        case 'SERVICE':
                                        return <div>
                                            <div className="ribbon">{request.service.display_name} {request.request.service ? ' - ' + request.request.service.service_category.service_category_name : ''}</div>
                                            <a className="btn btn-sm btn-green float-right m-2">{request.request.status}</a>
                                            <div className="p-2">
                                                <p className="font_16 txt_clr_2 fnt_weight_500">{request.user.first_name} {request.user.last_name}</p>
                                                <p className="font_14">De: {request.request.s_address}</p>
                                                <p className="font_14">Para: {request.request.d_address}</p>
                                                <p className="font_14">Pagamento: {request.request.payment_mode}</p>
                                                {request.provider?
                                                <p className="font_14">Provedor Atribuído: {request.provider.first_name}  {request.provider.last_name}</p>
                                                :''}
                                                <p className="font_16"> {(request.request.request_type == "MANUAL") ? "Manual" : "Auto" } Atribuiçäo : {new Date( request.request.assigned_time ).toLocaleDateString("en-Us")}{" "} {new Date( request.request.assigned_time ).toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })}</p>
                                                {/* <a className="btn btn-sm btn-blue m-2">Invoice</a> */}
                                            </div> </div>
                                       case 'ORDER':
                                       return <div>
                                           <div className="ribbon">{request.service.admin_service} - {request.request.invoice.items[0].store.store_name}</div>
                                            <a className="btn btn-sm btn-green float-right m-2">{request.request.status}</a>
                                            <div className="p-2">
                                                <p className="font_16 txt_clr_2 fnt_weight_500">{request.user.first_name} {request.user.last_name}</p>
                                                <p className="font_14">Endereço do Estabelecimento: {request.request.pickup.store_location}</p>
                                                <p className="font_14">Endereço do Usuário: {request.request.delivery.map_address}</p>
                                                {request.provider?
                                                <p className="font_14">Provedor Atribuído: {request.provider.first_name}  {request.provider.last_name}</p>
                                                :''}
                                                {/* <a className="btn btn-sm btn-blue m-2">Invoice</a> */}
                                            </div> </div>
                                    }
                                    })()}
                                </div>
                                )
                            : <p className="ml-10">Nenhum resultado</p> }


                            </div>

                        </div>

                        <div className="col-md-8">
                            <div className="tab_sub_title">
                                <h6 className="m-0">Mapa</h6>
                            </div>
                            <div id="map" style={{ height: '500px'}}></div>
                        </div>
                    </div>
        );
    }
}

class CancelledListComponent extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            requests: []
        };
    }

    componentDidMount() {
        this.getStatus();
        //window.polling = setInterval(() => this.getStatus(), 5000);

        var that = this;
        var socket = io.connect(window.socket_url);
        socket.emit('joinCommonRoom', `room_${window.room}`);
        socket.off().on('socketStatus', function (data) {
            console.log('You are connected to common room');
        });
        socket.off().on('newRequest', function (data) {
            that.getStatus();
        });

        initMap();
    }

    handleClick(request, e) {
        ongoingInitialize(request);
    }

    componentWillUnmount() {
        //clearInterval(window.polling);
    }

    getStatus() {
        $.ajax({
            url: getBaseUrl() + "/admin/dispatcher/trips?type="+this.props.status,
            type: "get",
            processData: false,
            contentType: false,
            headers: {
                Authorization: "Bearer " + getToken("admin")
            },
            success: (response, textStatus, jqXHR) => {
                var data = parseData(response);
                this.setState({
                    requests: (data.responseData.length > 0) ? data.responseData : [],
                });
            }, error: (jqXHR, textStatus, errorThrown) => {}
        });
    }

    render() {

        let requests = this.state.requests;

        return (
                    <div className="tab-contents row">
                        <div className="col-md-4 p-0 bg-body">
                            <div className="tab_sub_title">
                                <h6 className="m-0">Lista de Cancelamentos</h6>
                            </div>

                            <div className="tab_body fnt_weight_400">

                            {(requests.length > 0) ?

                            requests.map((request) =>
                                <div key={request.id} onClick={ this.handleClick.bind(this, request) } className="bg-white m-lr-20 shadow-sm">
                                    <div className="ribbon">{request.service.display_name} - {request.request.service ? request.request.service.service_category.service_category_name : (request.request.ride_type?request.request.ride_type.ride_name:'')}</div>
                                    <a className="btn btn-sm btn-green float-right m-2">{request.status}</a>
                                    <div className="p-2">
                                        <p className="font_16 txt_clr_2 fnt_weight_500">{request.user.first_name} {request.user.last_name}</p>
                                        <p className="font_14">De: {request.request.s_address}</p>
                                        <p className="font_14">Para: {request.request.d_address}</p>
                                        <p className="font_14">Pagamento: {request.request.payment_mode}</p>
                                        <p className="font_16"> {(request.request.request_type == "Manual") ? "Manual" : "Auto" } Atribuiçäo : {request.request.assigned_at} </p>
                                        {/* <a className="btn btn-sm btn-blue m-2">Invoice</a> */}
                                        <span className="float-right m-2 c-pointer txt-grey"><i className="material-icons font_20">chat</i> <i className="material-icons font_20">delete</i></span>
                                    </div>
                                </div>
                                )
                            : <p className="ml-10">Nenhum resultado</p> }


                            </div>

                        </div>

                        <div className="col-md-8">
                            <div className="tab_sub_title">
                                <h6 className="m-0">Mapa</h6>
                            </div>
                            <div id="map" style={{ height: '500px'}}></div>
                        </div>
                    </div>
        );
    }
}

ReactDOM.render(<MainComponent />, document.getElementById("root"));
