<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    #if the item is not found. it will execute a closure to generate the data and store it in the cache for a specified period of time.
    $users = Cache::remember('users', 60, function () {
        return DB::table('users')->get();
    });
    return view('welcome');
});
