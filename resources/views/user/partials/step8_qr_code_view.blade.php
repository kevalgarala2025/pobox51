<section class="hero-section container-fluid p-0 position-relative" id="step-8-pobox51" style="display:none;">
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
                        alt="POBox51 mobile app interface on iPhone" class="hero-section__phone-image qr-code-phone">
                </div>
            </figure>
        </aside>

        <!-- Site Header with Logo -->
        <header class="site-header position-absolute start-50 translate-middle-x" role="banner">
            <div class="site-header__logo-container">
                <div class="site-header__logo-wrapper">
                    <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/logo/company-logo.svg') }}"
                        alt="POBox51 - Contact sharing platform" class="site-header__logo">
                </div>
            </div>
        </header>

        <!-- QR Code Modal -->
        <div class="qr-code-modal translate-middle-x">
            <div class="qr-code-modal__container">
                <!-- Close Button -->
                <button class="qr-code-modal__close position-absolute" type="button" aria-label="Close modal" style="width: 40px; height: 40px;">
                    <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/close-grey.webp') }}" alt="Close"
                        class="qr-code-modal__close-icon">
                </button>

                <!-- Modal Header -->
                <header class="qr-code-modal__header">
                    <h1 class="qr-code-modal__title">{{ __('text.scan_to_open_email') }}</h1>
                    <p class="qr-code-modal__subtitle">
                        {{ __('text.qr_code_description') }}
                    </p>
                </header>

                <!-- Email Address Section -->
                <div class="qr-code-email-section ">
                    <p class="qr-code-email-section__address event_email_with_postfix">samuraifitnesscontest@pobox51.com
                    </p>
                </div>
                <!-- QR Code Display Section -->
                <div class="qr-code-display">
                    <div class="qr-code-display__container">
                        <div class="qr-code-display__wrapper">
                            <img src="" alt="QR Code for contact sharing" class="qr-code-display__image"
                                aria-label="QR Code - Click to enlarge" id="qr-code-image">
                        </div>
                    </div>
                </div>

                <!-- Download Button -->
                <div class="qr-code-download">
                    <button class="qr-code-download__button btn w-100" type="button" id="download-btn">
                        <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/download-yellow.webp') }}"
                            alt="Download" class="qr-code-download-button__icon">
                        <span class="qr-code-download__text">{{ __('text.download_qr_code') }}</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Secondary Navigation at Bottom -->
        @include($ViewFolder . '.partials.nav')
    </div>

</section>
