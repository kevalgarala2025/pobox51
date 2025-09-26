@if(!Auth::guard(GUARD_USER)->check())
    <div class="container col-sm-11 poppins-regular socialLoginBlock">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-9 col-lg-5 col-xl-4">
                <div class="pobox51_logo d-none d-lg-block">
                    <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'main_logo.svg') }}" alt="Logo">
                </div>
                <div class="event_main_container">
                    <div class="container_background_color">
                        <div class="event_content">
                            <!-- Box Title -->
                            <h4>Authenticate & Done!</h4>
                            <!-- Box SubTitle -->
                            <p>Authenticate using any option below</p>
                            <!-- Social Icon Div Start  -->
                            <div class="social_icon_main_div mt-5">
                                <div class="d-flex social_icon_bg">
                                    @if(getSettings('social_media_login_facebook_mode') == 'On')
                                        <div>
                                            <a href="{{ route(ALIAS_USER.ALIAS_USER_AUTH.'facebook.login') }}">
                                                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'social_icon_facebook.svg') }}" alt="Facebook">
                                            </a>
                                        </div>
                                    @endif
                                    @if(getSettings('social_media_login_twitter_mode') == 'On')
                                        <div>
                                            <a href="{{ route(ALIAS_USER.ALIAS_USER_AUTH.'twitter.login') }}">
                                                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'social_icon_twitter.svg') }}" alt="Twitter">
                                            </a>
                                        </div>
                                    @endif
                                    @if(getSettings('social_media_login_instagram_mode') == 'On')
                                        <div>
                                            <a href="{{ route(ALIAS_USER.ALIAS_USER_AUTH.'instagram.login') }}">
                                                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'social_icon_instagram.svg') }}" alt="Instagram">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="d-flex social_icon_bg">
                                    @if(getSettings('social_media_login_linkedin_mode') == 'On')
                                        <div>
                                            <a href="{{ route(ALIAS_USER.ALIAS_USER_AUTH.'linkedin.login') }}">
                                                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'social_icon_linkedin.svg') }}" alt="LinkedIn">
                                            </a>
                                        </div>
                                    @endif
                                    @if(getSettings('social_media_login_google_mode') == 'On')
                                        <div>
                                            <a href="{{ route(ALIAS_USER.ALIAS_USER_AUTH.'google.login') }}">
                                                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'social_icon_google.svg') }}" alt="Google">
                                            </a>
                                        </div>
                                    @endif
                                    @if(getSettings('social_media_login_apple_mode') == 'On')
                                        <div>
                                            <a href="{{ route(ALIAS_USER.ALIAS_USER_AUTH.'apple.login') }}">
                                                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'social_icon_apple.svg') }}" alt="Apple">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Social Icon Div Start  -->

                        <!-- Privacy Div Start  -->
                        <div class="d-flex privacy_main_div">
                            <div>
                                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'true.svg') }}" alt="privacy_img">
                            </div>
                            <div>
                                <p>
                                    Your privacy is our priority. We promise never to look at your data or retain it
                                    after the contacts are exchanged.
                                </p>
                            </div>
                        </div>
                        <!-- Privacy Div End  -->
                    </div>
                </div>
            </div>
            <!-- Logo and Create Event Email container End  -->

            <!--  Connect Offline Faster and Smoother  And Img Start  -->
            <div
                class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-8 contact_offline_main_container d-flex align-items-end flex-column justify-content-end">
                <p class="d-none d-lg-block">Connect Offline Faster and Smoother</p>
                <div class="desktop-final-image social_bottom_img">
                    <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'connect_offline.svg') }}" alt="Desktop Final" class="img-fluid">
                </div>
            </div>
            <div class="line-image-third d-none d-lg-block"></div>
            <!--  Connect Offline Faster and Smoother  And Img End  -->
        </div>
    </div>
@endif
