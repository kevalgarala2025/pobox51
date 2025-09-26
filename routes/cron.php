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

Route::group(['middleware' => [MIDDLEWARE_GUEST],'namespace' => NAMESPACE_CRON], function () {
    //[Cron Routes]
    Route::get('event-user-email-data-read', 'CronController@event_user_email_data_read')->name('event-user-email-data-read');

    Route::get('event-user-email-data-delete', 'CronController@event_user_email_data_delete')->name('event-user-email-data-delete');
});
