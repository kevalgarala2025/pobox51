<?php

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

//Admin Panel Routes

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::group(['middleware' => [MIDDLEWARE_GUEST],'namespace' => NAMESPACE_SUPERADMIN], function () {
    Route::group(['namespace' => NAMESPACE_SUPERADMIN_AUTH], function () {
        //[Login Routes]

        Route::get('login', 'LoginController@login_form')->name('login');

        Route::post('login', 'LoginController@login');

        //[Forgot Password Routes]

        Route::post('password/email', 'ForgotPasswordController@forgot_password_email')->name('password.email');

        Route::get('password/forgot', 'ForgotPasswordController@forgot_password_form')->name('password.request');

        //[Password Reset Routes]

        Route::post('password/reset', 'ResetPasswordController@reset_password')->name('password.update');

        Route::get('password/reset/{token}', 'ResetPasswordController@reset_password_form')->name('password.reset');
    });

    Route::post('lockscreen-login', 'CommonController@lockscreen_login')->name('lockscreen.login');
});

Route::group(['middleware' => MIDDLEWARE_AUTH.':'.GUARD_SUPERADMIN,'namespace' => NAMESPACE_SUPERADMIN], function () {
    //[Logout Route]
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    //[Dashboard Route]
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    //[Profile Route]
    Route::any('profile', 'AuthController@profile')->name('profile');

    //[Change Password Route]
    Route::any('change-password', 'AuthController@changepassword')->name('changepassword');

    //[LockScreen Route]
    Route::get('lockscreen', 'CommonController@lockscreen')->name('lockscreen');

    //[CMS Pages Module]
    Route::resource('cms-pages', 'CMSPageController');

    //[EmailTemplate Route]
    Route::post('email-templates/{emailtemplateid}/status', 'EmailTemplateController@status')->name('email-templates.status');
    Route::resource('email-templates', 'EmailTemplateController');

    //[Users Module]
    Route::post('users/{userid}/status', 'UserController@status')->name('users.status');

    Route::resource('users', 'UserController');

    //[User Event Module]
    Route::resource('user-events', 'UserEventsController')->only(['index','show']);

    //[Settings Route]
    Route::get('setting/{type?}', 'SettingController@index')->name('setting.index');
    Route::post('setting/{type}', 'SettingController@store')->name('setting.store');
});
