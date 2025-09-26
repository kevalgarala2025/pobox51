<section class="hero-section container-fluid p-0 position-relative" id="step-1-pobox51" style="display:none;">
    @include($ViewFolder . '.partials.header')
    <div class="hero-section__container position-relative w-100 overflow-hidden">
        <div class="hero-section__background d-flex" role="presentation">
        
            <div class="bg-small-image"></div>
        </div>
        
        <aside class="hero-section__visuals hero-section__visuals--left position-absolute"
            aria-label="Contact sharing visualization">
            <figure class="hero-section__avatars m-0">
                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/left.webp') }}"
                    alt="Multiple contact avatars showing group sharing feature"
                    class="hero-section__avatars-image w-100 h-100">
            </figure>
        </aside>

        <aside class="hero-section__visuals hero-section__visuals--center position-absolute"
            aria-label="Mobile app preview">
            <figure class="hero-section__phone m-0 position-relative">
                <div class="hero-section__phone-image-wrapper">
                    <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/iPhone.png') }}"
                        alt="POBox51 mobile app interface on iPhone" class="hero-section__phone-image">
                </div>
            </figure>
        </aside>

        <aside class="hero-section__visuals hero-section__visuals--right position-absolute"
            aria-label="Contact bundle visualization">
            <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/right.webp') }}"
                alt="Contact bundle card with connection visualization" class="hero-section__right-image w-100 h-100">
        </aside>
        <div class="hero-section__content position-absolute start-50 translate-middle-x text-center">
            <h1 class="hero-section__title text-title-3 mb-3">{{ __('text.instantly_share') }}</h1>
            <p class="hero-section__subtitle text-body-1 mb-0">
                {{ __('text.group_share') }}
            </p>
        </div>

        <div
            class="cta-button position-absolute  start-50 translate-middle-x d-flex flex-column align-items-center justify-content-center">
            <!-- <div class="cta-button__wave position-absolute" aria-hidden="true"></div> -->
            <div class="d-flex justify-content-center flex-column align-items-center gap-3" >
            <button
                class="cta-button__icon-container d-flex justify-content-center  go-to-create-event"
                type="button" aria-describedby="icon-button-desc">
                <div class="cta-button__icon" aria-hidden="true">
                </div>
            </button>
            <span id="icon-button-desc" class="visually-hidden">{{ __('text.share_contacts_action_button') }}</span>

            <button
                class="cta-button__text text-heading-h3 bg-transparent border-0 w-100 text-center go-to-create-event"
                type="button" aria-describedby="cta-description">
                {{ __('text.share_button_lable') }}
            </button>
            <span id="cta-description" class="visually-hidden">{{ __('text.share_contacts_now') }}</span>
            </div>
        </div>

        @include($ViewFolder . '.partials.nav')
    </div>
</section>
