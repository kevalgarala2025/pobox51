@if (!Auth::guard(GUARD_USER)->check())
    <section class="hero-section container-fluid p-0 position-relative" id="step-3-pobox51" style="display:none;">
    @include($ViewFolder . '.partials.header')
        <div class="hero-section__container position-relative w-100 overflow-hidden">
            <div class="hero-section__background" role="presentation">
            </div>

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

            

            <div class="verify-identity-modal position-absolute start-50 translate-middle-x">
                <div class="verify-identity-modal__container">
                    <header class="verify-identity-modal__header text-center mb-4">
                        <button class="verify-identity-modal__back position-absolute" type="button"
                            aria-label="Go back">
                            <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/back-arrow.webp') }}"
                                alt="" class="verify-identity-modal__back-icon">
                        </button>

                        <h1 class="verify-identity-modal__title text-heading-h1 mb-3">{{ __('text.verify_identity') }}</h1>
                        <p class="verify-identity-modal__subtitle text-body-2">
                            {{ __('text.identity_verification_desc') }}
                        </p>
                    </header>

                    <div class="verify-identity-signin mb-4">
                        <a href="{{ route(ALIAS_USER . ALIAS_USER_AUTH . 'google.login') }}"
                            class="verify-identity-signin-button btn w-100 d-flex align-items-center justify-content-center"
                            type="button">
                            <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/google.webp') }}" alt="Google"
                                class="verify-identity-signin-button__icon me-2">
                            <span class="verify-identity-signin-button__text text-label-1">{{ __('text.sign_in_with_google') }}</span>
                            </button>
                        </a>
                    </div>
                    <div class="d-flex flex-column">
                    <div class="verify-identity-securid-icon">
                        <div class="verify-identity-securid-icon__container">
                            <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/securid.webp') }}"
                                alt="SecurID Security" class="verify-identity-securid-icon__image">
                        </div>
                    </div>

                    <div class="verify-identity-privacy-text">
                        <p class="verify-identity-privacy-text__content text-body-2 mb-0">
                            {{ __('text.privacy_notice') }}
                        </p>
                    </div>
                    </div>
                </div>
            </div>

            @include($ViewFolder . '.partials.nav')
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const backButton = document.querySelector('.verify-identity-modal__back');

            // Handle back button click
            if (backButton) {
                backButton.addEventListener('click', function() {
                    // Hide current step and show previous step
                    document.getElementById('step-3-pobox51').style.display = 'none';
                    document.getElementById('step-2-pobox51').style.display = 'block';
                });
            }

            // Handle browser back button to prevent OAuth state issues
            window.addEventListener('popstate', function(event) {
                // If we're on step 3 and user presses back, go to step 2
                if (document.getElementById('step-3-pobox51').style.display !== 'none') {
                    event.preventDefault();
                    document.getElementById('step-3-pobox51').style.display = 'none';
                    document.getElementById('step-2-pobox51').style.display = 'block';
                    return false;
                }
            });

            // Clear localStorage when starting OAuth to prevent state issues
            const googleLoginButton = document.querySelector('.verify-identity-signin-button');
            if (googleLoginButton) {
                googleLoginButton.addEventListener('click', function() {
                    // Clear any existing OAuth state
                    sessionStorage.removeItem('oauth_state');
                    localStorage.removeItem('oauth_state');
                });
            }
        });
    </script>
@endif
