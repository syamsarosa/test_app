<?php

use App\Http\Controllers\ATMController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact_page', ['name' => 'syam', 'address' => 'batam']);
});

Route::get('/atm', [ATMController::class, 'demo']);
