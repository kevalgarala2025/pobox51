<!-- Logo and Create Event Email container Start  -->
<div class="container col-sm-11 poppins-regular createEventIdBlock">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-9 col-lg-5 col-xl-4 main_div">

            <input type="hidden" name="create_event_url" id="create_event_url" value="{{route(ALIAS_USER.'create-event')}}">
            <div class="pobox51_logo d-none d-lg-block">
                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'main_logo.svg') }}" class="logo-size" alt="Logo">
            </div>
            <div class="event_main_container">
                <div class="container_background_color">
                    <div class="event_content">
                        <!-- Box Title -->
                        <h4>Create Event Email</h4>
                        <!-- Box SubTitle -->
                        <p>Guests share their contacts here</p>
                        <!-- Email From Start  -->

                        <div class="form-group invalide_email mt-5 d-flex">
                            <input type="text" class="form-control v_event_name" id="v_event_name" placeholder="mydesignevent">
                            <!-- chek icone -->
                            {{-- <i class="fa-solid fa-check"></i> --}}
                            <!-- Unchek icone -->
                            {{-- <i class="fa-solid fa-xmark"></i> --}}
                        </div>
                        <small class="form-text  text-right">{{'@'.$event_email}}</small>
                        <div class="invalid-feedback create_event_error_msg">
                            Please enter a message in the textarea.
                        </div>
                        <!-- Email From End  -->
                        <!-- Button Start  -->
                        <div class="container text-center mt-5">
                            <button createevent_url="{{route(ALIAS_USER.'check-event-name')}}" class="create-email-btn create-email-disable-btn  create_event_btn">
                                Create Email <span class="arrow">❯</span>
                            </button>
                        </div>
                        <!-- Button Start  -->
                    </div>
                    <!-- Privacy Div Start  -->
                    <div class="d-flex privacy_main_div">
                        <div>
                            <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'true.svg') }}" alt="privacy_img">
                        </div>
                        <div>
                            <p>
                            This temporary email and all guest contact data are deleted after sharing. We never store or view any information.
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
            <div class="desktop-final-image home_boottom_img">
                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'connect_offline.svg') }}" alt="Desktop Final"
                    class="img-fluid">
            </div>
        </div>
        <div class="line-image-third d-none d-lg-block"></div>
        <!--  Connect Offline Faster and Smoother  And Img End  -->

        <!-- Moblie Bottom Container Start  -->
        <div class="col-sm-6 col-md-12 d-lg-none work_div">
            <h4 class="modal-title">Here’s how it works</h4>
            <div class="pt-4 align-items-center">
                <div><img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'mail_box.svg') }}" alt="mail_box"></div>
                <div class="mt-2">Create your event’s email address Provide
                    location access</div>
            </div>
            <div class="pt-5 align-items-center">
                <div><img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'share.svg') }}" alt="share"></div>
                <div class="mt-2">Share this email address with all attendees</div>
            </div>
            <div class="pt-5 align-items-center">
                <div><img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'instruct.svg') }}" alt="Instruct"></div>
                <div class="mt-2">Instruct attendees to email on this address with their
                    mobile number in the subject line, leaving the body empty within
                    given time</div>
            </div>
            <div class="pt-5 align-items-center">
                <div><img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'contacts.svg') }}" alt="contacts"></div>
                <div class="mt-2">Once the provided time expires, a VCF file with all
                    contacts is sent to you and the attendees</div>
            </div>
            <div class="pt-5 align-items-center">
                <div><img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'download.svg') }}" alt="download"></div>
                <div class="mt-2">Download the VCF file and import the contacts into
                    your digital contact book</div>
            </div>
        </div>
        <!-- Moblie Bottom Container End  -->
    </div>
</div>
