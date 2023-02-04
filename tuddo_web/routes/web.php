<?php

date_default_timezone_set(config('constants.timezone', 'America/Sao_Paulo'));

Route::view('/', 'common/web/home');
Route::view('/home/{lang?}', 'common/web/home');
Route::view('/services/{lang?}', 'common/web/services');

Route::get('/pages/{type}', function ($type) {
    return view('common/web/cmspage', compact('type'));
});




Route::get('/track/{id}', function ($id) {
    return view('common.admin.track', compact('id'));
});

Route::get('/limit', function () {
    //return view('common.admin.limit.index');
    // $data = \PushNotification::app(['environment' => 'production',
    // 'certificate' => '/var/www/html/storage/app/public/apns/user.pem',
    // 'passPhrase'  => '123456',
    // 'service'     => 'apns'])
    // ->to('d8ace3507d71a76392b6f4eaca33fcdd9e49b8705921748302c77f5fa5936023')
    // ->send('Hello World, i`m a push message');
    //     dd($data);
});
