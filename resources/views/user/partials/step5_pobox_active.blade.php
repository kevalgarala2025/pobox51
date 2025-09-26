 <section class="hero-section container-fluid p-0 position-relative" id="step-5-pobox51" style="display:none;">
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
         <input type="hidden" name="completed-event-value" id="completed-event-value"
             value="{{ route(ALIAS_USER . 'completed-event') }}" />

         <!-- Site Header with Logo -->
         

         <!-- POBox Active Modal -->
         <div class="pobox-active-modal position-absolute">
             <div class="pobox-active-modal__container">

                 <!-- Swap Icon (Hidden by default as per Figma) -->
                 <div class="pobox-active-modal__swap-icon">
                     <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/arrow-swap-horizontal.png') }}"
                         alt="Swap" class="pobox-active-modal__swap-image">
                 </div>

                 <!-- 1. Modal Title -->
                 <div class="pobox-active-modal__header">
                     <h1 class="pobox-active-modal__title">{{ __('text.pobox_live') }}</h1>
                 </div>

                 <!-- 2. Description/Subtitle Text -->
                 <div class="pobox-active-description">
                     <p class="pobox-active-description__text">
                         {{ __('text.pobox_live_desc') }}
                     </p>
                 </div>

                 <!-- 3. Email Address Section -->
                 <div class="pobox-active-email">
                     <div class="pobox-active-email__container">
                         <!-- Email Header with Icon and Label -->
                         <div class="pobox-active-email__header">
                             <div class="pobox-active-email__label-section">
                                 <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/Mail.webp') }}"
                                     alt="Mail" class="pobox-active-email__mail-icon">
                                 <span class="pobox-active-email__label">{{ __('text.your_pobox_address') }}</span>
                             </div>
                             <div class="pobox-active-email__address-section">
                                 <span class="pobox-active-email__address event_email_with_postfix"
                                     id="pobox-active-email"></span>
                             </div>
                         </div>
                         <!-- Action Buttons -->
                         <div class="pobox-active-email__actions">
                             <button class="pobox-active-email__copy-btn" type="button"
                                 aria-label="Copy email address">
                                 <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/copy.webp') }}"
                                     alt="Copy" class="pobox-active-email__action-icon">
                                     <span class="set-timer-email-section__copy-text text-body-3">{{ __('text.copy_email') }}</span>
                             </button>
                             <button class="pobox-active-email__share-btn" type="button"
                                 aria-label="Share email address">
                                 <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/QR-icon.webp') }}"
                                     alt="Share" class="pobox-active-email__action-icon">
                                     <span class="set-timer-email-section__copy-text text-body-3">{{ __('text.qr_code') }}</span>
                             </button>
                         </div>
                     </div>
                 </div>

                 <!-- 4. Timer Section with Green Background -->
                 <div class="pobox-active-timer">
                     <div class="pobox-active-timer__container" id="pobox-active-timer__container">
                         <div class="pobox-active-timer__display">
                             <span class="pobox-active-timer__time" id="pobox-active-timer__time">
                                 <span class="tk_counter minutes">00</span> : <span class="tk_counter seconds">00</span>
                             </span>
                         </div>
                         <div class="pobox-active-timer__add-section">
                             <button class="pobox-active-timer__add-btn" type="button" id="add_time_btn">
                                 <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/plus-yellow.webp') }}"
                                     alt="Add" class="pobox-active-timer__add-icon">
                                 <span class="pobox-active-timer__add-text">{{ str_replace(':minutes', (int) $event_addon_timer_in_seconds / 60, __('text.add_minutes')) }}</span>
                             </button>
                         </div>
                     </div>
                 </div>

                 <!-- 5. Status Section with Mail Icon -->
                 <div class="pobox-active-status">
                     <div class="pobox-active-status__container">
                         <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'image/icons/webp/Mail.webp') }}" alt="Mail"
                             class="pobox-active-status__icon">
                         <span
                             class="pobox-active-status__text contact_count">{{ isset($user_event_contact_received) ? $user_event_contact_received : __('text.no_responses_yet') }}</span>
                     </div>
                 </div>

                 <!-- 6. Slide to Stop Section -->
                 {{-- <div class="pobox-active-slide">
                 <div class="pobox-active-slide__track">
                     <div class="pobox-active-slide__text">
                         <span>Slide to complete</span>
                     </div>
                     <div class="pobox-active-slide__handle">
                        <div class="arrow-image">
                        </div>
                     </div>
                 </div>
             </div> --}}
                 <div class="slide-container" id="slideContainer">
                     <div class="slide-track" id="slideTrack"></div>
                     <div class="slide-button" id="slideButton">
                         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="155" height="96" viewBox="0 0 155 96">
                             <image
                                 xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJsAAABgCAYAAAAKNABWAAAAAXNSR0IArs4c6QAABolJREFUeF7t3YGxEzcQBmCpg9DBSwekA14HSQVABUAFJBXwUgFQAUkFoQPogJcKoIPFP6ObKLbOku5W2n32fzMZMhPFvl19Wsky1sXAixmYlIE46X34NsxAIDYimJYBYpuWar5RFZuI/BRCeBxCuEnpug8hfI4xfnto6Uux/Jrd932M8eNDiwP3KyLoE/yDC32BPkHfuL3OYhOR14dAXoYQAO74ugsh/PEQ0IkIBsrbEMKTQhzoIMTxzm0vZTcmIogB/VKKBQPnuVd0RWypAvyTjZy1fkBH3XoNLqsAiKU0YPK47mKMrzyDS4P/94Z7fBZjfN/QbmqTNWzonNLIKd2cW3Cpon1qgLbE9S7G+HxqDzS+mYi8OMSB2aT1cgfuBJuIPEtTTmtQaOcSnIhg6kQ8PZc7cBsGzRKvK3AlbKgEy8Kzp5NcgUsd9KUngKytK3AbC4A7cP/DltZqXzd2kKsKt7ODEIsbcCLSs6wpdZ+LCneMDZ/atlaDJUgXFU5EsJDGp7Y9lwtwIrJ1tsljNwc3ApuLCqeEzUWFU8KGWEzBldZsmEZr2wQt1cK0wokINm8/tNxoQxvTCndYf2IP8GnDfbY0MQNXwrZ3fZAHbAYurT+xJNAYOKYVLm3kol+0LhNwJWz4JIo1gtZlCU5j3ZbnwazCKU6lZp9S1zZ18RXVGy1tlvtwAzrJBNyOvbZz3Ti1wq1+N6q4wDb9lNrx1VvP2LICh1mn5au3nlimgat9Ea89DZlMqQRXtTcFXMtfMSK49b5ihas6/q9BFRuacko9m1GCawTXhI3gqtkkuGqKQt9vEFjhWOEaTK02aa5syysQHMFtBdeNjVNqNdWcUldStAkbwRFcNQOFBpuxEVw13axwRynahY3gCK6agazBbmwEV003K1xKkQo2giO4agYOP85Vw0Zw1XRffYVTxUZwBHcuA+rYCI7g1jIwBBvBEVwpA8OwERzBHWdgKDaCI7g8A8OxERzBLRmYgo3gCA4ZmIaN4AhuKjaCu25w07ER3PWCM8FGcNcJzgwbwV0fOFNsA8H9MvsU80E/hDY5VDode6/9y/tbc2yDwFl1Ek5MajllvVrWsgY4jX36sxoGgLt3gW0AODyE4ufZ1S3FoQ3uY4zxtkenVlttcG6wDQCHh0+YPEhDeUr9FmN8pAWo93U0wbnCpgwOT21peUBFb/6b2iuDuzk8n+Hfpjce0EgLnEdsOHRZAwmxKcG7SGwdj8tpSeNvMca/Whpqt1GuaiEeSrT2Pba+nhY0vJ9ZEMfBKkPDyz+6kA8If8cY8ycJtjrZ3U4TmhtsA6BZ/bhE+5Mo+gh7hp93y+l8AW1oOOrWvLINgIbTLS9lU9dk3TkAGqjbbuoOgjb9kZTaa7RUhN4fHq3Z+5C3zvp12nwQtB/bUGaVjdDOurg4aGZrNkK7Pmgm2AjtOqFNx0Zo1wttKjZCu25o07ARGqFNwUZohLZkYOjWB6ERWp6BYdgIjdCOMzAEG6ERWikD6tgIjdDWMqCKjdAI7VwG1LARGqHV/haACjZCI7QaNJV9NkIjtBZou7ERGqG1QtuFjdAIrQfaZmyERmi90DZhIzRC2wKtGxuhEdpWaF3YCI3Q9kBrxkZohLYXWhM2QiM0DWhVbIRGaFrQzmIjNELThLaK7VKgIUAR+RRCeKyYOKsfEN+kI1Txp9Y19cDEky/iRQTBfNGKBgeK/DjnIUb8OfUaMGhMoKVBgz55sNCKlU1E3h6AaJ0xYQZtQAdZQsORWR8UR+rUirbcd6myfQ0h4OinvZc1tCdp2tkbB/5/M2hp0GgWABNoJ5VNcQo1hZY6CEel4sjUvZcptBQLjrvH4Nl7mUEbhc0cmiI2c2gpFo0POabQStgwfWIa3Xq5gJY6COtOTD9bLxfQUixYr+056tQc2gm2nSXbDbQUx56B4wZaiuVlCOHNxlHjAtoati0VwRW0pVNEZMtaxxW0bOBg66P3g5sbaEVsG6qbS2gpDuxLYb3T2knuoGUDp7e6uYJ2DlvrqdduoWWdhG8PsOapbYi6hZbF0voJ2x20VWxHwT0tdBQeRPbnoWLg6Xf4d9dX2tJBRyGW4wv3j1O571wHkW5ORLDMwZZOafDg6X2vLI6yb8ld0+9GRQR7PEtw6Bw8Kc49suMEJHSodMu0em/xeMWWjqm1Sad6o0+WWNAn078SrN1n/t+bsPW8INsyA2sZIDbamJYBYpuWar4RsdHAtAx8B3F7dsaqCpAlAAAAAElFTkSuQmCC"
                                 x="30" y="0" width="96" height="96" />
                         </svg>
                     </div>
                     <div class="slide-text" id="slideText">{{ __('text.slide_to_complete') }}</div>
                 </div>
             </div>
         </div>
                     <!-- Centered Tooltip for Copy Feedback -->
      <div id="copy-tooltip-2" class="copy-tooltip" style="display: none;">
          <span class="copy-tooltip-text p-1">Copied!</span>
      </div>
         <!-- Secondary Navigation at Bottom -->
         @include($ViewFolder . '.partials.nav')
     </div>
 </section>

 <script>
     // POBox Active page interactions
     const poboxActiveModal = () => {
         const addTimeButton = document.querySelector('.pobox-active-timer__add-btn');
         const copyButton = document.querySelector('.pobox-active-email__copy-btn');
         console.log(copyButton);

         const shareButton = document.querySelector('.pobox-active-email__share-btn');
         const slideHandle = document.querySelector('.pobox-active-slide__handle');
         const slideTrack = document.querySelector('.pobox-active-slide__track');

         let timerMinutes = $("#event_initial_timer_in_seconds").val() ? Math.floor($(
             "#event_initial_timer_in_seconds").val() / 60) : 10;
         let timerSeconds = 00;
         let timerInterval;

         // Update timer color based on remaining time
         function updateTimerColor() {
             const timerDisplay = document.getElementById('pobox-active-timer__time');
             const timerContainer = document.getElementById('pobox-active-timer__container');
             if (timerMinutes < 2) {
                 timerDisplay.classList.add('pobox-active-timer__time_red');
                 timerDisplay.classList.remove('pobox-active-timer__time');

             } else {
                 timerDisplay.classList.add('pobox-active-timer__time');
                 timerDisplay.classList.remove('pobox-active-timer__time_red');
             }
         }

         function startTimer() {
             timerInterval = setInterval(function() {
                 if (timerSeconds > 0) {
                     timerSeconds--;
                 } else if (timerMinutes > 0) {
                     timerMinutes--;
                     timerSeconds = 59;
                 } else {
                     clearInterval(timerInterval);
                     handleTimerEnd();
                     return;
                 }

                 updateTimerDisplay();
             }, 1000);
         }

         // Update timer display
         function updateTimerDisplay() {
             const timerDisplay = document.getElementById('pobox-active-timer__time');
             if (timerDisplay) {
                 timerDisplay.textContent = `${timerMinutes}:${timerSeconds.toString().padStart(2, '0')}`;
                 updateTimerColor();
             }
         }

         // Handle timer end
         function handleTimerEnd() {
             showHideSection('step-7-pobox51');
             // In a real implementation, this would trigger the contact file sending process
         }

         // Copy email button
         if (copyButton) {
             // pobox-active-email__label event_email_with_postfix
             copyButton.addEventListener('click', function() {
                 const emailText = $("#pobox-active-email").text();
                 navigator.clipboard.writeText(emailText).then(function() {
                     // Show success feedback
                     const originalContent = copyButton.innerHTML;
                     copyButton.innerHTML = '✓';
                     setTimeout(function() {
                         copyButton.innerHTML = originalContent;
                     }, 2000);
                 }).catch(function() {
                     alert('Email address: ' + emailText);
                 });
             });
         }

         // Share email button
         if (shareButton) {
             shareButton.addEventListener('click', function() {
                 console.log("Enter");

                 const emailText = 'samuraifitnesscontest@pobox51.com';
                 showHideSection('step-8-pobox51');
                 if (navigator.share) {
                     navigator.share({
                         title: 'POBox51 Email Address',
                         text: 'Join my POBox51 contact sharing session:',
                         url: emailText
                     });
                 } else {
                     alert('Share this email address: ' + emailText);
                 }
             });
         }

         // Slide to stop functionality
         let isDragging = false;
         let startX = 0;
         let currentX = 0;

         if (slideHandle && slideTrack) {
             slideHandle.addEventListener('mousedown', startDrag);
             slideHandle.addEventListener('touchstart', startDrag);

             document.addEventListener('mousemove', drag);
             document.addEventListener('touchmove', drag);

             document.addEventListener('mouseup', endDrag);
             document.addEventListener('touchend', endDrag);

             function startDrag(e) {
                 isDragging = true;
                 startX = e.type === 'mousedown' ? e.clientX : e.touches[0].clientX;
                 slideHandle.style.transition = 'none';
             }

             function drag(e) {
                 if (!isDragging) return;

                 e.preventDefault();
                 currentX = (e.type === 'mousemove' ? e.clientX : e.touches[0].clientX) - startX;

                 const trackWidth = slideTrack.offsetWidth;
                 const handleWidth = slideHandle.offsetWidth;
                 const maxDrag = trackWidth - handleWidth;

                 if (currentX < 0) currentX = 0;
                 if (currentX > maxDrag) currentX = maxDrag;

                 slideHandle.style.transform = `translateX(${currentX}px)`;

                 // Check if dragged far enough to trigger action (80% of track)
                 if (currentX > maxDrag * 0.8) {
                     endDrag();
                     $.ajax({
                         type: 'post',
                         url: "{{ route(ALIAS_USER . 'completed-event') }}",
                         data: {
                             'v_event_name': $(".v_event_name").val()
                         },
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },
                         success: function(response) {
                             if (response.flag) {
                                 ToastHelper.success(response.msg, 'Cancel Event');

                                 stopPOBox();
                             } else {
                                 $(".v_event_name:visible").val('');
                                 ToastHelper.error(response.msg, 'Error');
                             }
                         },
                         error: function() {
                             ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
                         }
                     });
                 }
             }

             function endDrag() {
                 if (!isDragging) return;

                 isDragging = false;
                 slideHandle.style.transition = 'transform 0.3s ease';
                 slideHandle.style.transform = 'translateX(0)';
             }

             function stopPOBox() {
                 clearInterval(timerInterval);
                 showHideSection('step-6-pobox51');
                 // In a real implementation, this would stop the session and send contacts
             }
         }

         // Start the timer when page loads
         startTimer();

         // Keyboard accessibility
         if (addTimeButton) {
             addTimeButton.addEventListener('keydown', function(e) {
                 if (e.key === 'Enter' || e.key === ' ') {
                     e.preventDefault();
                     addTimeButton.click();
                 }
             });
         }

         if (copyButton) {
             copyButton.addEventListener('keydown', function(e) {
                 if (e.key === 'Enter' || e.key === ' ') {
                     e.preventDefault();
                     copyButton.click();
                 }
             });
         }

         if (shareButton) {
             shareButton.addEventListener('keydown', function(e) {
                 if (e.key === 'Enter' || e.key === ' ') {
                     e.preventDefault();
                     shareButton.click();
                 }
             });
         }
     };
 </script>
