<!-- How it Works Modal Start -->
<div class="modal fade" id="how_it_work_modal" tabindex="-1" aria-labelledby="howItWorksLabel" aria-hidden="true">
    <div class="modal-dialog"> <!-- 👈 Vertically centered -->
        <div class="modal-content">
            <div class="pop_close_btn_right d-flex justify-content-between">
                <h4 class="modal-title" id="howItWorksLabel">Here’s how it works</h4>
                <button type="button" class="btn-close py-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body poppins-regular">
                <!-- Your steps -->
                <div class="pt-3 d-flex align-items-center moblie_pop_up">
                    <div><img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'mail_box.svg') }}" alt="mail_box"></div>
                    <div class="ms-3 pop_up_description">Set up your event email address.</div>
                </div>
                <div class="pt-4 d-flex align-items-center moblie_pop_up">
                    <div><img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'share.svg') }}" alt="share"></div>
                    <div class="ms-3 pop_up_description">Share the email address with your guests.</div>
                </div>
                <div class="pt-4 d-flex align-items-center moblie_pop_up">
                    <div><img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'instruct.svg') }}" alt="Instruct"></div>
                    <div class="ms-3 pop_up_description">Guests put their contact number in the subject line and send the email.</div>
                </div>
                <div class="pt-4 d-flex align-items-center moblie_pop_up">
                    <div><img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'contacts.svg') }}" alt="contacts"></div>
                    <div class="ms-3 pop_up_description">After the event, you and your guests get a contact file (VCF) with everyone’s info.</div>
                </div>
                <div class="pt-4 d-flex align-items-center moblie_pop_up">
                    <div><img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'download.svg') }}" alt="download"></div>
                    <div class="ms-3 pop_up_description">Download the VCF file and save the contacts to your address book.</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- How it Works Modal End -->
