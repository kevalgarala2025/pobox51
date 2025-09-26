
//GET USER LOCATION CODE START

request_location();
function request_location() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(show_location_position, show_location_error);
    } else {
        ToastHelper.error(MSG_GEOLOCATION_NOT_SUPPORT_BY_BROWSER, 'Error');
    }
}

function show_location_position(position) {
    $("#latitude").val(position.coords.latitude);
    $("#longitude").val(position.coords.longitude);
}

function show_location_error(error) {
    ToastHelper.error(MSG_GEOLOCATION_DENIED_BY_USER_TO_CREATE_EVENT, 'Error', {'position': 'bottomRight', 'onClosing': function() {
           // location.reload();
        }
    });
}


//GET USER LOCATION CODE END


//TIMER CODE START
var current_seconds = parseInt($("#event_initial_timer_in_seconds").val());
var interval;

var cancel_event_seconds = parseInt($("#event_timer_start_cancel_event_allow_time_in_seconds").val());
var cancel_event_interval;


function start_countdown()
{
    interval = setInterval(update_countdown, 1000); // Run update_countdown every second
}

function update_countdown()
{
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
            url:  url,
            data: {'i_user_event_id':$("#user_event_id").val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response)
            {
                if(response.flag)
                {
                    $('.contactReceivedBlock').css('display', 'none');
                    $('.createEventIdBlock').css('display', 'none');
                    $('.contactSharedBlock').css('display', 'block');


                    //START CODE FOR STOP CONTACT RECEIVED SCRIPT CHECKING
                    clearInterval(show_user_event_email_receive_interval);
                    //END CODE FOR STOP CONTACT RECEIVED SCRIPT CHECKING


                    //START CHECKING EVENT USER EMAIL DATA DELETE

                        check_user_data_deleted_interval = setInterval(check_user_data_deleted,2000);

                        /*setTimeout(function(){
                            check_user_data_deleted();
                        },2000);*/

                    //END CHECKING EVENT USER EMAIL DATA DELETE



                }
                else
                {
                    ToastHelper.error(response.msg, 'Error');
                }
            },
            error: function()
            {
                ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
            }
        });



    }
}



function start_cancel_btn_countdown()
{
    cancel_event_interval = setInterval(update_cancel_btn_countdown, 1000); // Run update_countdown every second
}

function update_cancel_btn_countdown()
{
    var minutes = Math.floor(cancel_event_seconds / 60);
    var seconds = cancel_event_seconds % 60;

    // Add leading zeros if necessary
    var formatted_minutes = (minutes < 10 ? '0' : '') + minutes;
    var formatted_seconds = (seconds < 10 ? '0' : '') + seconds;

    cancel_event_seconds--; // Decrease time remaining by 1 second

    if (cancel_event_seconds <= 0) {
        clearInterval(cancel_event_interval); // Stop the countdown when it reaches 0

        $(".cancel_event_btn").fadeOut(4000);
    }
}


$("#add_time_btn").click(function() {

    url = $("#event_share_email_addon_time_url").val();
    $.ajax(
    {
        type: 'post',
        url:  url,
        data: {'i_user_event_id':$("#user_event_id").val()},
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response)
        {
            ToastHelper.success(MSG_FOR_SUCCESSFULLY_ADD_TIME_IN_RUNNIG_EVENT, 'Time Addon');
        },
        error: function()
        {
            ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
        }
    });
    current_seconds = parseInt(current_seconds) + parseInt($("#event_addon_timer_in_seconds").val()); // Add 2 minutes (120 seconds) to the countdown
    return false;
});




//TIMER CODE END

// Animation JS
$(function() {

    function ckScrollInit(items, trigger) {
        items.each(function() {
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

            ckTrigger.waypoint(function() {
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
(function($){
	//on scroll header fixed
	$(window).scroll(function(){
		var scroll = $(window).scrollTop();

	    if (scroll >= 80) {
	        $('header').addClass('nav-fixed');
	    } else {
	        $('header').removeClass('nav-fixed');
	    }
	});
})(jQuery);



// Select all links with hashes
$('a.page-scroll').on('click', function(event) {
    // On-page links
    if ( location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname ) {
      // Figure out element to scroll to
      var target = $(this.hash),
          speed= $(this).data("speed") || 800;
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



function validate_email_prefix(email)
{
    const email_regex = /^[A-Za-z0-9]+([._][A-Za-z0-9]+)*$/;
    //const email_regex = /^[^\s@.]+$/;
    return email_regex.test(email);
}


$("#v_event_name").keydown(function (e)
{
    if (e.keyCode == 32 || e.keyCode == 50 || e.keyCode == 57 || e.keyCode == 58)
    {
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
    $("#v_event_name").val(($("#v_event_name").val()).toLowerCase());
});


if($(".create_event_btn").length)
{
    $(".create_event_btn").click(function()
    {
        if($(".v_event_name:visible").val() != "")
        {
            var event_name = $(".v_event_name").val();
            if (validate_email_prefix(event_name))
            {
                url = $(this).attr('createevent_url');
                $.ajax(
                {
                    type: 'post',
                    url:  url,
                    data: {'v_event_name':$(".v_event_name").val(),'v_longitude':$("#longitude").val(),'v_latitude':$("#latitude").val()},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response)
                    {
                        if(response.flag)
                        {
                            // Start the initial countdown
                            start_countdown();
                            start_cancel_btn_countdown();
                            setTimeout(
                                function()
                                {
                                    $(".event_name").text($(".v_event_name:visible").val());
                                    $('.createEventIdBlock').css('display', 'none');
                                    $('.contactReceivedBlock').css('display', 'block');
                            }, 1000);

                            $("#user_event_id").val(response.data);

                            //START FETCHING EMAIL RECEIVED COUNT

                                show_user_event_email_receive_interval = setInterval(show_user_event_email_receive,5000);

                                /*window.setInterval(function(){
                                  show_user_event_email_receive();
                                }, 5000);*/

                            //END FETCHING EMAIL RECEIVED COUNT

                        }
                        else
                        {
                            $(".v_event_name:visible").val('');
                            ToastHelper.error(response.msg, 'Error');
                        }
                    },
                    error: function()
                    {
                        ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
                    }
                });
                return false;
            }
            else
            {
                ToastHelper.error(MSG_FOR_FILL_VALID_EMAIL_PREFIX_BEFORE_START_EVENT, 'Error');
                return false;
            }
        }
        else
        {
            ToastHelper.error(MSG_FOR_FILL_EMAIL_BEFORE_START_EVENT, 'Error');
            return false;
        }

    })
}


if($(".cancel_event_btn").length)
{
    $(".cancel_event_btn").click(function()
    {
        if($(".v_event_name:visible").val() != "")
        {
            var event_name = $(".v_event_name").val();
            if (validate_email_prefix(event_name))
            {
                url = $(this).attr('cancelevent_url');
                $.ajax(
                {
                    type: 'post',
                    url:  url,
                    data: {'v_event_name':$(".v_event_name").val()},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response)
                    {
                        if(response.flag)
                        {
                            ToastHelper.success(response.msg, 'Cancel Event');

                            location.reload();
                        }
                        else
                        {
                            $(".v_event_name:visible").val('');
                            ToastHelper.error(response.msg, 'Error');
                        }
                    },
                    error: function()
                    {
                        ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
                    }
                });
                return false;
            }
            else
            {
                ToastHelper.error(MSG_FOR_FILL_VALID_EMAIL_PREFIX_BEFORE_START_EVENT, 'Error');
                return false;
            }
        }
        else
        {
            ToastHelper.error(MSG_FOR_FILL_EMAIL_BEFORE_START_EVENT, 'Error');
            return false;
        }

    })
}

function show_user_event_email_receive()
{
    url = $("#event_share_email_received_url").val();
    $.ajax(
    {
        type: 'post',
        url:  url,
        data: {'i_user_event_id':$("#user_event_id").val()},
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response)
        {
            if(response.flag)
            {
                $(".contact_count").text(response.data);
            }
            else
            {
                ToastHelper.error(response.msg, 'Error');
            }
        },
        error: function()
        {
            ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
        }
    });
    return false;
}


function check_user_data_deleted()
{
    url = $("#event_content_check_delete_url").val();
    $.ajax(
    {
        type: 'post',
        url:  url,
        data: {'i_user_event_id':$("#user_event_id").val()},
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response)
        {
            if(response.flag)
            {
                location.reload();
            }
        },
        error: function()
        {
            ToastHelper.error(MSG_SOMETHING_WENT_WRONG_AT_SERVER, 'Error');
        }
    });
    return false;
}


if($("#event_status").length)
{
    if($("#event_status").val() == 'Active')
    {
        // Start the remaning seconds countdown
        start_countdown();
        $(".event_name").text($("#user_event_email_prefix").val());
        $('.createEventIdBlock').css('display', 'none');
        $('.contactReceivedBlock').css('display', 'block');

        //START FETCHING EMAIL RECEIVED COUNT

            show_user_event_email_receive_interval = setInterval(show_user_event_email_receive,5000);

            /*window.setInterval(function(){
              show_user_event_email_receive();
            }, 5000);*/

        //END FETCHING EMAIL RECEIVED COUNT

    }
}
