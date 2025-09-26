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

Route::get('/', function () {
    return redirect()->route(ALIAS_USER.'index');
});

Route::group(['middleware' => [],'namespace' => NAMESPACE_USER,'as' => ALIAS_USER], function () {
    Route::get('/', 'HomeController@index')->name('index')->middleware([MIDDLEWARE_GUEST]);

    Route::get('/context', 'HomeController@context')->name('context');

    Route::post('/check-event-name', 'EventController@check_event_name')->name('check-event-name');
    Route::get('/check-running-event', 'EventController@check_running_event')->name('event.check-running-event');


    Route::group(['namespace' => NAMESPACE_USER_AUTH,'as' => ALIAS_USER_AUTH,'prefix' => PREFIX_USER_AUTH], function () {
        // OAuth redirect routes (prevent logged-in users from accessing)
        Route::get('google', 'LoginController@redirect_to_google')->name('google.login');
        Route::get('linkedin', 'LoginController@redirect_to_linkedin')->name('linkedin.login');
        Route::get('facebook', 'LoginController@redirect_to_facebook')->name('facebook.login');
        Route::get('twitter', 'LoginController@redirect_to_twitter')->name('twitter.login');
        Route::get('instagram', 'LoginController@redirect_to_instagram')->name('instagram.login');

        // OAuth callback routes (can be accessed by anyone)
        Route::get('google/callback', 'LoginController@handle_google_callback')->name('google.login.callback');
        Route::get('linkedin/callback', 'LoginController@handle_linkedin_callback')->name('linkedin.login.callback');
        Route::get('facebook/callback', 'LoginController@handle_facebook_callback')->name('facebook.login.callback');
        Route::get('twitter/callback', 'LoginController@handle_twitter_callback')->name('twitter.login.callback');
        Route::get('instagram/callback', 'LoginController@handle_instagram_callback')->name('instagram.login.callback');

        Route::get('github', 'LoginController@redirect_to_github')->name('github.login');
        Route::get('github/callback', 'LoginController@handle_github_callback')->name('github.login.callback');

        Route::get('apple', 'LoginController@redirect_to_apple')->name('apple.login');
        Route::any('apple/callback', 'LoginController@handle_apple_callback')->name('apple.login.callback');
    });
});

Route::group(['middleware' => [MIDDLEWARE_AUTH.':'.GUARD_USER],'namespace' => NAMESPACE_USER,'as' => ALIAS_USER], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/redirect_to_value','EventController@check_redirect')->name('check-redirect');
    Route::get('/logout', 'Auth\LogoutController@index')->name('logout');

    //AJAX CALL
    Route::post('/create-event', 'EventController@create_event')->name('create-event');
    Route::post('/check-event', 'EventController@check_event')->name('check-event');
    Route::post('/completed-event', 'EventController@completed_event')->name('completed-event');
    Route::post('/share-email', 'EventController@share_email')->name('share-email');
    Route::post('/event-share-email-received', 'EventController@event_share_email_received')->name('event-share-email-received');
    Route::post('/event-share-email-addon-time', 'EventController@event_share_email_addon_time')->name('event-share-email-addon-time');
    Route::post('/event-content-check-delete', 'EventController@event_content_check_delete')->name('event-content-check-delete');

    Route::get('/event/{id}/download-vcf', 'EventController@downloadVcf')->name('event.download.vcf');
    Route::get('/event/{id}/get-event-time', 'EventController@getEventTime')->name('event.get.event.time');

});
