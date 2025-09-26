<div class="container col-sm-11 poppins-regular contactReceivedBlock">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-9 col-lg-5 col-xl-4 main_div ready_share_mian">
            <div class="pobox51_logo d-none d-lg-block">
                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'main_logo.svg') }}" alt="Logo">
            </div>
            <div class="event_main_container">
                <div class="container_background_color">
                    <div class="event_content div_height_fix">
                        <!-- Count Title Start  -->
                        <div class="count_title">
                            <!-- Count Title -->
                            <p class="total_count_title">TOTAL CONTACTS</p>
                            <!-- Count -->
                            <h2 id="total_count_received">0</h2>
                        </div>
                        <!-- Count Title End  -->
                        <!-- Email Img Start  -->
                        <div class="email_box_img">
                            <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'email_box.svg') }}" alt="Email_Box">
                        </div>
                        <!-- Email Img End  -->
                        <!-- Box Title -->
                        <h4 class="sharing_text">Sharing Contacts via Email</h4>
                        <!-- Box SubTitle -->
                        <p>Your data is deleted from our server</p>
                        <!-- Button Start  -->
                        <div class="another_email">
                            <a href="{{route(ALIAS_USER.'index')}}">
                                <button>Create Another Event Email</button>
                            </a>
                        </div>
                        <!-- Button Start  -->
                    </div>
                    <!-- Privacy Div Start  -->
                    <div class="d-flex privacy_main_div privacy_bg_img d-md-none d-lg-none d-xl-none">
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
