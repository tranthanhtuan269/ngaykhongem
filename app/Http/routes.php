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

Route::get('/home', 'HomeController@index');

Route::get('/facebook/login', 'ActionController@loginfacebook');
Route::get('/facebook/callback', 'ActionController@callbackfacebook');

Route::get('/sitemap.xml', function(){
    
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('user/profile', function () {

    });
    
    Route::get('/gioi-thieu', function () {
        return view('home.gioithieu')->withError(null);
    });
    
    Route::post('/gioi-thieu','UserAttackController@gioithieu');
    
//    Route::get('/danh-sach-quan-tam', function () {
//        return view('actions.danhsachquantam')->withError(null);
//    });
//    
//    Route::post('/danh-sach-quan-tam','ActionController@danhsachquantam');
    
    Route::get('/danh-sach-khach-hang','UserAttackController@danhsachkhachhang');
    
    Route::get('/sao-ke-giao-dich','UserAttackController@saokegiaodich');
    
    Route::resource('tinh', 'TinhController');

    Route::resource('huyen', 'HuyenController');

    Route::resource('duong', 'DuongController');

    Route::resource('pho', 'PhoController');

    Route::resource('huong', 'HuongController');

    //Route::resource('loaibds', 'LoaibdsController');

    Route::resource('duan', 'DuanController');

    Route::resource('tour', 'TourController');
    
    Route::resource('hdv', 'HdvController');

    Route::resource('diadanh', 'DiadanhController');
    
    Route::resource('nhatkyhanhtrinh', 'NhatkyhanhtrinhController');

    Route::resource('yeucaunha', 'YeucaunhaController');
    
    Route::resource('question-and-answer', 'QuestionAndAnswerController');

    Route::post('yeucaunha/follow', 'YeucaunhaController@addfollowproduct');
    Route::post('yeucaunha/remove_follow', 'YeucaunhaController@removefollowproduct');

    Route::get('/trang-ca-nhan/', 'HomeController@trangcanhan');
    
    Route::get('/quan-ly-tai-khoan/', 'HomeController@quanlytaikhoan');
    Route::get('/quan-ly-yeu-cau', 'ActionController@quanlyyeucau');
    Route::get('/create-yeu-cau', 'ActionController@taoyeucau');
    
    
    Route::get('/thong-bao/', 'ActionController@thongbao');
    
    Route::get('/nap-tien/', 'ActionController@naptien');

    Route::post('/updateUser', 'HomeController@updateUser');
    
    Route::post('/send-email','HomeController@sendemail');
    Route::get('/setup', 'PhuotHaNoiController@setuppage');
    Route::post('/setuppost', 'PhuotHaNoiController@setuppost');
});

Route::group(['middleware' => ['web']], function () {
    
    Route::get('/', 'HomeController@welcome');
    Route::get('/test-new', 'HomeController@testnew');
    Route::get('/test-login', 'ActionController@login');
    Route::get('/danh-sach-yeu-cau', 'ActionController@khachquantam');
    
    Route::post('/tim-kiem-nguoi-mua/', 'HomeController@timkiemnguoimua');
    Route::post('/tim-kiem-nha-ban/', 'HomeController@timkiemnhaban');
    Route::get('/tim-kiem-nguoi-mua/', 'HomeController@timkiemnguoimua');
    Route::get('/tim-kiem-nha-ban/', 'HomeController@timkiemnhaban');
    
    Route::get('/them-yeu-cau','UserAttackController@themyeucau');
    Route::get('/them-nguoi-dung','UserAttackController@themnguoidung');
    
    Route::get('/nha-da-ban', 'ActionController@nhadaban');
    Route::get('/nha-chua-duyet', 'ActionController@nhachuaduyet');
    Route::get('/khach-quan-tam', 'ActionController@khachquantam');
    Route::get('/duyet-tin', 'ActionController@duyettin');
    Route::post('/active', 'ActionController@activetin');
    Route::post('/remove', 'ActionController@removetin');
    
    Route::get('/terms-of-service', 'ActionController@termsofservice');
    Route::get('/price-policy', 'ActionController@pricepolicy');
    Route::get('/privacy-policy', 'ActionController@privacypolicy');
    Route::get('/questions-and-answers', 'ActionController@questionsandanswers');
    Route::get('/nganluong_d62bafcde7c1225038e4c17973210c22.html','ActionController@nganluongactive');
    Route::get('/payment_success', 'ActionController@thanhtoanthanhcong');
    Route::get('/google2fa952a6c07ee729.html', 'ActionController@googleSearch');
    
    Route::get('/baokim_1a06a47dfa253674.html', 'HomeController@baokim');
    Route::get('/thanhtoanbaokim', 'ActionController@thanhtoanbaokim');
    Route::post('/tienhanhthanhtoan', 'ActionController@tienhanhthanhtoan');
    Route::get('/thanh-toan-thanh-cong', 'ActionController@thanhtoanthanhcong');
    Route::get('/success', 'ActionController@success');

    Route::get('/xem-tour/{id}', 'PhuotHaNoiController@xemtour');
    Route::get('/xem-tour', 'PhuotHaNoiController@xemtatcatour');
    Route::get('/xem-tour-thang', 'PhuotHaNoiController@xemtourthang');
    Route::get('/huong-dan-vien', 'PhuotHaNoiController@huongdanvien');
    Route::get('/gioi-thieu', 'PhuotHaNoiController@gioithieu');
    Route::get('/tour-leo-nui', 'PhuotHaNoiController@tourleonui');
    Route::get('/tour-di-bo', 'PhuotHaNoiController@tourdibo');
    Route::get('/tour-bien-dao', 'PhuotHaNoiController@tourbiendao');
    Route::get('/tour-cam-trai', 'PhuotHaNoiController@tourcamtrai');
    Route::get('/xem-dia-danh/{id}', 'DiadanhController@xemdiadanh');
    Route::get('/xem-dia-danh', 'DiadanhController@xemtatcadiadanh');
    
    Route::get('/sua-gioi-thieu', 'PhuotHaNoiController@suagioithieu');
    Route::post('/sua-gioi-thieu', 'PhuotHaNoiController@editgioithieu');
    
    Route::get('/edit-about', 'PhuotHaNoiController@suaabout');
    Route::post('/edit-about', 'PhuotHaNoiController@editabout');
    
    Route::get('/edit-xu-menh', 'PhuotHaNoiController@suaxumenh');
    Route::post('/edit-xu-menh', 'PhuotHaNoiController@editxumenh');
    
    Route::post('/follow-dia-danh/{id}', 'DiadanhController@followdiadanh');
    Route::post('/dat-tour/{id}', 'PhuotHaNoiController@dattour');
    Route::post('/ajaximage', 'DiadanhController@postImage');
//    Route::post('/ajaximage', function(){
//        $file = Request::file('file');
////        var_dump($file);die;
//        $destinationPath = public_path().'/images/';
//        $filename = $file->getClientOriginalName();
//        $file->move($destinationPath, $filename);
//        echo url().'/images/'.$filename;
//    });
});