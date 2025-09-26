//DISPLAY BEST USER EXPERIENCE FOR MOBILE DEVICE CODE START

// Function to detect mobile devices
function is_mobile_device_check() {
    return /Mobi|Android/i.test(navigator.userAgent);
}

if(is_mobile_device_check()) {
    ToastHelper.success(MSG_FOR_MOBILE_DEVICE_USER_EXPERIENCE, 'User Experience', {'position': 'bottomRight'});
}
//DISPLAY BEST USER EXPERIENCE FOR MOBILE DEVICE CODE END


//GET USER LOCATION CODE START
request_location();
function request_location() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(show_location_position, show_location_error);
    } else {
        ToastHelper.error(MSG_GEOLOCATION_NOT_SUPPORT_BY_BROWSER, 'Error', {'position': 'bottomRight'});
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

    ToastHelper.error(MSG_GEOLOCATION_DENIED_BY_USER_TO_CREATE_EVENT, 'Error', {'position': 'bottomRight', 'onClosing': function () {
            // location.reload();
        }
    });
}


//GET USER LOCATION CODE END


// //TIMER CODE START

var total_time_seconds =  current_seconds = parseInt($("#event_initial_timer_in_seconds").val());
var interval;

// var cancel_event_seconds = parseInt($("#event_timer_start_cancel_event_allow_time_in_seconds").val());
// var cancel_event_interval;

if($(".progress-ring__circle").length)
{
    var circle = document.querySelector('.progress-ring__circle');
    var radius = circle.r.baseVal.value;
    var circumference = 2 * Math.PI * radius;
    circle.style.strokeDasharray = `${circumference} ${circumference}`;
    circle.style.strokeDashoffset = circumference;
}

function start_countdown() {
    interval = setInterval(update_countdown, 1000); // Run update_countdown every second
}

function set_progress(percent) {
    var offset = circumference - percent / 100 * circumference;
    circle.style.strokeDashoffset = offset;
}

function update_countdown() {
    var minutes = Math.floor(current_seconds / 60);
    var seconds = current_seconds % 60;

    // Add leading zeros if necessary
    var formatted_minutes = (minutes < 10 ? '0' : '') + minutes;
    var formatted_seconds = (seconds < 10 ? '0' : '') + seconds;

    // Update the displayed minutes and seconds
    $(".tk_counter.minutes").text(formatted_minutes);
    $(".tk_counter.seconds").text(formatted_seconds);

    current_seconds--; // Decrease time remaining by 1 second

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
                        $('.socialLoginBlock').css('display', 'none');
                        $('.createEventIdBlock').css('display', 'none');
                        $('.contactReceivedBlock').css('display', 'block');
                        $('.contactSharingBlock').css('display', 'none');

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
                        ToastHelper.error(response.msg, 'Error', {'position': 'bottomRight'});
                    }
                },
                error: function () {
                    ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error', {'position': 'bottomRight'});
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
        var event_name                  = localStorage.getItem('event_name');
        var event_last_create_datetime  = localStorage.getItem('event_last_create_datetime');
        if(event_last_create_datetime != "" && event_name != "")
        {
            // Define two dates
            var date1 = new Date(event_last_create_datetime);
            var date2 = new Date();

            // Calculate the difference in milliseconds
            var difference_in_millis = date2 - date1;

            // Convert milliseconds to minutes
            var milliseconds_in_minute = 1000 * 60;
            var difference_in_minutes = Math.floor(difference_in_millis / milliseconds_in_minute);

            if(parseInt(difference_in_minutes) > 5)
            {
                localStorage.setItem('event_name','');
                localStorage.setItem('event_last_create_datetime','');
            }
        }

        // Retrieve the event name from localStorage
        var event_name                  = localStorage.getItem('event_name');
        var event_last_create_datetime  = localStorage.getItem('event_last_create_datetime');
        var latitude                    = localStorage.getItem('latitude');
        var longitude                   = localStorage.getItem('longitude');

        if (event_name != "") {
            $(".v_event_name").val(event_name);
            $('.create_event_btn').removeClass('create-email-disable-btn').addClass('create-email-active-btn');
            // Send the event name via AJAX
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
                },
                success: function (response) {
                    console.log("Enter");

                    if (response.flag || response.data != '') {
                        if (response.data.e_is_event_completed == "No" && parseInt(response.data.i_event_contact_share_remaning_time_in_seconds) > 0) {
                            // $('.socialLoginBlock').css('display', 'none');
                            // $('.createEventIdBlock').css('display', 'none');
                            // $('.contactSharingBlock').css('display', 'block');
                            // $('.contactReceivedBlock').css('display', 'none');

                            showHideSection('step-4-pobox51')

                            ToastHelper.success(response.flag, 'Event Started', {'position': 'bottomRight'});


                            $("#event_email_with_postfix").html(event_name+'@'+$("#event_email_postfix").val());

                            $("#user_event_id").val(response.data.id);

                            $("#event_initial_timer_in_seconds").val(response.data.i_event_contact_share_remaning_time_in_seconds);

                            clearInterval(interval);

                            total_time_seconds  = response.data.i_event_contact_share_total_time_in_seconds;
                            current_seconds     = parseInt($("#event_initial_timer_in_seconds").val());
                            interval;

                            //cancel_event_seconds = parseInt($("#event_timer_start_cancel_event_allow_time_in_seconds").val());
                            //cancel_event_interval;

                            start_countdown();
                            //start_cancel_btn_countdown();

                            //SET PROGRESS BAR
                            var percent = (current_seconds / total_time_seconds) * 100;
                            set_progress(percent);

                            //START FETCHING EMAIL RECEIVED COUNT
                            show_user_event_email_receive_interval = setInterval(show_user_event_email_receive, 2000);
                            //END FETCHING EMAIL RECEIVED COUNT

                            //START CODE FOR STOP CONTACT RECEIVED SCRIPT CHECKING
                            //clearInterval(show_user_event_email_receive_interval);
                            //END CODE FOR STOP CONTACT RECEIVED SCRIPT CHECKING

                            //START CHECKING EVENT USER EMAIL DATA DELETE
                            check_user_data_deleted_interval = setInterval(check_user_data_deleted, 2000);
                            //END CHECKING EVENT USER EMAIL DATA DELETE
                        }
                        else if (response.data.e_is_event_completed == "Yes" && response.data.e_is_remove_data == "No") {
                            console.log("Enter in else if");

                            $("#event_initial_timer_in_seconds").val(0);

                            ToastHelper.success(response.flag, 'Error', {'position': 'bottomRight'});

                            $("#user_event_id").val(response.data.id);

                            //START FETCHING EMAIL RECEIVED COUNT
                            show_user_event_email_receive_interval = setInterval(show_user_event_email_receive, 2000);
                            //END FETCHING EMAIL RECEIVED COUNT

                            //START CHECKING EVENT USER EMAIL DATA DELETE
                            check_user_data_deleted_interval = setInterval(check_user_data_deleted, 2000);
                            //END CHECKING EVENT USER EMAIL DATA DELETE

                            $("#total_count_received").text(response.data.i_total_participant);

                            $('.socialLoginBlock').css('display', 'none');
                            $('.createEventIdBlock').css('display', 'none');
                            $('.contactSharingBlock').css('display', 'none');
                            $('.contactReceivedBlock').css('display', 'block');
                        }
                        else {
                            clearInterval(show_user_event_email_receive_interval);
                            //clearInterval(cancel_event_interval);
                            clearInterval(check_user_data_deleted_interval);
                            clearInterval(interval);


                            $("#v_event_name").val('');
                            showHideSection('step-4-pobox51')
                        }
                    }
                    else {
                        ToastHelper.error(response.msg, 'Error', {'position': 'bottomRight'});
                    }
                },
                error: function (xhr) {

                    //EMPTY EVENT NAME AND CREATE DATETIME
                    localStorage.setItem('event_name','');
                    localStorage.setItem('event_last_create_datetime','');

                    // ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
                }
            });
        }
    //}
}

$(document).ready(function () {
    create_and_check_event_state();
});



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
            ToastHelper.success(MSG_FOR_SUCCESSFULLY_ADD_TIME_IN_RUNNIG_EVENT, 'Time Addon', {'position': 'bottomRight'});
        },
        error: function () {
            ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error', {'position': 'bottomRight'});
        }
    });
    current_seconds = parseInt(current_seconds) + parseInt($("#event_addon_timer_in_seconds").val());
    total_time_seconds = parseInt(total_time_seconds) + parseInt($("#event_addon_timer_in_seconds").val());


    //SET PROGRESS BAR
    console.log('total_time_seconds:::'+total_time_seconds);
    console.log('current_seconds:::'+current_seconds);

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
        console.log("Enter In Btn CLS");

        localStorage.setItem('event_name', '');
        localStorage.setItem('event_last_create_datetime', '');

        $(".create_event_error_msg").text('');

        if ($(".v_event_name:visible").val() != "") {
            var event_name = $(".v_event_name").val();

            $("#event_email_with_postfix").val(event_name + $("#event_email_postfix").val());

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

                                if ($("#step-3-pobox51").length) {
                                    showHideSection('step-3-pobox51')
                                }
                                else {
                                    create_and_check_event_state();
                                }
                            }
                            else {
                                $(".create_event_error_msg").text(response.msg).show();
                                $(".v_event_name:visible").val('');
                                // ToastHelper.error(response.msg, 'Error');
                            }
                        },
                        error: function () {
                            $(".create_event_error_msg").text(MSG_SOMETHING_WENT_WRONG_AT_SERVER).show();
                            // ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
                        }
                    });
                return false;
            }
            else {
                $(".create_event_error_msg").text(MSG_FOR_FILL_VALID_EMAIL_PREFIX_BEFORE_START_EVENT).show();
                // ToastHelper.error(MSG_FOR_FILL_VALID_EMAIL_PREFIX_BEFORE_START_EVENT, 'Error');
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
    if ($(".v_event_name:visible").val() != "")
    {
        var event_name = $(".v_event_name").val();
        if (validate_email_prefix(event_name))
        {
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
                            ToastHelper.success(response.msg, 'Completed Event', {'position': 'bottomRight'});

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
                            ToastHelper.error(response.msg, 'Error', {'position': 'bottomRight'});
                        }
                    },
                    error: function () {
                        ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error', {'position': 'bottomRight'});
                    }
                });
                return false;
        }
        else {
            ToastHelper.error(MSG_FOR_FILL_VALID_EMAIL_PREFIX_BEFORE_START_EVENT, 'Error', {'position': 'bottomRight'});
            return false;
        }
    }
    else {
        ToastHelper.error(MSG_FOR_FILL_EMAIL_BEFORE_START_EVENT, 'Error', {'position': 'bottomRight'});
        return false;
    }
}

if ($(".cancel_event_btn").length)
{
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
                    }
                    else {
                        $(".contact_count").text(response.data);
                    }

                    if(response.data > 0){
                        $("#vcf_download_url_a").addClass("download-show");
                    }else{
                        $("#vcf_download_url_a").addClass("download-hide");
                    }
                }
                else {
                    ToastHelper.error(response.msg, 'Error', {'position': 'bottomRight'});
                }
            },
            error: function () {
                ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error', {'position': 'bottomRight'});
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

                    location.reload();
                }
            },
            error: function () {
                ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error', {'position': 'bottomRight'});
            }
        });
    return false;
}
