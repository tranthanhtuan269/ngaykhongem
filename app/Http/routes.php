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


Route::auth();

Route::group(['middleware' => 'auth'], function () {

    Route::get('user/profile', function () {

    });

    Route::resource('tinh', 'TinhController');

    Route::resource('huyen', 'HuyenController');

    Route::resource('duong', 'DuongController');

    Route::resource('pho', 'PhoController');

    Route::resource('huong', 'HuongController');

    //Route::resource('loaibds', 'LoaibdsController');

    Route::resource('duan', 'DuanController');

    Route::resource('tinbds', 'TinBDSController');

    Route::resource('yeucaunha', 'YeucaunhaController');

    Route::post('yeucaunha/follow', 'YeucaunhaController@addfollowproduct');
    Route::post('yeucaunha/remove_follow', 'YeucaunhaController@removefollowproduct');

    Route::get('/trangcanhan/', 'HomeController@trangcanhan');

    Route::post('/updateUser', 'HomeController@updateUser');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'HomeController@welcome');

    Route::get('/baokim_1a06a47dfa253674.html', 'HomeController@baokim');
    Route::get('/thanhtoanbaokim', 'ActionController@thanhtoanbaokim');
    Route::post('/tienhanhthanhtoan', 'ActionController@tienhanhthanhtoan');
    Route::get('/success', 'ActionController@success');

    Route::get('/thanhtoannganluong', 'ActionController@thanhtoannganluong');

    Route::get('/timnguoimua', 'HomeController@timNguoiMua');
    Route::get('/timnhaban', 'HomeController@index');
    Route::get('/xaydung', 'HomeController@xaydung');
    Route::get('/kientruc', 'HomeController@kientruc');
    Route::get('/noithat', 'HomeController@noithat');
    Route::get('/ngoaithat', 'HomeController@ngoaithat');
    Route::get('/sendemail', 'HomeController@sendemail');
    Route::get('/{id}', 'HomeController@show');
    Route::get('/khu-vuc/{id}', 'KhuvucController@show');
    Route::get('/loaibds/{id}', 'KhuvucController@loaitin');
    Route::post('/updateCall', 'HomeController@updateCall');
    Route::get('/getHuyen/{id}', 'HuyenController@getHuyen');
    Route::get('/getPhuong/{id}', 'HuyenController@getPhuong');
    Route::get('/getDuong/{id}', 'HuyenController@getDuong');
    Route::get('/getDuan/{id}', 'HuyenController@getDuan');
    //Route::get('/yeucaunha/danhsachnha', 'YeucaunhaController@danhsachnha');
    Route::post('/timkiemnguoimua/', 'HomeController@timkiemnguoimua');
    Route::post('/timkiemnhaban/', 'HomeController@timkiemnhaban');
});



Route::auth();

Route::get('/home', 'HomeController@index');
