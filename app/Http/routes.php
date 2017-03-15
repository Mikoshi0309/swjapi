<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


$api = app('Dingo\Api\Routing\Router');
$api->version('v1',['namespace'=>'App\Http\Controllers\Api\V1'],function($api){
    //登录
    $api->post('auth/login','AuthController@login');
    $api->post('auth/register','AuthController@register');

    $api->group(['middleware'=>'jwt.auth'],function($api){
        $api->get('article','ArticleController@index');
    });
});