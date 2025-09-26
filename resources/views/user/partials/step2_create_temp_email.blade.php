 <section class="hero-section container-fluid p-0 position-relative" id="step-2-pobox51" style="display:none;">
 @include($ViewFolder . '.partials.header')
    <div class="hero-section__container position-relative w-100 overflow-hidden">
        <div class="hero-section__background" role="presentation">
        </div>
        
        <aside class="hero-section__visuals hero-section__visuals--center position-absolute" aria-label="Mobile app preview">
            <figure class="hero-section__phone m-0 position-relative">
                <div class="hero-section__phone-image-wrapper">
                    <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/iPhone.png') }}" alt="POBox51 mobile app interface on iPhone"
                        class="hero-section__phone-image temp-email-phone">
                </div>
            </figure>
        </aside>

        

        <div class="temp-email-modal position-absolute start-50 translate-middle-x">
            <div class="temp-email-modal__container">
                <header class="temp-email-modal__header text-center">
                    <h1 class="temp-email-modal__title text-heading-h1 mb-3">{{ __('text.create_temp_email') }}</h1>
                    <p class="temp-email-modal__subtitle text-body-2 mb-0">
                        {{ __('text.temp_email_description') }}
                    </p>
                </header>

                <div class="temp-email-input__container">
                    <div class="temp-email-input__field position-relative">
                        <div class="d-flex align-items-center">
                            <input type="text" id="pobox51-email-prefix" class="temp-email-input__prefix form-control v_event_name"
                               value="" aria-label="Email prefix" placeholder="{{ __('text.email_placeholder') }}">
                            <div class="temp-email-input__check-btn">
                                <span class="temp-email-input__domain ">@pobox51.com</span>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" id="pobox51-email-prefix-check-icon" style="display:none">
                                    <circle cx="8" cy="8" r="8" fill="#22C55E" />
                                    <path d="M5 8L7 10L11 6" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <svg width="16" height="16" viewBox="0 0 32 32" style="display:none" id="pobox51-email-prefix-cross-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#ff0000" stroke="#ff0000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.64"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <title>cross-circle</title>
                                        <desc>Created with Sketch Beta.</desc>
                                        <defs> </defs>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                            <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-570.000000, -1089.000000)" fill="#ff0000">
                                                <path d="M591.657,1109.24 C592.048,1109.63 592.048,1110.27 591.657,1110.66 C591.267,1111.05 590.633,1111.05 590.242,1110.66 L586.006,1106.42 L581.74,1110.69 C581.346,1111.08 580.708,1111.08 580.314,1110.69 C579.921,1110.29 579.921,1109.65 580.314,1109.26 L584.58,1104.99 L580.344,1100.76 C579.953,1100.37 579.953,1099.73 580.344,1099.34 C580.733,1098.95 581.367,1098.95 581.758,1099.34 L585.994,1103.58 L590.292,1099.28 C590.686,1098.89 591.323,1098.89 591.717,1099.28 C592.11,1099.68 592.11,1100.31 591.717,1100.71 L587.42,1105.01 L591.657,1109.24 L591.657,1109.24 Z M586,1089 C577.163,1089 570,1096.16 570,1105 C570,1113.84 577.163,1121 586,1121 C594.837,1121 602,1113.84 602,1105 C602,1096.16 594.837,1089 586,1089 L586,1089 Z" id="cross-circle" sketch:type="MSShapeGroup"> </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="temp-email-input__underline-yellow" id="pobox51-email-prefix-underline"></div>
                    </div>

                    <div class="temp-email-success d-flex align-items-center mt-1 position-absolute">
                        <span class="temp-email-success__text text-body-3" id="pobox51-email-prefix-text"></span>
                    </div>
                </div>

                <div class="temp-email-features ">
                    <ul class="temp-email-features__list list-unstyled">
                        <li class="temp-email-features__item d-flex align-items-center ">
                            <div class="temp-email-features__icon me-3">
                                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/Check-Badge--Streamline-Ultimate.webp') }}" alt="Check Badge"
                                    class="check-badge">
                            </div>
                            <span class="temp-email-features__text text-body-2">{{ __('text.temp_email_feature1') }}</span>
                        </li>
                        <li class="temp-email-features__item d-flex align-items-center ">
                            <div class="temp-email-features__icon me-3">
                                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/Check-Badge--Streamline-Ultimate.webp') }}" alt="Check Badge"
                                    class="check-badge">
                            </div>
                            <span class="temp-email-features__text text-body-2">{{ __('text.temp_email_feature2') }}</span>
                        </li>
                        <li class="temp-email-features__item d-flex align-items-center">
                            <div class="temp-email-features__icon me-3">
                                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/Check-Badge--Streamline-Ultimate.webp') }}" alt="Check Badge"
                                    class="check-badge">
                            </div>
                            <span class="temp-email-features__text text-body-2">{{ __('text.temp_email_feature3') }}</span>
                        </li>
                    </ul>
                </div>

                <div class="temp-email-modal__cta text-center">
                    <button  class="temp-email-cta-button btn w-100" type="button" id="pobox51-create-email-btn" disabled>
                        <span class="temp-email-cta-button__text text-label-1">{{ __('text.create_email_continue') }}</span>
                    </button>
                </div>
            </div>
        </div>
        @include($ViewFolder . '.partials.nav')
    </div>

 </section>
