<?php

Route::get('/ride/{id?}/transport', function ($id = 0) {

    return view('transport.user.ride.home', compact('id'));
});
Route::view('/trips', 'transport.user.ride.trips');
