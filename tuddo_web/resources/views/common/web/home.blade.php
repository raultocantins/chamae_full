@extends('common.web.layout.base')
{{ App::setLocale(Request::route('lang') !== null ? Request::route('lang') : 'pt') }}
@section('styles')
@parent

@stop
@section('content')

<section id="home" class="top-section dis-center">
        <div class="background-holder background-holder--auto background-holder--left-top d-none d-lg-block d-xl-block "
            style="background-image:  url(assets/layout/images/common/go_x_bg.png); background-repeat: no-repeat; background-size: 100%;">
            <img src="{{ asset('assets/layout/images/common/hero-dots.png') }}" alt="hero-dots" class="background-image-holder " style="display:none;">
        </div>
        <div class="background-holder background-holder--auto background-holder--left-top d-sm-block d-lg-none d-xl-none"
            style="background-image: url(assets/layout/images/common/bgimg1.jpg); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
        </div>
        <div class="overlay d-sm-block d-lg-none d-xl-none"></div>
        <img class="shape1 d-none d-xl-block " src="{{ asset('assets/layout/images/common/round-shape1.png') }}" alt="">
        <img class="shape2 d-none d-xl-block " src="{{ asset('assets/layout/images/common/round-shape3.png') }}" alt="">
        <!-- <img class="bgimg" src="./img/wave.png" alt=""> -->
        <div class="col-12 col-xl-7 col-lg-9 pos-abs-top-right pr-0 d-sm-block d-lg-none d-xl-none">
            <!-- <div class="hero__block5 background-holder--cover background-holder--center ml-auto" style="clip-path: url(&quot;#hero__block5&quot;); width: 800px; height: 680px; background-image: url(&quot;./img/hero-5.png&quot;); background-repeat: no-repeat;">
               <img src="./img/hero-5.png" alt="oval" class="background-image-holder " style="display: none;">
            </div> -->

            <!-- <img src="./img/xjek_app.png" alt="oval" class="background-image-holder img-fluid jump-anim"> -->

            <!-- <svg height="0" width="0">
               <defs>
                  <clipPath id="hero__block5">
                     <path d="M0,0c0,0,18.2,428.9,283.2,549.5S655.1,598.4,800,680V0H0z"></path>
                  </clipPath>
               </defs>
            </svg> -->
        </div>
        <div class="container">
            <div class="banner-section">
                <!-- <div class="col-12 col-lg-6 d-sm-block d-lg-none d-xl-none">
                  <div class="hero__block5-mobile background-holder--cover background-holder--center d-xl-none mx-auto mb-30" style="background-image: url(&quot;./img/landing_bg.png&quot;); background-repeat: no-repeat;">
                     <img src="./img/landing_bg.png" alt="oval" class="background-image-holder " style="display: none;">
                  </div>
               </div> -->
                <div class="col-12 col-lg-6 d-sm-block d-lg-none d-xl-none">

                    <img src="{{ asset('assets/layout/images/common/xjek_app.png') }}" alt="oval" class="background-image-holder img-fluid shape1">

                </div>
                <div class="banner-content col-12 col-lg-6 col-xl-5 z-index1 dis-column-left p-0 ">
                    <h1 class="banner-heading ">{{ __(Helper::getSettings()->site->site_title) }} {{ __('App Development') }}</h1>
                    <p class="mt-4 col-sm-12 col-md-12 col-lg-12 p-0 ">
                    {{ __('Encompass a wide variety of on-demand services from taxi rides and delivery services to babysitting and laundry services in a single') }} {{ __(Helper::getSettings()->site->site_title) }} {{ __('app') }}.
                    </p>
                    <!-- <a class="btn btn-secondary mt-3 bg-white txt-green" href="./login.html"> Buy Now - {{Helper::getSettings()->site->site_title}} App  <i class="fa fa-arrow-circle-right ml-2" aria-hidden="true"></i></a> -->
                </div>
            </div>
        </div>
    </section>
    <section id="about" class="services-list">
        <div class="container-fluid">
            <div class="heading dis-column col-12 col-lg-12">
                <hr>
                <h1 class="text-center"><span class="txt-green">{{ __('ONE APP') }} </span>{{ __('FOR ALL YOUR NEEDS') }}</h1>
                <p class="mt-4 col-sm-12 col-md-12 col-lg-12 p-0 text-center">
                {{ __('We are now developing an app like') }} {{ __(Helper::getSettings()->site->site_title) }}
                {{ __('for entrepreneurs across the world') }}.
                {{ __(Helper::getSettings()->site->site_title) }}
                {{ __('app is an amalgam of a variety of on-demand services onto a single platform') }}. {{ __(Helper::getSettings()->site->site_title) }}
                {{ __('whitelabel solutions are highly customizable and integrated with a myriad of features to choose from. Our ready-made solutions help your startup to innovate and grow faster than your counterparts') }}.
                </p>
                <!-- <a class="btn btn-secondary mt-3 col-md-5 col-lg-3" href="./login.html"> Buy Now - {{Helper::getSettings()->site->site_title}}  <i class="fa fa-arrow-circle-right ml-2" aria-hidden="true"></i></a> -->
            </div>
            <div class="row bg-dots">
                <div class="col-sm-12">
                    <div class="dis-center col-md-12 p-0 dis-center">
                        <ul class="nav nav-tabs " role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#general_info" role="tab"
                                    data-toggle="tab"><img src="{{ asset('assets/layout/images/common/svg/seatbelt.svg') }}">{{ __('Rides') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#password" role="tab"
                                    data-toggle="tab"><img src="{{ asset('assets/layout/images/common/svg/delivery-truck.svg') }}">{{ __('Deliveries') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#payment_method" role="tab"
                                    data-toggle="tab"><img src="{{ asset('assets/layout/images/common/svg/tools.svg') }}">{{ __('Other Services') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix tab-content">
                        <div role="tabpanel" class="tab-pane active col-sm-12 col-md-12 col-lg-12 p-0"
                            id="general_info">
                            <div class="dis-row flex-wrap">
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0 ">
                                    <div class="service-item item-shadow bg-1">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/sedan-car-model.svg') }}">
                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Taxi Ride') }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-2">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/bike.svg') }}">
                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Moto Rental') }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-3">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/package.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Movers') }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane col-sm-12 col-md-12 col-lg-12 p-0" id="password">
                            <div class="dis-row flex-wrap">
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-5">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/chef.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Food') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-6">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/groceries-bag.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Grocery') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-7">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/flower-bouquet.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Flower') }}</h3>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane col-sm-12 col-md-12 col-lg-12 p-0" id="payment_method">
                            <div class="dis-row flex-wrap">
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-4">
                                        <img alt="" class="img-responsive" style="width:60px;"
                                            src="{{ asset('assets/layout/images/common/svg/electricity.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Electrician') }}</h3>

                                        </div>
                                    </div>
                                </div>

                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-8">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/doctor-stethoscope.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Doctor') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-9">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/tap.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Plumber') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-10">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/hair-dryer.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Beauty Services') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-11">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/pawprints.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Dog Walking') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-12">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/laundry.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Laundry') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-13">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/vacuum.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('House Cleaning') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-14">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/toolbox.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Carpenter') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-15">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/lawn-mower.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Lawn Mowing') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-16">
                                        <img alt="" class="img-responsive"
                                            src="{{ asset('assets/layout/images/common/svg/man-on-his-knees-to-cuddle-his-dog.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Cuddling') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-17">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/open-book.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Tutor') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0 ">
                                    <div class="service-item item-shadow bg-18">
                                        <img alt="" class="img-responsive"
                                            src="{{ asset('assets/layout/images/common/svg/essential-oil-drop-for-spa-massage-falling-on-an-open-hand.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Massage') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-19">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/vynil.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('DJ') }}</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="service-list col-md-3 col-lg-2 col-sm-12 p-0">
                                    <div class="service-item item-shadow bg-20">
                                        <img alt="" class="img-responsive" src="{{ asset('assets/layout/images/common/svg/baby-stroller.svg') }}">

                                    </div>
                                    <div class="service-section">
                                        <div class="service-content ">
                                            <h3 class="service-title">{{ __('Baby Sitting') }}</h3>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>

    <section id="features">
        <div class="container-fluid">
            <div class="heading dis-column">
                <hr>
                <h1 class="text-center"><span class="txt-green">{{ __(Helper::getSettings()->site->site_title) }}</span> {{__('App Features') }}</h1>
                <p class="mt-4 col-lg-10 col-md-12 p-0 text-center">
                    {{Helper::getSettings()->site->site_title}} {{ __('depending on what service is required by the user, has three options. The workflow of these respective choices are as follows') }}:
                </p>
            </div>
            <div class="">
                <div class="dis-grid">
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/student.svg') }}" class="feature_box1-icon" alt="PROFILE">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('PROFILE') }}</h4>
                        <p>{{ __('A user/service provider can update their detailed profile and also add/remove their info from the application. It is ensured that information is not stored without the approval or knowledge of a user') }}.</p>
                    </div>
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/book.svg') }}" class="feature_box1-icon" alt="SAVED ADDRESS">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('SAVED ADDRESS') }}</h4>
                        <p>{{ __('Frequently visited addresses can be saved. This eliminates the repetitive entry of a location every time a user travels. For example, a user can add and then automatically choose their home address instead of typing it every time') }}.</p>
                    </div>
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/call.svg') }}" class="feature_box1-icon" alt="SCHEDULE BOOKINGS">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('SCHEDULE BOOKINGS') }}</h4>
                        <p>{{ __('If one needs to commute daily at a routine time, this feature enables them to perform schedule bookings') }}.</p>
                    </div>
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/clock.svg') }}" class="feature_box1-icon" alt="BOOKING RECORDS">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('BOOKING RECORDS') }}</h4>
                        <p>{{ __('This feature keeps a record of the user’s trip destinations, the price of trips and other information. It helps the user in case he/she needs to obtain information on their past trips') }}.</p>
                    </div>
                </div>

                <div class="dis-grid">
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/payment-method.svg') }}" class="feature_box1-icon"
                                alt="MULTIPLE PAYMENT METHODS">
                                <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('MULTIPLE PAYMENT METHODS') }}</h4>
                        <p>{{ __('This feature enables the user to pay through multiple modes like cash, card or any e-commerce payment applications, therefore, making it convenient for users to make payments') }}.</p>
                    </div>
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/gift-card.svg') }}" class="feature_box1-icon" alt="RATE CARD">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('RATE CARD') }}</h4>
                        <p>{{ __('When the user is not sure of proper destination, the rate card gives a rate in accordance with the distance travelled') }}.</p>
                    </div>

                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/route.svg') }}" class="feature_box1-icon" alt="LIVE VEHICLE TRACKING">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('LIVE VEHICLE TRACKING') }}</h4>
                        <p>{{ __('Real-time tracking helps the customer to be aware of the location of their delivery and also for drivers and riders to locate each other') }}.</p>
                    </div>
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/review.svg') }}" class="feature_box1-icon" alt="REVIEWING">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('REVIEWING') }}</h4>
                        <p>{{ __('This feature helps with maintaining quality standards on the application based on feedback received from both service providers and customers') }}.</p>
                    </div>
                </div>

                <div class="dis-grid">

                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/time.svg') }}" class="feature_box1-icon" alt="ESTIMATED TRAVEL TIME">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('ESTIMATED TRAVEL TIME') }}</h4>
                        <p>{{ __('This feature enables one to calculate the estimated travel time from the pick-up point to the destination point') }}.</p>
                    </div>
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/cash.svg') }}" class="feature_box1-icon" alt="TRIP RATE ESTIMATOR">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('TRIP RATE ESTIMATOR') }}</h4>
                        <p>{{ __('Trip Fare estimator helps to calculate the approximate trip fare based on the distance to be travelled') }}.</p>
                    </div>
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/email-notify.svg') }}" class="feature_box1-icon"
                                alt="SMS/ EMAIL NOTIFICATIONS">
                                <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('SMS/ EMAIL NOTIFICATIONS') }}</h4>
                        <p>{{ __('This feature enables the service provider to send notifications or alerts to their customers through SMS or Emails') }}.</p>
                    </div>
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/notification.svg') }}" class="feature_box1-icon" alt="Instant notification">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('INSTANT NOTIFICATION') }}</h4>
                        <p>{{ __('The app instantly alerts or notifies its users on booking status, change/cancellation, payment notifications, etc') }}.</p>
                    </div>
                </div>
                <div class="dis-grid">

                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/call.svg') }}" class="feature_box1-icon" alt="Call features">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('CALL FEATURES') }}</h4>
                        <p>{{ __('Users of the application can communicate with the inbuilt call service provided for them') }}.</p>
                    </div>
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/gift-card.svg') }}" class="feature_box1-icon" alt="Promo code">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('PROMO CODE') }}</h4>
                        <p>{{ __('This feature enables the users of the app to enjoy discounts and offers, thereby bringing in more users') }}.</p>
                    </div>
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/301-gps.svg') }}" class="feature_box1-icon" alt="Geo-Fencing">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('GEO-FENCING') }}</h4>
                        <p>{{ __('Geo-fencing allows the drivers/delivery person to locate the customers and vice versa. Its accuracy goes a long way in increasing the efficiency of the service provided') }}.</p>
                    </div>
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/301-key.svg') }}" class="feature_box1-icon" alt="Authentication">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('AUTHENTICATION') }}</h4>
                        <p>{{ __('This feature helps with maintaining quality standards on the application based on feedback received from both service providers and customers') }}.</p>
                    </div>
                </div>
                <div class="dis-grid">

                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/301-folder.svg') }}" class="feature_box1-icon" alt="Availability Options">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('AVAILABILITY OPTIONS') }}</h4>
                        <p>{{ __('Availability toggles allow users to determine whether drivers/delivery personnel are available to provide their services') }}. </p>
                    </div>
                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/301-check.svg') }}" class="feature_box1-icon" alt="Flexible Vehicle Option">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('FLEXIBLE VEHICLE OPTION') }}</h4>
                        <p>{{ __('An app provides its users with multiple vehicle options to choose from based on their requirements') }}.</p>
                    </div>

                    <div class="item-feature">
                        <div class="icon">
                            <img src="{{ asset('assets/layout/images/common/svg/301-analytics.svg') }}" class="feature_box1-icon" alt="Analytics Tracking">
                            <div class="animation_round"></div>
                        </div>
                        <h4>{{ __('ANALYTICS TRACKING') }}</h4>
                        <p>{{ __('This feature helps collect user-based data to make changes and further improve the services provided') }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="demo">
        <div class="overlay"></div>
        <div class="">
            <div class="row dis-center">
                <div class="heading dis-column">
                    <hr>
                    <h1 class="txt-white">{{ __('Download') }} <span class="txt-white">{{ __(Helper::getSettings()->site->site_title) }}</span> {{ __('Today') }}</h1>
                    <p class="mt-3 col-lg-12 col-md-12 p-0 text-center txt-white">
                    {{ __('Get both the Android and iOS apps for free. After all, building a business doesn’t have to cost you a bomb!') }}
                    </p>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 dis-row">

                    <div class="col-md-12 col-lg-6 col-sm-12 mt-3 dis-column">
                        <h5 class="txt-white">{{ __('User iOS App & Android App') }}</h5>
                        <div class="app-links">

                            <a class="btn btn-lg big-btn mr-2" target="_blank" href="@if(isset(Helper::getSettings()->site->store_link_ios_user)){{ Helper::getSettings()->site->store_link_ios_user}} @else # @endif">
                                <img width="22px" class="pull-left" src="{{ asset('assets/layout/images/common/apple.png') }}">
                                <div class="btn-text"><small>{{ __('Download on the') }}</small><br><strong>{{ __('App Store') }}</strong></div>
                            </a>
                            <a class="btn btn-lg  big-btn" target="_blank" href="@if(isset(Helper::getSettings()->site->store_link_android_user)){{ Helper::getSettings()->site->store_link_android_user}} @else # @endif">
                                <img width="22px" class="pull-left" src="{{ asset('assets/layout/images/common/google-play.png') }}">
                                <div class="btn-text"><small>{{ __('Get it on') }}</small><br><strong>{{ __('Google Play') }}</strong></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-sm-12 mt-3 dis-column">

                        <h5 class="txt-white">{{ __('Provider / Driver iOS App & Android App') }} </h5>
                        <div class="app-links">

                            <a class="btn btn-lg big-btn mr-2" target="_blank" href="@if(isset(Helper::getSettings()->site->store_link_ios_provider)){{ Helper::getSettings()->site->store_link_ios_provider}} @else # @endif">
                                <img width="22px" class="pull-left" src="{{ asset('assets/layout/images/common/apple.png') }}">
                                <div class="btn-text"><small>{{ __('Download on the') }}</small><br><strong>{{ __('App Store') }}</strong></div>
                            </a>
                            <a class="btn btn-lg  big-btn" target="_blank" href="@if(isset(Helper::getSettings()->site->store_link_android_provider)){{ Helper::getSettings()->site->store_link_android_provider}} @else # @endif">
                                <img width="22px" class="pull-left" src="{{ asset('assets/layout/images/common/google-play.png') }}">
                                <div class="btn-text"><small>{{ __('Get it on') }}</small><br><strong>{{ __('Google Play') }}</strong></div>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="col-md-12 col-xl-3 col-sm-12 mt-5 dis-column">

                        <h5 class="txt-white">Website & Admin Panel Demo </h5>
                        <div class="app-links">

                            <a class="btn btn-lg big-btn mr-2" href="#">
                                <img height="22px" class="pull-left" {{ asset('assets/layout/images/common/svg/chef.svg') }}/svg/admin.svg">
                                <strong>Live Demo</strong>
                            </a>
                            <a class="btn btn-lg  big-btn" href="#">
                                <img height="22px" class="pull-left" {{ asset('assets/layout/images/common/svg/chef.svg') }}/svg/web.svg">
                                <strong>Live Demo</strong>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>


    <section class="screenShots" id="screenShots">
        <div class="heading dis-column">
            <hr>
            <h1 class="">{{ __('App') }} <span class="">{{ __('Screenshots') }}</span></h1>
        </div>
            <div class="app-screen" >
                <div class="mobile-mockup text-center">
                    <img alt="" src="{{ asset('assets/layout/images/common/iphone-frame.png') }}">
                </div>
                <div class="swiper-container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img alt="" src="{{ asset('assets/layout/images/common/homepage.png') }}" class="img-responsive">
                        </div>
                        <div class="swiper-slide">
                            <img alt="" src="{{ asset('assets/layout/images/common/home_service.png') }}" class="img-responsive">
                        </div>
                        <div class="swiper-slide">
                            <img alt="" src="{{ asset('assets/layout/images/common/home_show_more.png') }}" class="img-responsive">
                        </div>

                        <div class="swiper-slide">
                            <img alt="" src="{{ asset('assets/layout/images/common/home_go_offline.png') }}" class="img-responsive">
                        </div>
                    </div>
                    <div class="custom_slider_arrows">
                        <ul class="list-inline list-unstyled">
                            <li>
                                <button class="appsLand-btn appsLand-btn-gradient screenShots__style-1__btn-prev">
                                    <span><i class="fa fa-angle-left"></i></span>
                                </button>
                            </li>
                            <li>
                                <button class="appsLand-btn appsLand-btn-gradient screenShots__style-1__btn-next">
                                    <span><i class="fa fa-angle-right"></i></span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @stop

@section('scripts')
@parent
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    function openToggle() {
        document.getElementById("toggle-bg").style.width = "100%";
        document.getElementById("sideToggle").style.right = "-10px";
    }

    function closeToggle() {
        document.getElementById("toggle-bg").style.width = "0";
        document.getElementById("sideToggle").style.right = "-640px";
    }

    $.getJSON('http://gd.geobytes.com/GetCityDetails?callback=?', function(data) {
      $.getJSON('http://www.geoplugin.net/json.gp?ip='+data.geobytesremoteip, function(response) {
         if(response.geoplugin_countryCode == 'AE') {
            if(!( window.location.href ).includes('/ar')) {
                location.replace('/ar');
            }
         }
      });
   });


   // jQuery(document).ready(function ($) {
   //    "use strict";

      // $('#rides').owlCarousel({

      //    items: 3,
      //    margin: 10,
      //    nav: true,
      //    autoplay: true,
      //    dots: true,
      //    autoplayTimeout: 5000,
      //    navText: ['<span class="icon ion-ios-arrow-left"></span>', '<span class="icon ion-ios-arrow-right"></span>'],
      //    smartSpeed: 450,
      //    responsive: {
      //       0: {
      //          items: 1
      //       },
      //       768: {
      //          items: 2
      //       },
      //       1170: {
      //          items: 4
      //       }
      //    }
      // });

      // $('#deliveries').owlCarousel({

      //    items: 3,
      //    margin: 10,
      //    nav: true,
      //    autoplay: true,
      //    dots: true,
      //    autoplayTimeout: 5000,
      //    navText: ['<span class="icon ion-ios-arrow-left"></span>', '<span class="icon ion-ios-arrow-right"></span>'],
      //    smartSpeed: 450,
      //    responsive: {
      //       0: {
      //          items: 1
      //       },
      //       375: {
      //          items: 1
      //       },
      //       768: {
      //          items: 2
      //       },
      //       1170: {
      //          items: 4
      //       }
      //    }
      // });

      // $('#other-services').owlCarousel({
      //    items: 3,
      //    margin: 10,
      //    nav: true,
      //    autoplay: true,
      //    dots: true,
      //    autoplayTimeout: 5000,
      //    navText: ['<span class="icon ion-ios-arrow-left"></span>', '<span class="icon ion-ios-arrow-right"></span>'],
      //    smartSpeed: 450,
      //    responsive: {
      //       0: {
      //          items: 1
      //       },
      //       375: {
      //          items: 1
      //       },
      //       768: {
      //          items: 2
      //       },
      //       1170: {
      //          items: 4
      //       }
      //    }
      // });



</script>

@stop
