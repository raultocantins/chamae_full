<header class="topnav" id="myTopnav">
        <div class="container-fluid">
            <div class="col-lg-12 col-md-12 col-sm-12 dis-row p-0">
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a class="" href="/#home">{{ __('Home') }}</a>
                    <a class="" href="/#about">{{ __('Services') }}</a>
                    <a class="" href="/#features">{{ __('Features') }}</a>
                    <a class="" href="/#screenShots">{{ __('How It Works') }}</a>
                </div>
                <div id="mySidenav" class=" dis-ver-center col-md-4 col-sm-12 p-0">
                    <div id="sidebarCollapse" class="active" onclick="openNav()">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <a href="{{URL::to('')}}" class="logo"><img src="{{ Helper::getSiteLogo() }}" class="" alt="logo"></a>
                </div>
                <div class=" col-md-7 p-0 user float-right p-0">
                    <ul class="w-100 dis-flex-end m-0">
                        <li class="menu-item active  d-none d-lg-block d-xl-block"><a class="" href="/#home">{{ __('Home') }}</a>
                        </li>
                        <li class="menu-item  d-none d-lg-block d-xl-block "><a class="" href="/#about">{{ __('Services') }}</a></li>
                        <li class="menu-item  d-none d-lg-block d-xl-block"><a class="" href="/#features">{{ __('Features') }}</a>
                        </li>
                        <li class="menu-item  d-none d-lg-block d-xl-block "><a class="" href="/#screenShots">{{ __('How It Works') }}</a>
                        </li>
                        <li class="menu-item"><a class=" btn-green-secondary" href="javascript:;" onclick="openToggle()">{{ __('Login') }}</a>
                        </li>
                        <li class="menu-item d-none d-lg-block d-xl-block "><a class="btn btn-green" href="/#demo">{{ __('Download') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div id="toggle-bg" onclick="closeToggle()"></div>
    <div class="ongoing-service">
        <div id="sideToggle" class="side-toggle mt-3">
            <a href="javascript:void(0)" class="closebtn" onclick="closeToggle()">&times;</a>
            <ul class="ongoing-list">
                <li>
                    <div class="provider-section bg-green">
                        <h5 class="txt-white">{{ __('UserText') }}</h5>
                        <p class="txt-white">{{ __('Find everything you need to track your success on the road') }}.</p>
                        <div class="dis-column">
                            <a class="btn big-btn" href="{{URL::to('user/login')}}">{{ __('User Sign In') }} <i class="fa fa-arrow-circle-right ml-2"
                                    aria-hidden="true"></i></a>
                            <a class="btn big-btn mt-3" href="{{URL::to('user/login')}}">{{ __('User Sign Up') }} <i
                                    class="fa fa-arrow-circle-right ml-2" aria-hidden="true"></i></a>
                        </div>
                       </div>
                </li>

                <li>
                    <div class="provider-section bg-green">
                        <h5 class="txt-white">{{ __('ProviderText') }}</h5>
                        <p class="txt-white">{{ __('Find everything you need to track your success on the road') }}.</p>
                        <div class="dis-column">
                            <a class="btn big-btn" href="{{URL::to('provider/login')}}">{{ __('Provider Sign In') }} <i class="fa fa-arrow-circle-right ml-2"
                                    aria-hidden="true"></i></a>
                            <a class="btn big-btn mt-3" href="{{URL::to('provider/signup')}}">{{ __('Provider Sign Up') }} <i
                                    class="fa fa-arrow-circle-right ml-2" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="provider-section bg-green">
                        <h5 class="txt-white">{{ __('ShopText') }}</h5>
                        <p class="txt-white">{{ __('Find everything you need to track your success on the road') }}.</p>
                        <div class="dis-column">
                            <a class="btn big-btn" href="{{URL::to('shop/login')}}">{{ __('Shop Sign In') }} <i class="fa fa-arrow-circle-right ml-2"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>