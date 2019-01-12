<?php

Route::get('/', function () {
    return view('app.home');
})->name('home');

Auth::routes();


Route::get('auth/{provider}','Auth\LoginController@redirectToProvider')->name('login.google');
Route::get('auth/{provider}/callback','Auth\LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home.dashboard');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/courses', 'HomeController@courses')->name('courses');
Route::get('/events', 'HomeController@events')->name('events');
Route::get('/gallery', 'HomeController@gallery')->name('gallery');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function(){
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
	Route::get('/', 'AdminController@index')->name('admin.dashboard');

});

