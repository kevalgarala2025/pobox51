<script type="text/javascript">
    var MSG_SOMETHING_WENT_WRONG_AT_SERVER = '<?= MSG_SOMETHING_WENT_WRONG_AT_SERVER ?>';
    var MSG_FOR_SUCCESSFULLY_ADD_TIME_IN_RUNNIG_EVENT = '<?= MSG_FOR_SUCCESSFULLY_ADD_TIME_IN_RUNNIG_EVENT ?>';
    var MSG_FOR_FILL_EMAIL_BEFORE_START_EVENT = '<?= MSG_FOR_FILL_EMAIL_BEFORE_START_EVENT ?>';
    var MSG_FOR_EVENT_NOT_FOUND = '<?= MSG_FOR_EVENT_NOT_FOUND ?>';
    var MSG_FOR_FILL_VALID_EMAIL_PREFIX_BEFORE_START_EVENT =
        '<?= MSG_FOR_FILL_VALID_EMAIL_PREFIX_BEFORE_START_EVENT ?>';
    var MSG_EVENT_NAME_SPACE_NOT_ALLOWED = '<?= MSG_EVENT_NAME_SPACE_NOT_ALLOWED ?>';


    var MSG_GEOLOCATION_NOT_SUPPORT_BY_BROWSER = '<?= MSG_GEOLOCATION_NOT_SUPPORT_BY_BROWSER ?>';
    var MSG_GEOLOCATION_DENIED_BY_USER_TO_CREATE_EVENT = '<?= MSG_GEOLOCATION_DENIED_BY_USER_TO_CREATE_EVENT ?>';

    var MSG_FOR_MOBILE_DEVICE_USER_EXPERIENCE = '<?= MSG_FOR_MOBILE_DEVICE_USER_EXPERIENCE ?>';
</script>

<script src="{{ asset(FRONTEND_JS_FOLDER_PATH . 'libraries.js') }}"></script>
<script src="{{ mix(FRONTEND_JS_FOLDER_PATH . 'custom.js') }}" defer></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="{{ asset(FRONTEND_JS_FOLDER_PATH . 'iziToast.min.js') }}"></script> -->
<script src="{{ asset('assets/js/toast-helper.js') }}"></script>


<!-- Custom JavaScript -->
<script>
    // CTA Button click handler
    document.addEventListener('DOMContentLoaded', function() {
        const ctaIconButton = document.querySelector('.cta-button__icon-container');
        const ctaTextButton = document.querySelector('.cta-button__text');

        // Function to redirect to Create Temp Email page
        function redirectToCreateEmail() {
            showHideSection('step-2-pobox51');
        }



        // Add click handlers to both icon and text buttons
        if (ctaIconButton) {
            ctaIconButton.addEventListener('click', redirectToCreateEmail);
        }

        if (ctaTextButton) {
            ctaTextButton.addEventListener('click', redirectToCreateEmail);
        }

        // Add keyboard support for accessibility
        if (ctaIconButton) {
            ctaIconButton.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    redirectToCreateEmail();
                }
            });
        }

        if (ctaTextButton) {
            ctaTextButton.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    redirectToCreateEmail();
                }
            });
        }

        const input = document.getElementById('pobox51-email-prefix');
        const button = document.getElementById('pobox51-create-email-btn');
        const underline = document.getElementById('pobox51-email-prefix-underline');
        const text = document.getElementById('pobox51-email-prefix-text');
        const checkIcon = document.getElementById('pobox51-email-prefix-check-icon');
        const crossIcon = document.getElementById('pobox51-email-prefix-cross-icon');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const url = `{{ route(ALIAS_USER . 'check-event-name') }}`;

        // Email validation functions
        function isValidEmailPrefix(prefix) {
            // Email prefix validation: alphanumeric, dots, hyphens, underscores
            const emailPrefixRegex = /^[a-zA-Z0-9._-]+$/;
            return emailPrefixRegex.test(prefix) && prefix.length >= 3 && prefix.length <= 50;
        }

        function resetValidationState() {
            underline.classList.remove('temp-email-input__underline', 'temp-email-input__underline-red');
            underline.classList.add('temp-email-input__underline-yellow');
            checkIcon.style.display = 'none';
            crossIcon.style.display = 'none';
            text.innerText = '';
            text.classList.remove('temp-email-danger__text', 'temp-email-success__text');
            button.disabled = true;
        }

        function showSuccess(message) {
            underline.classList.remove('temp-email-input__underline-yellow', 'temp-email-input__underline-red');
            underline.classList.add('temp-email-input__underline');
            text.classList.remove('temp-email-danger__text');
            text.classList.add('temp-email-success__text');
            text.innerText = message;
            checkIcon.style.display = 'block';
            crossIcon.style.display = 'none';
            button.disabled = false;
        }

        function showError(message) {
            underline.classList.remove('temp-email-input__underline', 'temp-email-input__underline-yellow');
            underline.classList.add('temp-email-input__underline-red');
            text.classList.remove('temp-email-success__text');
            text.classList.add('temp-email-danger__text');
            text.innerText = message;
            checkIcon.style.display = 'none';
            crossIcon.style.display = 'block';
            button.disabled = true;
        }

        // Debounce function to limit AJAX calls
        function debounce(func, wait) {
            let timeout;
            const debouncedFunction = function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };

            // Add cancel method to clear pending executions
            debouncedFunction.cancel = function() {
                clearTimeout(timeout);
            };

            return debouncedFunction;
        }

        // AJAX validation function
        function validateEmailAvailability(inputValue) {
            // Check if the input still has the same value (prevent showing results for cleared input)
            if (input.value.trim() !== inputValue) {
                return;
            }

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        v_event_name: inputValue
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Double-check that the input still has the same value
                    if (input.value.trim() !== inputValue) {
                        return;
                    }

                    if (data.flag) {
                        showSuccess('Yay! This email is available');
                    } else {
                        showError(data.msg || 'Sorry! This email is not available');
                    }
                })
                .catch(error => {
                    // Only show error if input still has the same value
                    if (input.value.trim() === inputValue) {
                        console.error('Error:', error);
                        showError('Error checking email availability. Please try again.');
                    }
                });
        }

        // Debounced validation function
        const debouncedValidation = debounce(validateEmailAvailability, 500);

        // Enhanced input validation with real-time feedback
        if (input) {
            input.addEventListener('input', function() {
                const inputValue = input.value.trim();

                // Reset state if empty
                if (inputValue === '') {
                    debouncedValidation.cancel(); // Cancel any pending validation
                    resetValidationState();
                    return;
                }

                // Check minimum length
                if (inputValue.length < 3) {
                    debouncedValidation.cancel(); // Cancel any pending validation
                    showError('Email prefix must be at least 3 characters long');
                    return;
                }

                // Check maximum length
                if (inputValue.length > 50) {
                    debouncedValidation.cancel(); // Cancel any pending validation
                    showError('Email prefix cannot exceed 50 characters');
                    return;
                }

                // Check if email prefix format is valid
                if (!isValidEmailPrefix(inputValue)) {
                    debouncedValidation.cancel(); // Cancel any pending validation
                    showError('Invalid format. Use only letters, numbers, dots, hyphens, and underscores');
                    return;
                }

                // Check if starts or ends with dot, hyphen, or underscore
                if (/^[._-]|[._-]$/.test(inputValue)) {
                    debouncedValidation.cancel(); // Cancel any pending validation
                    showError('Email prefix cannot start or end with dot, hyphen, or underscore');
                    return;
                }

                // Check for consecutive dots
                if (/\.\./.test(inputValue)) {
                    debouncedValidation.cancel(); // Cancel any pending validation
                    showError('Email prefix cannot contain consecutive dots');
                    return;
                }

                // If format is valid, check availability via AJAX
                debouncedValidation(inputValue);
            });

            // Also keep the keyup event for backward compatibility
            input.addEventListener('keyup', function() {
                // This will trigger the input event above, so we don't need to duplicate logic
                input.dispatchEvent(new Event('input'));
                //on keydown or key up change upper text to lower text
                input.value = input.value.toLowerCase();
            });
        }

    });
</script>

<script>
    $(document).on('click', '#pobox51-create-email-btn', function() {
        if ($(".v_event_name:visible").val() != "") {
            var event_name = $(".v_event_name").val();

            $("#event_email_with_postfix").val(event_name + $("#event_email_postfix").val());

            if (validate_email_prefix(event_name)) {
                url = "{{ route(ALIAS_USER.'check-event-name') }}";
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        'v_event_name': $(".v_event_name").val()
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.flag) {
                            localStorage.setItem('event_name', event_name);
                            var now = new Date();
                            localStorage.setItem('event_last_create_datetime', now);
                            if (response.is_user_logged_in) {
                                let email_pobox51 = event_name + '@' + $("#event_email_postfix")
                                    .val();
                                $("#poboxtemp-address").text(email_pobox51)
                                $("#timer-email").text(email_pobox51)
                                $("#event_email_with_postfix").html(email_pobox51);
                                showHideSection('step-4-pobox51')
                            } else {
                                showHideSection('step-3-pobox51')

                            }
                        } else {
                            if (response.msg != "") {
                                $(".create_event_error_msg").text(response.msg).show();
                            }
                            $(".v_event_name:visible").val('');
                        }
                    },
                    error: function() {
                        $(".create_event_error_msg").text(MSG_SOMETHING_WENT_WRONG_AT_SERVER)
                    .show();
                    }
                });
                return false;
            } else {
                $(".create_event_error_msg").text(MSG_FOR_FILL_VALID_EMAIL_PREFIX_BEFORE_START_EVENT).show();
                return false;
            }
        }
    })
</script>
