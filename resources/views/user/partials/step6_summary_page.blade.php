 <section class="hero-section container-fluid p-0 position-relative" id="step-6-pobox51" style="display:none;">
     @include($ViewFolder . '.partials.header')
     <div class="hero-section__container position-relative w-100 overflow-hidden">
         <!-- Same Background as Home Page -->
         <div class="hero-section__background" role="presentation">
         </div>

         <!-- Hero Visuals - Phone Section (50% Opacity) -->
         <aside class="hero-section__visuals hero-section__visuals--center position-absolute"
             aria-label="Mobile app preview">
             <figure class="hero-section__phone m-0 position-relative">
                 <div class="hero-section__phone-image-wrapper">
                     <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/iPhone.png') }}"
                         alt="POBox51 mobile app interface on iPhone"
                         class="hero-section__phone-image temp-email-phone">
                 </div>
             </figure>
         </aside>

         <!-- Site Header with Logo -->


         <!-- Summary Modal -->
         <div class="summary-modal position-absolute start-50 translate-middle-x">
             <div class="summary-modal__container">
                 <!-- Success Icon -->
                 <div class="summary-success-icon">
                     <div class="summary-success-icon__container">
                         <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/right-white.webp') }}"
                             alt="summary-success-icon__checkmark">
                     </div>
                 </div>

                 <!-- Modal Header -->
                 <header class="summary-modal__header text-center">
                     <h1 class="summary-modal__title text-heading-h1">{{ __('text.summary') }}</h1>
                 </header>

                 <!-- Description -->
                 <div class="summary-description text-center mb-8">
                     <p class="summary-description__text text-body-2">
                         {{ __('text.summary_description') }}
                     </p>
                 </div>

                 <!-- Stats Cards -->
                 <div class="summary-stats">
                     <!-- Contacts Card -->
                     <div class="summary-stats__card">
                         <div class="summary-stats__card-icon">
                             <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/contacts-icon.webp') }}"
                                 alt="Contacts" class="summary-stats__card-icon-image">
                         </div>
                         <div class="summary-stats__card-content">
                             <div class="summary-stats__card-number text-label-1" id="total_count_received">0</div>
                             <div class="summary-stats__card-label text-body-3">{{ __('text.contacts') }}</div>
                         </div>
                         <button id="vcf_download_url_a" class="summary-stats__card-download btn download-hide"
                             type="button">
                             <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/download-icon.webp') }}"
                                 alt="Download" class="summary-stats__card-download-icon">
                             <span
                                 class="summary-stats__card-download-text text-label-2">{{ __('text.download') }}</span>
                         </button>
                     </div>

                     <!-- Time Card -->
                     <div class="summary-stats__card" id="summary-time-taken-div">
                         <div class="summary-stats__card-icon">
                             <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/time-icon.webp') }}"
                                 alt="Time" class="summary-stats__card-icon-image">
                         </div>
                         <div class="summary-stats__card-content">
                             <div class="summary-stats__card-number text-label-1" id="time_taken_div">0m 0s</div>
                             <div class="summary-stats__card-label text-body-3">{{ __('text.time_taken') }}</div>
                         </div>
                     </div>
                 </div>

                 <!-- Create New POBox Button -->
                 <div class="summary-cta">
                     <button class="summary-cta__button btn w-100 create_new_pobox_button" type="button" disabled=true>
                         <span class="summary-cta__text text-label-1">{{ __('text.create_new_pobox') }}</span>
                     </button>
                 </div>
                 <div class="d-flex gap-2 mt-3 justify-content-center align-items-center" id="time_take_container">
                     <div class="summary-stats__card-label text-body-3" id="session-message">
                         {{ __('text.pobox_ends_in') }}
                     </div>
                     <div class="summary-stats__card-number text-label-1" id="time_taken_div">
                         <span id="timer-stop-minutes">0m</span>
                         <span id="timer-stop-second">0s</span>
                     </div>
                 </div>

             </div>
         </div>

         <!-- Secondary Navigation at Bottom -->
         @include($ViewFolder . '.partials.nav')
     </div>
 </section>
