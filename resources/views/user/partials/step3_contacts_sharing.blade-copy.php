<!-- Logo and Create Event Email container Start  -->
<div class="container col-sm-11 poppins-regular contactSharingBlock">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-9 col-lg-5 col-xl-4 main_div ready_share_mian">
            <div class="pobox51_logo d-none d-lg-block">
                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'main_logo.svg') }}" alt="Logo">
            </div>
            <div class="event_main_container">
                <div class="container_background_color">
                    <div class="event_content div_height_fix">
                        <!-- Box Title -->
                        <h4>Ready to Share</h4>
                        <!-- Email -->
                        <p class="share_email event_email_with_postfix" id="event_email_with_postfix"></p>
                        <!-- Email From Start  -->

                        <!-- Countdown Timer Start  -->
                        <div class="countdown-wrapper">
                            <div class="countdown-circle">
                                <svg class="progress-ring" viewBox="0 0 250 250">
                                    <circle class="progress-ring__background" r="110" cx="125" cy="125" />
                                    <circle class="progress-ring__circle" r="110" cx="125" cy="125" />
                                </svg>
                                <div class="countdown-timer">
                                    <p class="submission-text">SUBMISSION ENDS IN</p>
                                    <p class="time-display" id="time"><span class="tk_counter minutes">00</span> : <span class="tk_counter seconds">00</span></p>
                                    <button  id="add_time_btn" class="btn btn-add-time"><img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'plus.svg') }}" alt="Plus"> {{(int)$event_addon_timer_in_seconds / 60}}
                                        Min</button>
                                </div>
                            </div>
                        </div>
                        <!-- Countdown Timer End  -->

                        <!-- Contacts Received Start  -->
                        <div class="contact_received_count">
                            <div class="contact_book_img">
                                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'contact_book.svg') }}" alt="contact_book">
                                <p>CONTACTS RECEIVED</p>
                                <span class="contact_count">{{(isset($user_event_contact_received)?$user_event_contact_received:0)}}</span>
                            </div>
                        </div>

                        <div class="row">
                           <div class="col-md-11 col-12 mx-auto">
                               <div cancelevent_url="{{route(ALIAS_USER.'completed-event')}}" class="cancel_event_btn" id="slider1"></div>
                           </div>
                        </div>


                        <!-- Slide to End Button End  -->
                    </div>
                    <!-- Privacy Div Start  -->
                    <div class="d-flex privacy_main_div privacy_bg_img">
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
            <div class="desktop-final-image">
                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'connect_offline.svg') }}" alt="Desktop Final" class="img-fluid">
            </div>
        </div>
        <!--  Connect Offline Faster and Smoother  And Img End  -->
    </div>
</div>
