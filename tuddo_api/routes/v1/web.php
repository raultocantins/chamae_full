<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

date_default_timezone_set(config('constants.timezone', 'America/Sao_Paulo'));

$router->get('/', function () use ($router) {
   return view('index');
});

$router->post('verify', 'LicenseController@verify');


$router->post('base', 'V1\Common\CommonController@base');
$router->get('cmspage/{type}', 'V1\Common\CommonController@cmspagetype');

$router->group(['prefix' => 'api/v1'], function ($app) {

	$app->post('user/appsettings', 'V1\Common\CommonController@base');

	$app->post('provider/appsettings', 'V1\Common\CommonController@base');

	$app->get('countries', 'V1\Common\CommonController@countries_list');

	$app->get('states/{id}', 'V1\Common\CommonController@states_list');

	$app->get('cities/{id}', 'V1\Common\CommonController@cities_list');

	$app->post('/{provider}/social/login', 'V1\Common\SocialLoginController@handleSocialLogin');

	$app->post('/chat', 'V1\Common\CommonController@chat');

	$app->post('/provider/update/location', 'V1\Common\Provider\HomeController@update_location');

});

$router->get('/send/{type}/push', 'V1\Common\SocialLoginController@push');

$router->get('v1/docs', ['as' => 'swagger-v1-lume.docs', 'middleware' => config('swagger-lume.routes.middleware.docs', []), 'uses' => 'V1\Common\SwaggerController@docs']);

$router->get('/api/v1/documentation', ['as' => 'swagger-v1-lume.api', 'middleware' => config('swagger-lume.routes.middleware.api', []), 'uses' => 'V1\Common\SwaggerController@api']);

Route::get('/testpush', function(){
	$config = [
		'environment' => 'production',
		'apiKey'      => 'AAAAwjbvKws:APA91bFDW1qxPDC4Sj5A74OiG0y3_1hkeQqT3R0gTgFIIUQ2vZW1R5s0iKYI6HyFmImPpkfTKpx-vkkg-Bx5AZurUgsz5zW0OW8-jPFMNz-S_lgS4LdCQa4gCM6RwunSS6-sX4AHeJ1Y',
		'service'     => 'gcm'
	];

	$message = \PushNotification::Message($this->push_message, array(
		'badge' => 1,
		'sound' => 'default',
		'custom' => [ "message" => [ "topic" => "topic", "notification" => [ "body" => "Teste1", "title" => "Teste2" ], "data" => "da" ] ]
	));

	$device_token = 'c894zBMcRUOG08Fp8D9j_O:APA91bFm8MmZPuUCdA8lcJPg5J4wigiUgzXjMvwGv4q3EDMX429WvxwB3kPq_NhnMBp-ODeM4ll24HduPbg4MRvZdwxeLcv5i14Oz2a0M_fndqH7gImNTpxu8olSkm2rcKI0WLpGNHiw';

	$data = \PushNotification::app($config)->to($device_token)->send($message);

	dd($data);
});