<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\Users;
use GuzzleHttp\Client;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;

class LoginController extends BaseController
{
    /*
        @Description: Function for Redirect Login
        @Author: Sandeep Gajera
        @Input:
        @Output: - google main page
        @Date: 06-07-2023
    */
    //code for redirect google
    public function redirect_to_google()
    {
        // Check if user is already logged in
        if (Auth::guard(GUARD_USER)->check()) {
            return redirect()->route(ALIAS_USER.'dashboard');
        }
        
        return Socialite::driver('google')->redirect();
    }

    /*
        @Description: Function for Handle Google Callback
        @Author: Sandeep Gajera
        @Input: User Socialite Id
        @Output: - Create User Data
        @Date: 06-07-2023
    */
    public function handle_google_callback()
    {
        try {
            // Check if user is already logged in
            if (Auth::guard(GUARD_USER)->check()) {
                return redirect()->route(ALIAS_USER.'dashboard');
            }
            
            $socialite_user = Socialite::driver('google')->user();
            $user = Users::where('t_social_id', $socialite_user->id)->first();
            if (empty($user)) {
                if (isset($socialite_user->user['name']) && isset($socialite_user->user['family_name'])) {
                    $v_first_name = $socialite_user->user['name'];

                    $user = Users::create([
                        'v_first_name' => $v_first_name,
                        'v_email' => $socialite_user->user['email'],
                        't_social_id' => $socialite_user->id,
                        't_password' => Hash::make('123456'),
                        'e_status' => Users::STATUS_ACTIVE,
                    ]);
                }
            }

            if (isset($user->id)) {
                \Auth::guard(GUARD_USER)->loginUsingId($user->id);
                session('is_loggedin',1);
                return redirect()->route(ALIAS_USER.'dashboard');
            }

            return redirect()->back();
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            // Handle the InvalidStateException when user uses back button or session expires
            \Log::warning('Google OAuth InvalidStateException: ' . $e->getMessage());
            return redirect()->route(ALIAS_USER.'index')->with('error', 'Authentication session expired. Please try logging in again.');
        } catch (\Exception $e) {
            \Log::error('Google OAuth Error: ' . $e->getMessage());
            \Alert::error(TITLE_SOMETHING_WENT_WRONG_AT_SERVER, $e->getMessage());
            return redirect()->route(ALIAS_USER.'index')->with('error', 'Authentication failed. Please try again.');
        }
    }
    //end code for google login

    /*
        @Description: Function for Reditect Linkedin
        @Author: Sandeep Gajera
        @Input:
        @Output: - Linkedin Page
        @Date: 06-07-2023
    */
    public function redirect_to_linkedin()
    {
        // Check if user is already logged in
        if (Auth::guard(GUARD_USER)->check()) {
            return redirect()->route(ALIAS_USER.'dashboard');
        }
        
        return Socialite::driver('linkedin')->redirect();
    }

    /*
        @Description: Function for Handle Reditect Linkedin
        @Author: Sandeep Gajera
        @Input: Linkedin User Id
        @Output: - Create User
        @Date: 06-07-2023
    */
    public function handle_linkedin_callback()
    {
        try {
            // Check if user is already logged in
            if (Auth::guard(GUARD_USER)->check()) {
                return redirect()->route(ALIAS_USER.'dashboard');
            }
            
            $socialite_user = Socialite::driver('linkedin')->user();

            $user = Users::where('t_linkedin_id', $socialite_user->id)->first();

            if (empty($user)) {
                if (isset($socialite_user->name) && isset($socialite_user->email)) {
                    $user = Users::create([
                        'v_first_name' => $socialite_user->name,
                        'v_last_name' => '',
                        'v_email' => $socialite_user->email,
                        't_linkedin_id' => $socialite_user->id,
                        't_password' => Hash::make('123456'),
                        'e_status' => Users::STATUS_ACTIVE,
                    ]);
                }
            }

            if (isset($user->id)) {
                \Auth::guard(GUARD_USER)->loginUsingId($user->id);
                session('is_loggedin',1);
                return redirect()->route(ALIAS_USER.'dashboard');
            }

            return redirect()->back();
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            // Handle the InvalidStateException when user uses back button or session expires
            \Log::warning('LinkedIn OAuth InvalidStateException: ' . $e->getMessage());
            return redirect()->route(ALIAS_USER.'index')->with('error', 'Authentication session expired. Please try logging in again.');
        } catch (\Exception $e) {
            \Log::error('LinkedIn OAuth Error: ' . $e->getMessage());
            \Alert::error(TITLE_SOMETHING_WENT_WRONG_AT_SERVER, $e->getMessage());
            return redirect()->route(ALIAS_USER.'index')->with('error', 'Authentication failed. Please try again.');
        }
    }

    /*
        @Description: Function for Reditect Facebook
        @Author: Sandeep Gajera
        @Input:
        @Output: - Facebook Page
        @Date: 06-07-2023
    */
    public function redirect_to_facebook()
    {
        // Check if user is already logged in
        if (Auth::guard(GUARD_USER)->check()) {
            return redirect()->route(ALIAS_USER.'dashboard');
        }
        
        return Socialite::driver('facebook')->redirect();
    }

    /*
        @Description: Function for Handle Reditect Facebook
        @Author: Sandeep Gajera
        @Input: Facebook User Id
        @Output: - Create User Data
        @Date: 06-07-2023
    */
    public function handle_facebook_callback()
    {
        try {
            // Check if user is already logged in
            if (Auth::guard(GUARD_USER)->check()) {
                return redirect()->route(ALIAS_USER.'dashboard');
            }
            
            $socialite_user = Socialite::driver('facebook')->user();
            $user = Users::where('t_facebook_id', $socialite_user->id)->first();

            if (empty($user)) {
                if (isset($socialite_user->user['name']) && isset($socialite_user->user['id'])) {
                    $v_last_name = '';
                    $v_first_name = $socialite_user->user['name'];

                    $user = Users::create([
                        'v_first_name' => $v_first_name,
                        'v_last_name' => $v_last_name,
                        'v_email' => ($socialite_user->user['email'] ?? ''),
                        't_facebook_id' => $socialite_user->user['id'],
                        't_password' => Hash::make('123456'),
                        'e_status' => Users::STATUS_ACTIVE,
                    ]);
                }
            }

            if (isset($user->id)) {
                \Auth::guard(GUARD_USER)->loginUsingId($user->id);
                session('is_loggedin',1);
                return redirect()->route(ALIAS_USER.'dashboard');
            }

            return redirect()->back();
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            // Handle the InvalidStateException when user uses back button or session expires
            \Log::warning('Facebook OAuth InvalidStateException: ' . $e->getMessage());
            return redirect()->route(ALIAS_USER.'index')->with('error', 'Authentication session expired. Please try logging in again.');
        } catch (\Exception $e) {
            \Log::error('Facebook OAuth Error: ' . $e->getMessage());
            \Alert::error(TITLE_SOMETHING_WENT_WRONG_AT_SERVER, $e->getMessage());
            return redirect()->route(ALIAS_USER.'index')->with('error', 'Authentication failed. Please try again.');
        }
    }

    /*
        @Description: Function for Reditect Twitter
        @Author: Sandeep Gajera
        @Input:
        @Output: - Twitter Page
        @Date: 06-07-2023
    */
    public function redirect_to_twitter()
    {
        // Check if user is already logged in
        if (Auth::guard(GUARD_USER)->check()) {
            return redirect()->route(ALIAS_USER.'dashboard');
        }
        
        return Socialite::driver('twitter')->redirect();
    }

    /*
        @Description: Function for Handle Reditect Twitter
        @Author: Sandeep Gajera
        @Input: Twitter User Id
        @Output: - Create User Data
        @Date: 06-07-2023
    */
    public function handle_twitter_callback()
    {
        try {
            // Check if user is already logged in
            if (Auth::guard(GUARD_USER)->check()) {
                return redirect()->route(ALIAS_USER.'dashboard');
            }
            
            $socialite_user = Socialite::driver('twitter')->user();
            $user = Users::where('t_twitter_id', $socialite_user->id)->first();

            if (empty($user)) {
                if (isset($socialite_user->name) && isset($socialite_user->email)) {
                    $user = Users::create([
                        'v_first_name' => $socialite_user->name,
                        'v_last_name' => '',
                        'v_email' => $socialite_user->email,
                        't_twitter_id' => $socialite_user->id,
                        't_password' => Hash::make('123456'),
                        'e_status' => Users::STATUS_ACTIVE,
                    ]);
                }
            }

            if (isset($user->id)) {
                \Auth::guard(GUARD_USER)->loginUsingId($user->id);
                session('is_loggedin',1);
                return redirect()->route(ALIAS_USER.'dashboard');
            }

            return redirect()->back();
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            // Handle the InvalidStateException when user uses back button or session expires
            \Log::warning('Twitter OAuth InvalidStateException: ' . $e->getMessage());
            return redirect()->route(ALIAS_USER.'index')->with('error', 'Authentication session expired. Please try logging in again.');
        } catch (\Exception $e) {
            \Log::error('Twitter OAuth Error: ' . $e->getMessage());
            \Alert::error(TITLE_SOMETHING_WENT_WRONG_AT_SERVER, $e->getMessage());
            return redirect()->route(ALIAS_USER.'index')->with('error', 'Authentication failed. Please try again.');
        }
    }

    /*
        @Description: Function for Reditect Github
        @Author: Sandeep Gajera
        @Input:
        @Output: - Github Page
        @Date: 06-07-2023
    */
    public function redirect_to_github()
    {
        return Socialite::driver('github')->redirect();
    }

    /*
        @Description: Function for Handle Reditect Github
        @Author: Sandeep Gajera
        @Input: Github User Id
        @Output: - Create User Data
        @Date: 06-07-2023
    */
    public function handle_github_callback()
    {
        try {
            $socialite_user = Socialite::driver('github')->user();
            $user = Users::where('t_github_id', $socialite_user->id)->first();

            if (empty($user)) {
                if (isset($socialite_user->name) && isset($socialite_user->email)) {
                    $user = Users::create([
                        'v_first_name' => $socialite_user->name,
                        'v_last_name' => '',
                        'v_email' => $socialite_user->email,
                        't_github_id' => $socialite_user->id,
                        't_password' => Hash::make('123456'),
                        'e_status' => Users::STATUS_ACTIVE,
                    ]);
                }
            }

            if (isset($user->id)) {
                \Auth::guard(GUARD_USER)->loginUsingId($user->id);
                return redirect()->route(ALIAS_USER.'dashboard');
            }

            return redirect()->back();
        } catch (Exception $e) {
            \Alert::error(TITLE_SOMETHING_WENT_WRONG_AT_SERVER, $e->getMessage());
            return redirect()->back();
        }
    }

    /*
        @Description: Function for Reditect Instagram
        @Author: Sandeep Gajera
        @Input:
        @Output: - Instagram Pge
        @Date: 06-07-2023
    */
    public function redirect_to_instagram()
    {
        // Check if user is already logged in
        if (Auth::guard(GUARD_USER)->check()) {
            return redirect()->route(ALIAS_USER.'dashboard');
        }
        
        return redirect()->to(INSTAGRAM_OAUTH_AUTHORIZE_API_URL.'?app_id='.config('services.instagram.client_id').'&redirect_uri='.urlencode(config('services.instagram.redirect')).'&scope=user_profile&response_type=code');
    }

    /*
        @Description: Function for Handle Reditect Instagram
        @Author: Sandeep Gajera
        @Input: Instagram User Id
        @Output: - Create User Data
        @Date: 06-07-2023
    */
    public function handle_instagram_callback(Request $request)
    {
        $code = $request->code;
        if (empty($code)) {
            \Alert::error(TITLE_SOMETHING_WENT_WRONG_AT_SERVER, MSG_SOMETHING_WENT_WRONG_AT_SERVER);
            return redirect()->back();
        }

        $client = new Client();

        // Get access token
        $response = $client->request(
            'POST',
            INSTAGRAM_OAUTH_ACCESS_TOKEN_API_URL,
            [
                'form_params' => [
                    'app_id' => config('services.instagram.client_id'),
                    'app_secret' => config('services.instagram.client_secret'),
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => config('services.instagram.redirect'),
                    'code' => $code,
                ],
            ]
        );

        if ($response->getStatusCode() !== 200) {
            \Alert::error(TITLE_INSTAGRAM_LOGIN_ERROR, MSG_INSTAGRAM_LOGIN_ERROR);
            return redirect()->back();
        }

        $content = $response->getBody()->getContents();
        $content = json_decode($content);

        $access_token = $content->access_token;

        $user_id = $content->user_id;

        // Get user info
        $response = $client->request('GET', INSTAGRAM_GRAPH_API_URL."?fields=id,username,account_type&access_token={$access_token}");
        $content = $response->getBody()->getContents();
        $oauth = json_decode($content);

        // Get instagram user name
        $username = $oauth->username;

        try {
            // Check if user is already logged in
            if (Auth::guard(GUARD_USER)->check()) {
                return redirect()->route(ALIAS_USER.'dashboard');
            }
            
            $user = Users::where('t_instagram_id', $user_id)->first();

            if (empty($user)) {
                if (isset($user_id) && isset($username)) {
                    $user = Users::create([
                        'v_first_name' => $username,
                        'v_last_name' => '',
                        'v_email' => $username,
                        't_instagram_id' => $user_id,
                        't_password' => Hash::make('123456'),
                        'e_status' => Users::STATUS_ACTIVE,
                    ]);
                }
            }

            if (isset($user->id)) {
                \Auth::guard(GUARD_USER)->loginUsingId($user->id);
                session('is_loggedin',1);
                return redirect()->route(ALIAS_USER.'dashboard');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error('Instagram OAuth Error: ' . $e->getMessage());
            \Alert::error(TITLE_SOMETHING_WENT_WRONG_AT_SERVER, $e->getMessage());
            return redirect()->route(ALIAS_USER.'index')->with('error', 'Authentication failed. Please try again.');
        }
    }

    /*
        @Description: Function for Reditect Apple
        @Author: Sandeep Gajera
        @Input:
        @Output: - Apple Page
        @Date: 06-07-2023
    */
    public function redirect_to_apple()
    {
        return Socialite::driver('apple')->redirect();
    }

    /*
        @Description: Function for Handle Reditect Apple
        @Author: Sandeep Gajera
        @Input: Apple User Id
        @Output: - Create User Data
        @Date: 06-07-2023
    */
    public function handle_apple_callback()
    {
        try {
            $socialite_user = Socialite::driver('apple')->user();
            $user = Users::where('t_apple_id', $socialite_user->id)->first();

            if (empty($user)) {
                if (isset($socialite_user->email) && isset($socialite_user->id)) {
                    $user = Users::create([
                        'v_first_name' => $socialite_user->name,
                        'v_last_name' => '',
                        'v_email' => $socialite_user->email,
                        't_apple_id' => $socialite_user->id,
                        't_password' => Hash::make('123456'),
                        'e_status' => Users::STATUS_ACTIVE,
                    ]);
                }
            }
            if (isset($user->id)) {
                \Auth::guard(GUARD_USER)->loginUsingId($user->id);
                return redirect()->route(ALIAS_USER.'dashboard');
            }

            return redirect()->back();
        } catch (Exception $e) {
            \Alert::error(TITLE_SOMETHING_WENT_WRONG_AT_SERVER, $e->getMessage());
            return redirect()->back();
        }
    }
}
