  <section class="hero-section container-fluid p-0 position-relative" id="step-4-pobox51" style="display:none;">
  @include($ViewFolder . '.partials.header')
  <div class="hero-section__container position-relative w-100 overflow-hidden">
          <div class="hero-section__background" role="presentation">
          </div>
          <input type="hidden" name="create_event_url" id="create_event_url"
              value="{{ route(ALIAS_USER . 'create-event') }}">

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



          <div class="set-timer-modal position-absolute start-50 translate-middle-x">
              <div class="set-timer-modal__container">
                  <header class="set-timer-modal__header text-center ">
                      <div class="set-timer-modal__swap-icon position-absolute">
                          <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/arrow-swap-horizontal.png') }}"
                              alt="Swap contacts" class="set-timer-modal__swap-image">
                      </div>

                      <h1 class="set-timer-modal__title text-heading-h1">{{ __('text.set_timeout') }}</h1>
                      <p class="set-timer-modal__subtitle text-body-2">
                          {{ __('text.timer_description') }}
                      </p>
                  </header>

                  <div class="set-timer-email-section">
                      <div class="set-timer-email-section__container">
                          <div>
                              <div class="set-timer-email-section__header d-flex align-items-center">
                                  <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/Mail.webp') }}"
                                      alt="Email" class="set-timer-email-section__icon">
                                  <span class="set-timer-email-section__label text-body-3" id="poboxtemp-address">{{ __('text.your_pobox_address') }}</span>
                              </div>
                              <div class="set-timer-email-section__content">
                                  <p class="set-timer-email-section__email text-body-1 mb-0 event_email_with_postfix"
                                      id="timer-email"></p>
                              </div>
                          </div>
                          <div class="custom-width-full">
                              <button class="set-timer-email-section__copy-btn btn  p-2" type="button">
                                  <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/copy.webp') }}"
                                      alt="Copy" class="set-timer-email-section__copy-icon">
                                  <span class="set-timer-email-section__copy-text text-body-3">{{ __('text.copy_email') }}</span>
                              </button>
                          </div>
                      </div>
                  </div>

                  <input type="hidden" name="timer-option" id="timer-option" value="20">

                  <div class="set-timer-selection mb-4">
                      <div class="set-timer-selection__header d-flex align-items-center">
                          <span class="set-timer-selection__label text-body-2">{{ __('text.auto_expire_in') }}</span>
                          <div class="set-timer-selection__clock-icon">
                              <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/information.webp') }}"
                                  alt="information" class="set-timer-selection__information-icon"
                                  title="{{ __('text.timer_tooltip') }}">
                          </div>
                      </div>

                      <div class="set-timer-selection__options d-flex gap-2">
                          <button class="set-timer-option btn" type="button" data-time="5">
                              <span class="set-timer-option__text text-label-2">5<br>{{ __('text.minutes_short') }}</span>
                          </button>
                          <button class="set-timer-option btn" type="button" data-time="10">
                              <span class="set-timer-option__text text-label-2">10<br>{{ __('text.minutes_short') }}</span>
                          </button>
                          <button class="set-timer-option btn" type="button" data-time="15">
                              <span class="set-timer-option__text text-label-2">15<br>{{ __('text.minutes_short') }}</span>
                          </button>
                          <button class="set-timer-option btn set-timer-option--selected" type="button" data-time="20">
                              <span class="set-timer-option__text text-label-2">20<br>{{ __('text.minutes_short') }}</span>
                          </button>
                      </div>
                  </div>

                  <div class="set-timer-activate">
                      <input type="hidden" id="is-activate-btn" value="0">
                      <button createevent_url="{{ route(ALIAS_USER . 'check-event-name') }}"
                          class="temp-email-cta-button btn w-100 create-email-btn create-email-disable-btn  create_event_btn set-timer-activate__button btn w-100"
                          type="button">
                          <span class="set-timer-activate__text text-label-1">{{ __('text.activate_my_pobox') }}</span>
                      </button>
                  </div>
              </div>
          </div>

          @include($ViewFolder . '.partials.nav')
      </div>

      <!-- Centered Tooltip for Copy Feedback -->
      <div id="copy-tooltip" class="copy-tooltip" style="display: none;">
          <span class="copy-tooltip-text p-1">Copied!</span>
      </div>
  </section>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const timerOptions = document.querySelectorAll('.set-timer-option');
          const copyButton = document.querySelector('.set-timer-email-section__copy-btn');
          const activateButton = document.querySelector('.set-timer-activate__button');
          const backButton = document.querySelector('.set-timer-modal__back');

          let selectedTime = 20;

          timerOptions.forEach(option => {
              option.addEventListener('click', function() {
                  timerOptions.forEach(opt => opt.classList.remove('set-timer-option--selected'));
                  this.classList.add('set-timer-option--selected');
                  selectedTime = parseInt(this.dataset.time);
                  $("#timer-option").val(selectedTime);
                  console.log('Selected timer:', selectedTime, 'minutes');
                  localStorage.setItem('event_seconds', selectedTime * 60);
                  setTimeout(() => {
                      this.blur();
                  }, 100);
              });
          });

          if (copyButton) {
              copyButton.addEventListener('click', function() {
                  const email = $("#timer-email").text().trim();
                  const tooltip = document.getElementById('copy-tooltip');
                  const originalContent = copyButton.innerHTML;

                  navigator.clipboard.writeText(email).then(function() {
                      // Store original text before changing innerHTML
                      const originalText = copyButton.querySelector('.set-timer-email-section__copy-text').textContent;

                      // Change button to show checkmark
                      copyButton.innerHTML = '✓';

                      // Show tooltip
                      tooltip.style.display = 'block';

                      // Hide tooltip and restore button after 1.5 seconds
                      setTimeout(() => {
                          tooltip.style.display = 'none';
                          copyButton.innerHTML = originalContent;
                          copyButton.blur();
                      }, 1500);

                  }).catch(function(err) {
                      console.error('Copy failed:', err);
                  });
              });
          }
      });
  </script>
