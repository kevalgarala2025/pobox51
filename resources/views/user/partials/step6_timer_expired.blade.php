<section class="hero-section container-fluid p-0 position-relative" id="step-7-pobox51" style="display:none;">
    <!-- Same Background as Home Page -->
    <div class="hero-section__background position-absolute top-0 start-0 w-100" role="presentation">
    </div>

    <!-- Hero Visuals - Phone Section (50% Opacity) -->
    <aside class="hero-section__visuals hero-section__visuals--center position-absolute" aria-label="Mobile app preview">
        <figure class="hero-section__phone m-0 position-relative">
            <div class="hero-section__phone-image-wrapper">
                <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/iPhone.png') }}"
                    alt="POBox51 mobile app interface on iPhone" class="hero-section__phone-image temp-email-phone">
            </div>
        </figure>
    </aside>

    <!-- Site Header with Logo -->
    @include($ViewFolder . '.partials.header')

    <!-- Timer Completed Modal -->
    <div class="timer-completed-modal position-absolute start-50 translate-middle">
        <div class="timer-completed-modal__container">
            <!-- Closed Box Image -->
            <div class="timer-completed-image">
                <div class="timer-completed-image__container">
                    <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/closed-box.png') }}" alt="Closed POBox" class="timer-completed-image__box">
                </div>
            </div>

            <!-- Modal Header -->
            <header class="timer-completed-modal__header text-center">
                <h1 class="timer-completed-modal__title text-heading-h1">{{ __('text.pobox_closed') }}</h1>
            </header>

            <!-- Description -->
            <div class="timer-completed-description text-center mb-4">
                <p class="timer-completed-description__text text-body-2">
                    {{ __('text.pobox_closed_desc') }}
                </p>
            </div>

            <!-- Create New POBox Button -->
            <div class="timer-completed-cta summary-cta">
                <button class="timer-completed-cta__button btn w-100 create_new_pobox_button" type="button">
                    <span class="timer-completed-cta__text text-label-1">{{ __('text.create_new_pobox_btn') }}</span>
                </button>
            </div>

            <!-- Help Link -->
            <div class="timer-completed-help text-center mt-4">
                <a class="timer-completed-help__link text-body-2" aria-describedby="how-it-works-desc" data-bs-toggle="modal" data-bs-target="#how_it_work_modal">
                    {{ __('text.need_help') }}<span>{{ __('text.learn_how_it_works_short') }}</span>
                </a>
            </div>
        </div>
    </div>
</section>
