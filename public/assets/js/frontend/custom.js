//DISPLAY BEST USER EXPERIENCE FOR MOBILE DEVICE CODE START

// Function to detect mobile devices
function is_mobile_device_check() {
    return /Mobi|Android/i.test(navigator.userAgent);
}

if (is_mobile_device_check()) {
    ToastHelper.success(MSG_FOR_MOBILE_DEVICE_USER_EXPERIENCE, 'User Experience');
}
//DISPLAY BEST USER EXPERIENCE FOR MOBILE DEVICE CODE END


//GET USER LOCATION CODE START
request_location();
function request_location() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(show_location_position, show_location_error);
    } else {
        ToastHelper.warning(MSG_GEOLOCATION_NOT_SUPPORT_BY_BROWSER, 'Warning');
    }
}

function show_location_position(position) {
    // $("#latitude").val(position.coords.latitude);
    // $("#longitude").val(position.coords.longitude);
    localStorage.setItem('latitude', position.coords.latitude);
    localStorage.setItem('longitude', position.coords.longitude);
}

function show_location_error(error) {

    localStorage.setItem('latitude', '');
    localStorage.setItem('longitude', '');

    ToastHelper.warning(MSG_GEOLOCATION_DENIED_BY_USER_TO_CREATE_EVENT, 'Warning');
}


//GET USER LOCATION CODE END


// //TIMER CODE START

var total_time_seconds = current_seconds = parseInt($("#event_initial_timer_in_seconds").val());
var interval;

// var cancel_event_seconds = parseInt($("#event_timer_start_cancel_event_allow_time_in_seconds").val());
// var cancel_event_interval;

// if ($(".progress-ring__circle").length) {
//     var circle = document.querySelector('.progress-ring__circle');
//     var radius = circle.r.baseVal.value;
//     var circumference = 2 * Math.PI * radius;
//     circle.style.strokeDasharray = `${circumference} ${circumference}`;
//     circle.style.strokeDashoffset = circumference;
// }

var progressFill = document.querySelector('.pobox-active-timer__container');


function start_countdown() {
    function tick() {
        update_countdown();
        interval = setTimeout(tick, 1000);
    }
    tick();
}

function set_progress(percent) {
    if (progressFill) {
        progressFill.style.setProperty('--progress-percent', percent + '%');
    }
}

function update_countdown() {
    var minutes = Math.floor(current_seconds / 60);
    var seconds = current_seconds % 60;

    // Add leading zeros if necessary
    var formatted_minutes = (minutes < 10 ? '0' : '') + minutes;
    var formatted_seconds = (seconds < 10 ? '0' : '') + seconds;
    console.log(seconds);

    // Update the displayed minutes and seconds
    $(".tk_counter.minutes").text(formatted_minutes);
    $(".tk_counter.seconds").text(formatted_seconds);

    current_seconds--; // Decrease time remaining by 1 second
    // console.log(current_seconds);

    if (current_seconds < 0) {
        clearInterval(interval); // Stop the countdown when it reaches 0

        url = $("#event_share_email_url").val();
        $.ajax(
            {
                type: 'post',
                url: url,
                data: { 'i_user_event_id': $("#user_event_id").val() },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.flag) {
                        // $('.socialLoginBlock').css('display', 'none');
                        // $('.createEventIdBlock').css('display', 'none');
                        // $('.contactReceivedBlock').css('display', 'block');
                        // $('.contactSharingBlock').css('display', 'none');

                        showHideSection('step-7-pobox51')

                        //START CODE FOR STOP CONTACT RECEIVED SCRIPT CHECKING
                        //clearInterval(show_user_event_email_receive_interval);
                        //END CODE FOR STOP CONTACT RECEIVED SCRIPT CHECKING


                        //START CHECKING EVENT USER EMAIL DATA DELETE

                        check_user_data_deleted_interval = setInterval(check_user_data_deleted, 2000);

                        /*setTimeout(function(){
                            check_user_data_deleted();
                        },2000);*/

                        //END CHECKING EVENT USER EMAIL DATA DELETE



                    }
                    else {
                        ToastHelper.error(response.msg, 'Error');
                    }
                },
                error: function () {
                    ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
                }
            });



    } else {
        const percent = (current_seconds / total_time_seconds) * 100;
        set_progress(percent);
    }
}

// function start_cancel_btn_countdown() {
//     cancel_event_interval = setInterval(update_cancel_btn_countdown, 1000); // Run update_countdown every second
// }

// function update_cancel_btn_countdown() {
//     var minutes = Math.floor(cancel_event_seconds / 60);
//     var seconds = cancel_event_seconds % 60;

//     // Add leading zeros if necessary
//     var formatted_minutes = (minutes < 10 ? '0' : '') + minutes;
//     var formatted_seconds = (seconds < 10 ? '0' : '') + seconds;

//     cancel_event_seconds--; // Decrease time remaining by 1 second

//     if (cancel_event_seconds <= 0) {
//         clearInterval(cancel_event_interval); // Stop the countdown when it reaches 0

//         $(".cancel_event_btn").fadeOut(4000);
//     }
// }

//TIMER CODE END


function create_and_check_event_state() {
    // if (parseInt($(".socialLoginBlock").length) == 0) {

    // Retrieve the event name from localStorage
    var event_name = localStorage.getItem('event_name');
    var event_last_create_datetime = localStorage.getItem('event_last_create_datetime');
    if (event_last_create_datetime != "" && event_name != "") {
        // Define two dates
        var date1 = new Date(event_last_create_datetime);
        var date2 = new Date();

        // Calculate the difference in milliseconds
        var difference_in_millis = date2 - date1;

        // Convert milliseconds to minutes
        var milliseconds_in_minute = 1000 * 60;
        var difference_in_minutes = Math.floor(difference_in_millis / milliseconds_in_minute);
        if (parseInt(difference_in_minutes) > 5) {
            localStorage.setItem('event_name', '');
            localStorage.setItem('event_last_create_datetime', '');
        }
    }

    // Retrieve the event name from localStorage
    var event_name = localStorage.getItem('event_name');
    var event_last_create_datetime = localStorage.getItem('event_last_create_datetime');
    var latitude = localStorage.getItem('latitude');
    var longitude = localStorage.getItem('longitude');

    // console.log(event_name);

    if (event_name != "") {
        // console.log("Even name");

        $(".v_event_name").val(event_name).focus().trigger('keyup');
        let min = $("#timer-option").val();
        $('.create_event_btn').removeClass('create-email-disable-btn').addClass('create-email-active-btn');
        // Send the event name via AJAX
        if (localStorage.getItem('is_activate') == '1') {
            $.ajax({
                url: $("#create_event_url").val(), // Replace with your route
                type: 'POST',
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    v_event_name: event_name,
                    v_latitude: latitude,
                    v_longitude: longitude,
                    i_event_contact_share_total_time_in_seconds: min * 60
                },
                success: function (response) {
                    // console.log("Create and check event");
                    // console.log(response);

                    if (response.flag || response.data != '') {
                        if (response.data.e_is_event_completed == "No" && parseInt(response.data.i_event_contact_share_remaning_time_in_seconds) > 0) {
                            // console.log("Enter ");

                            showHideSection('step-5-pobox51')
                            ToastHelper.success('You can now copy the email and send it.', 'Event Started');

                            $(".event_email_with_postfix").html(event_name + '@' + $("#event_email_postfix").val());

                            $("#user_event_id").val(response.data.id);

                            $("#qr_code_image_input").val('/storage/' + response.data.qr_code_path);

                            $("#event_initial_timer_in_seconds").val(response.data.i_event_contact_share_remaning_time_in_seconds);

                            $("#created_date_time_event").val(response.data.created_at)

                            clearInterval(interval);

                            total_time_seconds = response.data.i_event_contact_share_total_time_in_seconds;
                            current_seconds = parseInt($("#event_initial_timer_in_seconds").val());
                            start_countdown();


                            //cancel_event_seconds = parseInt($("#event_timer_start_cancel_event_allow_time_in_seconds").val());
                            //cancel_event_interval;

                            //start_cancel_btn_countdown();

                            //SET PROGRESS BAR
                            // var percent = (current_seconds / total_time_seconds) * 100;
                            // set_progress(percent);

                            //START FETCHING EMAIL RECEIVED COUNT
                            show_user_event_email_receive_interval = setInterval(show_user_event_email_receive, 2000);
                            //END FETCHING EMAIL RECEIVED COUNT
                            interval;
                            //START CODE FOR STOP CONTACT RECEIVED SCRIPT CHECKING
                            //clearInterval(show_user_event_email_receive_interval);
                            //END CODE FOR STOP CONTACT RECEIVED SCRIPT CHECKING

                            //START CHECKING EVENT USER EMAIL DATA DELETE
                            check_user_data_deleted_interval = setInterval(check_user_data_deleted, 2000);
                            //END CHECKING EVENT USER EMAIL DATA DELETE
                        }
                        else if (response.data.e_is_event_completed == "Yes" && response.data.e_is_remove_data == "No") {
                            $("#event_initial_timer_in_seconds").val(0);

                            if (response.msg != "") {
                                ToastHelper.error(response.msg, 'Error');
                            }

                            $("#user_event_id").val(response.data.id);

                            //START FETCHING EMAIL RECEIVED COUNT
                            show_user_event_email_receive_interval = setInterval(show_user_event_email_receive, 2000);
                            //END FETCHING EMAIL RECEIVED COUNT

                            //START CHECKING EVENT USER EMAIL DATA DELETE
                            check_user_data_deleted_interval = setInterval(check_user_data_deleted, 2000);
                            //END CHECKING EVENT USER EMAIL DATA DELETE

                            $("#total_count_received").text(response.data.i_total_participant);

                            // $('.socialLoginBlock').css('display', 'none');
                            // $('.createEventIdBlock').css('display', 'none');
                            // $('.contactSharingBlock').css('display', 'none');
                            // $('.contactReceivedBlock').css('display', 'block');

                            showHideSection('step-6-pobox51')
                        }
                        else {
                            clearInterval(show_user_event_email_receive_interval);
                            //clearInterval(cancel_event_interval);
                            clearInterval(check_user_data_deleted_interval);
                            clearInterval(interval);


                            $("#v_event_name").val('');
                            // $('.socialLoginBlock').css('display', 'none');
                            // $('.createEventIdBlock').css('display', 'block');
                            // $('.contactSharingBlock').css('display', 'none');
                            // $('.contactReceivedBlock').css('display', 'none');

                            showHideSection('step-2-pobox51')
                        }
                    }
                    else {
                        ToastHelper.error(response.msg, 'Error');
                    }
                },
                error: function (xhr) {
                    //EMPTY EVENT NAME AND CREATE DATETIME
                    localStorage.setItem('event_name', '');
                    localStorage.setItem('event_last_create_datetime', '');

                    // ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
                }
            });
        } else {

        }
    } else {
        checkStatus();
    }
    //}
}

$(document).ready(function () {
    create_and_check_event_state();
    let event_name = localStorage.getItem('event_name');

    url = $("#check_running_event_url").val();
    $.ajax(
        {
            type: 'get',
            url: url,
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status == true) {
                    $(".summary-cta button").attr('disabled', true);
                    $("#user_event_id").val(response.user_event_id);
                    if (response.data.e_status == "Completed") {
                        showHideSection("step-6-pobox51");
                        startCountdown();
                    } else {
                        showHideSection("step-5-pobox51");
                    }

                    total_time_seconds = response.data.i_event_contact_share_total_time_in_seconds;
                    current_seconds = parseInt($("#event_initial_timer_in_seconds").val());
                    start_countdown();
                    show_user_event_email_receive_interval = setInterval(show_user_event_email_receive, 2000);

                    interval;

                    check_user_data_deleted_interval = setInterval(check_user_data_deleted, 2000);
                } else {
                    if (response.status || (localStorage.getItem('event_name') != '' && response.user_logged_in)) {
                        showHideSection('step-4-pobox51')
                    } else {
                        if (response.user_logged_in && localStorage.getItem('event_name') != '') {
                            showHideSection('step-4-pobox51')
                        } else {
                            showHideSection('step-1-pobox51')
                        }
                    }
                    // $("#pobox51-email-prefix").val(event_name);
                    $(".event_email_with_postfix").html(event_name + '@' + $("#event_email_postfix").val());
                    // Handle browser back button to prevent OAuth state issues
                    window.addEventListener('popstate', function (event) {
                        // Check if we're in an OAuth flow and handle appropriately
                        if (window.location.href.includes('auth/google') ||
                            window.location.href.includes('auth/facebook') ||
                            window.location.href.includes('auth/linkedin') ||
                            window.location.href.includes('auth/twitter') ||
                            window.location.href.includes('auth/instagram')) {
                            // Redirect to home page to avoid OAuth state issues
                            window.location.href = '/';
                        }
                    });
                }
            },
            error: function () {

            }
        });
});

const checkStatus = () => {
    url = $("#check_running_event_url").val();
    $.ajax(
        {
            type: 'get',
            url: url,
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status || (localStorage.getItem('event_name') != '' && response.user_logged_in)) {
                    showHideSection('step-4-pobox51')
                } else {
                    if (response.user_logged_in && localStorage.getItem('event_name') != '') {
                        showHideSection('step-4-pobox51')
                    } else {
                        showHideSection('step-1-pobox51')
                    }
                }
            },
            error: function () {

            }
        });
}

$("#add_time_btn").click(function () {

    url = $("#event_share_email_addon_time_url").val();
    $.ajax(
        {
            type: 'post',
            url: url,
            data: { 'i_user_event_id': $("#user_event_id").val() },
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                ToastHelper.success('2 minutes added successfully.', 'Time Added');
                $("#add_time_btn").blur();
            },
            error: function () {
                ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
            }
        });
    current_seconds = parseInt(current_seconds) + parseInt($("#event_addon_timer_in_seconds").val());
    total_time_seconds = parseInt(total_time_seconds) + parseInt($("#event_addon_timer_in_seconds").val());


    //SET PROGRESS BAR
    // console.log('total_time_seconds:::' + total_time_seconds);
    // console.log('current_seconds:::' + current_seconds);

    var percent = (current_seconds / total_time_seconds) * 100;
    set_progress(percent);

    return false;
});




//TIMER CODE END

// Animation JS
$(function () {

    function ckScrollInit(items, trigger) {
        items.each(function () {
            var ckElement = $(this),
                AnimationClass = ckElement.attr('data-animation'),
                AnimationDelay = ckElement.attr('data-animation-delay');

            ckElement.css({
                '-webkit-animation-delay': AnimationDelay,
                '-moz-animation-delay': AnimationDelay,
                'animation-delay': AnimationDelay,
                opacity: 0
            });

            var ckTrigger = (trigger) ? trigger : ckElement;

            ckTrigger.waypoint(function () {
                ckElement.addClass("animated").css("opacity", "1");
                ckElement.addClass('animated').addClass(AnimationClass);
            }, {
                triggerOnce: true,
                offset: '90%'
            });
        });
    }

    ckScrollInit($('.animation'));
    ckScrollInit($('.staggered-animation'), $('.staggered-animation-wrap'));

});

// Header On Scroll Fixed
(function ($) {
    //on scroll header fixed
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 80) {
            $('header').addClass('nav-fixed');
        } else {
            $('header').removeClass('nav-fixed');
        }
    });
})(jQuery);



// Select all links with hashes
$('a.page-scroll').on('click', function (event) {
    // On-page links
    if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
        // Figure out element to scroll to
        var target = $(this.hash),
            speed = $(this).data("speed") || 800;
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

        // Does a scroll target exist?
        if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 60
            }, speed);
        }
    }
});



function validate_email_prefix(email) {
    const email_regex = /^[A-Za-z0-9]+([._][A-Za-z0-9]+)*$/;
    //const email_regex = /^[^\s@.]+$/;
    return email_regex.test(email);
}


$("#v_event_name").keydown(function (e) {
    if (e.keyCode == 32 || e.keyCode == 50 || e.keyCode == 57 || e.keyCode == 58) {
        return false; // return false to prevent space from being added
    }
});


$("#v_event_name").bind('keyup', function (e) {
    if (e.which >= 97 && e.which <= 122) {
        var newKey = e.which - 32;
        // I have tried setting those
        e.keyCode = newKey;
        e.charCode = newKey;
    }

    if ($("#v_event_name").val() != "") {
        $('.create_event_btn').removeClass('create-email-disable-btn').addClass('create-email-active-btn');
    }
    else {
        $('.create_event_btn').removeClass('create-email-active-btn').addClass('create-email-disable-btn');
    }

    $("#v_event_name").val(($("#v_event_name").val()).toLowerCase());
});


$('.socialLoginBlock').css('display', 'none');
$('.createEventIdBlock').css('display', 'block');
$('.contactReceivedBlock').css('display', 'none');
$('.contactSharingBlock').css('display', 'none');


if ($(".create_event_btn").length) {
    $(".create_event_btn").click(function () {
        localStorage.setItem('is_activate', 1);
        localStorage.setItem('event_name', '');
        localStorage.setItem('event_last_create_datetime', '');

        $(".create_event_error_msg").text('');

        if ($(".v_event_name:visible").val() != "") {
            var event_name = $(".v_event_name").val();

            if (validate_email_prefix(event_name)) {
                url = $(this).attr('createevent_url');
                $.ajax(
                    {
                        type: 'post',
                        url: url,
                        data: { 'v_event_name': $(".v_event_name").val() },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.flag) {
                                localStorage.setItem('event_name', event_name);
                                var now = new Date();
                                localStorage.setItem('event_last_create_datetime', now);
                                if (response.is_user_logged_in) {
                                    let email_pobox51 = event_name + '@' + $("#event_email_postfix").val();
                                    $("#poboxtemp-address").text(email_pobox51)
                                    $("#timer-email").text(email_pobox51)
                                    $("#event_email_with_postfix").html(email_pobox51);
                                    // showHideSection('step-4-pobox51')
                                    create_and_check_event_state();
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
                        error: function () {
                            $(".create_event_error_msg").text(MSG_SOMETHING_WENT_WRONG_AT_SERVER).show();
                        }
                    });
                return false;
            }
            else {

                $(".create_event_error_msg").text(MSG_FOR_FILL_VALID_EMAIL_PREFIX_BEFORE_START_EVENT).show();
                return false;
            }
        }
        else {
            $(".create_event_error_msg").text(MSG_FOR_FILL_EMAIL_BEFORE_START_EVENT).show();
            // ToastHelper.error(MSG_FOR_FILL_EMAIL_BEFORE_START_EVENT, 'Error');
            return false;
        }
    })
}





$(document).ready(function () {
    $("#slider1").slideToUnlock();
})


function cancel_event() {
    if ($(".v_event_name:visible").val() != "") {
        var event_name = $(".v_event_name").val();
        if (validate_email_prefix(event_name)) {
            url = $(".cancel_event_btn").attr('cancelevent_url');
            $.ajax(
                {
                    type: 'post',
                    url: url,
                    data: { 'v_event_name': $(".v_event_name").val() },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.flag) {
                            ToastHelper.success(response.msg, 'Completed Event');

                            //IF DELETE EVENT THEN CODE BELOW START
                            //localStorage.setItem('event_name', '');
                            //localStorage.setItem('event_last_create_datetime', '');
                            //location.reload();
                            //IF DELETE EVENT THEN CODE BELOW END

                            //IF STOP EVENT THEN CODE BELOW START
                            create_and_check_event_state();
                            //IF STOP EVENT THEN CODE BELOW END
                        }
                        else {
                            $(".v_event_name:visible").val('');
                            ToastHelper.error(response.msg, 'Error');
                        }
                    },
                    error: function () {
                        ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
                    }
                });
            return false;
        }
        else {
            ToastHelper.error(MSG_FOR_FILL_VALID_EMAIL_PREFIX_BEFORE_START_EVENT, 'Error');
            return false;
        }
    }
    else {
        ToastHelper.error(MSG_FOR_FILL_EMAIL_BEFORE_START_EVENT, 'Error');
        return false;
    }
}

if ($(".cancel_event_btn").length) {
    $(function () {
        $('.cancel_event_btn')
            .bind('mousedown', function () {
                if ($(this).attr('disabled')) return !1;
                return $.data(this, 'sliding', 1), !1;
            })
            .bind('mouseup mouseleave', function (e) {
                e.preventDefault();
                if ($.data(this, 'sliding')) {
                    $.data(this, 'sliding', 0);

                    var pct = (parseInt($(this).find('> confirm').css('right')) / $(this).outerWidth() * 100);

                    if (pct <= 25) {
                        $(this).find('> confirm').animate({ right: '4px' }, 500, 'easeOutSine', function () {
                            $(this).closest('button').trigger('change').attr('disabled', !0);
                        });
                    }
                    else {
                        //CALL FUNCTION OF CANCEL EVENT HERE
                        cancel_event();
                        $(this).find('> confirm').animate({ right: '100%' }, 500, 'easeOutBounce');
                    }
                }

                return false;
            })
            .bind('mousemove', function (e) {
                var sliding = $.data(this, 'sliding') ? !0 : !1,
                    pos;
                if (sliding) {
                    pos = (e.pageX - $(this).offset().left) / $(this).outerWidth() * 100;
                    $(this).find('> confirm').css('right', (100 - pos) + '%');
                }
            });
    });
}

function show_user_event_email_receive() {
    url = $("#event_share_email_received_url").val();
    $.ajax(
        {
            type: 'post',
            url: url,
            data: { 'i_user_event_id': $("#user_event_id").val() },
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.flag) {
                    if ($("#total_count_received:visible").length) {
                        $("#total_count_received").text(response.data);
                        if (response.data > 0) {
                            $("#vcf_download_url_a").addClass("download-show");
                        } else {
                            $("#vcf_download_url_a").addClass("download-hide");
                        }
                    }
                    else {
                        if (response.data == 0) {
                            $(".contact_count").text("No responses received yet");
                            $("#vcf_download_url_a").addClass("download-hide");
                        }
                        else {
                            $(".contact_count").text(response.data + " responses received");
                            $("#vcf_download_url_a").addClass("download-show");
                        }
                    }
                }
                else {
                    ToastHelper.error(response.msg, 'Error');
                }
            },
            error: function () {
                ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
            }
        });
    return false;
}


function check_user_data_deleted() {
    url = $("#event_content_check_delete_url").val();
    $.ajax(
        {
            type: 'post',
            url: url,
            data: { 'i_user_event_id': $("#user_event_id").val() },
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.flag) {
                    localStorage.setItem('event_name', '');
                    localStorage.setItem('event_last_create_datetime', '');
                    $("#user_event_id").val('');
                    $("#v_event_name").val('');

                    clearInterval(show_user_event_email_receive_interval);
                    //clearInterval(cancel_event_interval);
                    clearInterval(check_user_data_deleted_interval);
                    clearInterval(interval);
                    ToastHelper.success(response.msg, 'Success');
                    $(".summary-cta button").attr('disabled', false);
                    stopCountDown();
                    // location.reload();
                } else {
                    $(".summary-cta button").attr('disabled', true);
                }
            },
            error: function () {
                ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
            }
        });
    return false;
}

$(document).on('click', '#goto-timer-page', function () {
    $('#step-3-pobox51').css('display', 'none');
    $('#step-2-pobox51').css('display', 'none');
    $('#step-1-pobox51').css('display', 'none');
    $('#step-4-pobox51').css('display', 'block');
});

$(document).on('click', '#goto-activate', function () {
    $('#step-3-pobox51').css('display', 'none');
    $('#step-2-pobox51').css('display', 'none');
    $('#step-1-pobox51').css('display', 'none');
    $('#step-4-pobox51').css('display', 'none');
    $("#step-5-pobox51").css('display', 'block');
});

const showHideSection = (sectionId) => {
    let startTime = "";
    let endTime = "";
    const sections = ['step-1-pobox51', 'step-2-pobox51', 'step-3-pobox51', 'step-4-pobox51', 'step-5-pobox51', 'step-6-pobox51', 'step-7-pobox51', 'step-8-pobox51'];
    sections.forEach(id => {
        if (id === sectionId) {

            $(`#${id}`).css('display', 'block');
            if (sectionId == 'step-6-pobox51' || sectionId == 'step-7-pobox51') {
                localStorage.setItem('is_activate', '0');

                //call ajax for get event strat time and end time

                var eventId = $("#user_event_id").val();
                var baseUrl = $("#event_get_event_time_url").val();
                var fullUrl = baseUrl.replace('PLACEHOLDER_ID', eventId);

                $.ajax({
                    type: 'get',
                    url: fullUrl,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        // console.log(response);
                        if (response.flag) {
                            startTime = response.data.created_at
                            endTime = response.data.d_event_sharing_completed_datetime
                            let diff = getTimeDiffDMS(startTime, endTime);
                            $("#time_taken_div").text(diff)
                        } else {
                            ToastHelper.error(response.msg, 'Error');
                        }
                    },
                    error: function () {
                        ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
                    }
                });


                // let startTime = $("#created_date_time_event").val();
                // let endTime = $("#completed_date_time_event").val();
                // console.log("showHideSection Start : "+startTime);
                // console.log("showHideSection End : "+endTime);



                // $("#vcf_download_url_a").attr('href', $("#vcf_download_url").val().replace('REPLACE_ID', $("#user_event_id").val()))

            }

            if (sectionId == 'step-5-pobox51') {
                // window.reinitializeSlider();
            }
            if (sectionId == 'step-2-pobox51') {
                setTimeout(() => {
                    const $input = $("#pobox51-email-prefix");
                    if ($input.length && $input.is(':visible') && !$input.is(':disabled')) {
                        $input.focus();
                    }
                }, 100);
            }
        } else {
            $(`#${id}`).css('display', 'none');
        }
    });
}

const copyButton = document.querySelector('.pobox-active-email__copy-btn');

if (copyButton) {
    copyButton.addEventListener('click', function () {
        // console.log("Enter");

        const emailText = document.querySelector('#pobox-active-email')?.textContent.trim();

        if (!emailText) {
            alert("No email address found.");
            return;
        }

        navigator.clipboard.writeText(emailText).then(function () {
            const tooltip = document.getElementById('copy-tooltip-2');
            const originalContent = copyButton.innerHTML;
            const originalContentText = originalContent;
            copyButton.innerHTML = '✓';
            setTimeout(function () {
                copyButton.innerHTML = originalContent;
            }, 2000);
            tooltip.style.display = 'block';
            setTimeout(() => {
                tooltip.style.display = 'none';
                copyButton.innerHTML = originalContentText;
                copyButton.blur();
            }, 1500);
        }).catch(function (err) {
            console.error("Clipboard copy failed:", err);
            ToastHelper.error('Failed! Please copy manually.', 'Error');
        });
    });
}

const shareButton = document.querySelector('.pobox-active-email__share-btn');
if (shareButton) {
    shareButton.addEventListener('click', function () {
        showHideSection('step-8-pobox51');
        // console.log($("#qr_code_image_input").val());

        $("#qr-code-image").attr('src', $("#qr_code_image_input").val())
    });
}

const qrCodeModalClose = document.querySelector('.qr-code-modal__close');
if (qrCodeModalClose) {
    qrCodeModalClose.addEventListener('click', function () {
        showHideSection('step-5-pobox51');
    });
}

document.getElementById('download-btn').addEventListener('click', function () {
    const svgUrl = document.getElementById('qr_code_image_input').value;

    const svgFileName = svgUrl.split('/').pop();
    const baseName = svgFileName.replace('.svg', '');
    const downloadName = baseName + '.png';

    fetch(svgUrl)
        .then(response => response.text())
        .then(svgText => {
            const svg = new Blob([svgText], { type: 'image/svg+xml;charset=utf-8' });
            const url = URL.createObjectURL(svg);

            const img = new Image();
            img.onload = function () {
                const canvas = document.createElement('canvas');
                canvas.width = img.width;
                canvas.height = img.height;

                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0);

                const pngData = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.download = downloadName;
                link.href = pngData;
                link.click();

                URL.revokeObjectURL(url);
            };
            img.src = url;
        });
});


function getTimeDiffDMS(start, end) {
    const startDate = new Date(start); // keep Z — it's UTC
    const endDate = new Date(end); // add 'Z' to force UTC parsing
    let diffMs = endDate - startDate;

    if (diffMs < 0) return 'Invalid time range';

    let totalSeconds = Math.floor(diffMs / 1000);

    const days = Math.floor(totalSeconds / 86400);
    totalSeconds %= 86400;

    const hours = Math.floor(totalSeconds / 3600);
    totalSeconds %= 3600;

    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;

    if (isNaN(minutes) || isNaN(seconds)) {
        return '0m 0s';
    }

    // return `${days}d ${hours}h ${minutes}m ${seconds}s`;
    return `${minutes}m ${seconds}s`;
}

$(document).on('click', ".create_new_pobox_button", function () {
    // localStorage.setItem('event_name', "")
    // localStorage.setItem('event_last_create_datetime', "")
    // localStorage.setItem('event_seconds', "120")
    // showHideSection('step-2-pobox51')]

});

$(document).on('click', "#vcf_download_url_a", function () {
    var eventId = $("#user_event_id").val(); // You may need to adjust this based on your data source

    // Use native XMLHttpRequest to avoid jQuery's responseText access issue
    var xhr = new XMLHttpRequest();
    xhr.open('GET', window.location.origin + '/user/event/' + eventId + '/download-vcf', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.responseType = 'blob';

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Create a blob URL and trigger download
            var blob = xhr.response;
            var url = window.URL.createObjectURL(blob);

            // Get filename from response headers or use default
            var filename = 'contacts.vcf';
            var contentDisposition = xhr.getResponseHeader('Content-Disposition');
            if (contentDisposition) {
                var matches = contentDisposition.match(/filename="([^"]*)"/) || contentDisposition.match(/filename=([^;]*)/);
                if (matches && matches[1]) {
                    filename = matches[1];
                }
            }

            // Create temporary link and trigger download
            var a = document.createElement('a');
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);

            ToastHelper.success('File downloaded successfully!', 'Success');
        } else {
            // Handle error
            var errorMessage = 'Error downloading file. Please try again.';

            // Handle specific HTTP status errors
            if (xhr.status === 404) {
                errorMessage = 'File not found or event does not have any data.';
            } else if (xhr.status === 500) {
                errorMessage = 'Server error. Please try again later.';
            } else if (xhr.status === 403) {
                errorMessage = 'Access denied. Please check your permissions.';
            }

            ToastHelper.error(errorMessage, 'Error');
        }
    };

    xhr.onerror = function () {
        ToastHelper.error('Network error. Please check your connection and try again.', 'Error');
    };

    xhr.send();
});

$(".summary-cta button").click(function () {
    if ($(this).hasClass('create_new_pobox_button')) {
        localStorage.setItem('event_name', "");
        localStorage.setItem('event_last_create_datetime', "");
        localStorage.setItem('event_seconds', "120");
        showHideSection('step-2-pobox51');
    }
});

$("#go_to_summary").click(function () {
    showHideSection('step-6-pobox51');
    $(".summary-cta button").attr('disabled', true);
});
class SlideToComplete {
    constructor() {
        this.container = document.getElementById('slideContainer');
        this.button = document.getElementById('slideButton');
        this.track = document.getElementById('slideTrack');
        this.text = document.getElementById('slideText');
        // this.successMessage = document.getElementById('successMessage');
        // this.resetBtn = document.getElementById('resetBtn');

        this.isDragging = false;
        this.startX = 0;
        this.currentX = 0;
        this.maxDistance = 0;
        this.completed = false;
        this.ajaxInProgress = false; // Prevent duplicate AJAX calls

        this.init();
    }

    init() {
        this.maxDistance = this.container.offsetWidth - this.button.offsetWidth - 10;
        this.setupEventListeners();

        // Recalculate on window resize
        window.addEventListener('resize', () => {
            this.maxDistance = this.container.offsetWidth - this.button.offsetWidth - 10;
        });
    }

    setupEventListeners() {
        // Remove existing listeners first to prevent duplicates
        this.removeEventListeners();

        // Mouse events
        this.button.addEventListener('mousedown', this.handleStart.bind(this));
        document.addEventListener('mousemove', this.handleMove.bind(this));
        document.addEventListener('mouseup', this.handleEnd.bind(this));

        // Touch events
        this.button.addEventListener('touchstart', this.handleStart.bind(this));
        document.addEventListener('touchmove', this.handleMove.bind(this));
        document.addEventListener('touchend', this.handleEnd.bind(this));

        // Prevent default drag behavior
        this.button.addEventListener('dragstart', e => e.preventDefault());
    }

    removeEventListeners() {
        // Clean up existing event listeners
        if (this.handleStart) {
            this.button.removeEventListener('mousedown', this.handleStart);
            this.button.removeEventListener('touchstart', this.handleStart);
        }
        if (this.handleMove) {
            document.removeEventListener('mousemove', this.handleMove);
            document.removeEventListener('touchmove', this.handleMove);
        }
        if (this.handleEnd) {
            document.removeEventListener('mouseup', this.handleEnd);
            document.removeEventListener('touchend', this.handleEnd);
        }
    }

    handleStart(e) {
        if (this.completed) return;

        this.isDragging = true;
        this.startX = e.type === 'mousedown' ? e.clientX : e.touches[0].clientX;
        this.button.style.transition = 'none';
        this.track.style.transition = 'none';
    }

    handleMove(e) {
        if (!this.isDragging || this.completed) return;

        e.preventDefault();
        const clientX = e.type === 'mousemove' ? e.clientX : e.touches[0].clientX;
        const deltaX = clientX - this.startX;

        this.currentX = Math.max(0, Math.min(deltaX, this.maxDistance));

        this.updatePosition();
        this.updateProgress();
    }

    handleEnd() {
        if (!this.isDragging || this.completed) return;

        this.isDragging = false;
        this.button.style.transition = 'all 0.3s ease';
        this.track.style.transition = 'width 0.3s ease';

        // Check if slide is complete (90% of the way)
        if (this.currentX >= this.maxDistance * 0.9) {
            this.complete();
        } else {
            this.snapBack();
        }
    }

    updatePosition() {
        this.button.style.transform = `translateX(${this.currentX}px)`;
    }

    updateProgress() {
        const progress = (this.currentX / this.maxDistance) * 100;
        this.track.style.width = `${progress}%`;

        // Update text opacity based on progress
        // const textOpacity = Math.max(0, 1 - (progress / 50));
        // this.text.style.opacity = textOpacity;
    }

    complete() {
        if (this.completed || this.ajaxInProgress) return; // Prevent duplicate calls

        this.completed = true;
        this.ajaxInProgress = true;
        this.currentX = this.maxDistance;

        // Final position and styling
        this.button.style.transform = `translateX(${this.maxDistance}px)`;
        this.track.style.width = '100%';

        // Add completed classes
        this.container.classList.add('completed');
        this.button.classList.add('completed');

        // Update text
        this.text.textContent = 'Completed!';
        this.text.style.opacity = '1';

        // Show success message and reset button
        setTimeout(() => {
            // Check if jQuery and required elements exist
            if (typeof $ !== 'undefined' && $("#completed-event-value").length && $(".v_event_name").length) {
                $.ajax({
                    type: 'post',
                    url: $("#completed-event-value").val(),
                    data: {
                        'v_event_name': $(".v_event_name").val()
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (response) => {
                        this.ajaxInProgress = false;
                        if (response.flag) {
                            $("#completed_date_time_event").val(response.data.d_event_sharing_completed_datetime);
                            if (typeof ToastHelper !== 'undefined') {
                                ToastHelper.success(response.msg, 'Completed Event');
                            }
                            localStorage.setItem('is_activate', 0);
                            if (typeof stopPOBox === 'function') {
                                stopPOBox();
                            }

                            // Reset slider after successful completion
                            setTimeout(() => {
                                this.reset();
                            }, 2000); // Wait 2 seconds to show completion, then reset

                            startCountdown()
                        } else {
                            $(".v_event_name:visible").val('');
                            if (typeof ToastHelper !== 'undefined') {
                                ToastHelper.error(response.msg, 'Error');
                            }

                            // Reset slider on error as well
                            setTimeout(() => {
                                this.reset();
                            }, 1000);
                        }
                    },
                    error: () => {
                        this.ajaxInProgress = false;
                        if (typeof ToastHelper !== 'undefined' && typeof MSG_SOMETHING_WENT_WRONG_AT_SERVER !== 'undefined') {
                            ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
                        }
                        setTimeout(() => {
                            this.reset();
                        }, 1000);
                    }
                });
            } else {
                this.ajaxInProgress = false;
                // Fallback for demo purposes
                // this.successMessage.classList.add('show');
                // this.resetBtn.classList.add('show');
            }
        }, 300);

        // Add completion animation
        this.button.style.animation = 'pulse 0.6s ease-in-out';
    }

    snapBack() {
        this.currentX = 0;
        this.button.style.transform = 'translateX(0px)';
        this.track.style.width = '0%';
        this.text.style.opacity = '1';
    }

    reset() {
        this.completed = false;
        this.ajaxInProgress = false;
        this.currentX = 0;

        // Reset positioning
        this.button.style.transform = 'translateX(0px)';
        this.button.style.animation = 'none';
        this.track.style.width = '0%';

        // Reset classes
        this.container.classList.remove('completed');
        this.button.classList.remove('completed');

        // Reset text
        this.text.textContent = 'Slide to complete';
        this.text.style.opacity = '1';

        // Hide success elements
        // this.successMessage.classList.remove('show');
        // this.resetBtn.classList.remove('show');
    }

    destroy() {
        this.removeEventListeners();
        this.ajaxInProgress = false;
    }
}

function stopPOBox() {
    if (typeof interval !== 'undefined') {
        clearInterval(interval);
    }
    if (typeof showHideSection === 'function') {
        showHideSection('step-6-pobox51');
    }
    // In a real implementation, this would stop the session and send contacts
}

// Initialize slider when section becomes visible
function initializeSliderWhenVisible() {
    const slideContainer = document.getElementById('slideContainer');

    if (!slideContainer) {
        // If container doesn't exist yet, wait and try again
        setTimeout(initializeSliderWhenVisible, 100);
        return;
    }

    // Check if slider is already initialized
    if (window.sliderInstance) {
        return;
    }

    // Use Intersection Observer to detect when slider becomes visible
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && entry.target === slideContainer) {
                // Initialize slider when it becomes visible
                window.sliderInstance = new SlideToComplete();
                // Stop observing after initialization
                observer.unobserve(slideContainer);
            }
        });
    }, {
        threshold: 0.1 // Trigger when 10% of the element is visible
    });

    observer.observe(slideContainer);
}

// Start observing when DOM is ready
document.addEventListener('DOMContentLoaded', initializeSliderWhenVisible);

// Public method to manually initialize slider (for dynamic content)
window.initializeSlider = function () {
    if (!window.sliderInstance && document.getElementById('slideContainer')) {
        window.sliderInstance = new SlideToComplete();
    }
};

// Public method to destroy and reinitialize slider
window.reinitializeSlider = function () {
    window.sliderInstance = null;
    initializeSliderWhenVisible();
};

// Add pulse animation
const style = document.createElement('style');
style.textContent = `
            @keyframes pulse {
                0%, 100% { transform: translateX(${document.querySelector('.slide-container')?.offsetWidth - 70 || 0}px) scale(1); }
                50% { transform: translateX(${document.querySelector('.slide-container')?.offsetWidth - 70 || 0}px) scale(1.1); }
            }
        `;
document.head.appendChild(style);

function startCountdown(durationSeconds = 300) {
    // check if we already have an end time stored
    $("#time_take_container").removeClass("d-none");
    let endTime = localStorage.getItem("countdownEndTime");

    if (!endTime) {
        // first load → set new end time
        endTime = Date.now() + durationSeconds * 1000;
        localStorage.setItem("countdownEndTime", endTime);
    }

    function updateTimer() {
        let now = Date.now();
        let remaining = Math.floor((endTime - now) / 1000);

        if (remaining <= 0) {
            document.getElementById("timer-stop-minutes").innerText = "00m";
            document.getElementById("timer-stop-second").innerText = "00s";
            localStorage.removeItem("countdownEndTime");
            return;
        }

        let minutes = Math.floor(remaining / 60);
        let seconds = remaining % 60;

        document.getElementById("timer-stop-minutes").innerText = minutes + "m";
        document.getElementById("timer-stop-second").innerText = (seconds < 10 ? "0" : "") + seconds + "s";

        setTimeout(updateTimer, 1000);
    }
    updateTimer();
}


function stopCountDown()
{
    let endTime = localStorage.getItem("countdownEndTime");
    if(endTime){
        document.getElementById("timer-stop-minutes").innerText = "00m";
        document.getElementById("timer-stop-second").innerText = "00s";
        localStorage.removeItem("countdownEndTime");
    }
    $("#time_take_container").addClass("d-none");
}
