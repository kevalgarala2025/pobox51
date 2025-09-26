/*
Template Name: Skote - Responsive Bootstrap 4 Admin Dashboard
Author: Themesbrand
Version: 1.1.0
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Main Js File
*/


(function ($) {

    'use strict';

    function initMetisMenu() {
        //metis menu
        $("#side-menu").metisMenu();
    }

    function initLeftMenuCollapse() {
        $('#vertical-menu-btn').on('click', function (event) {
            event.preventDefault();
            $('body').toggleClass('sidebar-enable');
            if ($(window).width() >= 992) {
                $('body').toggleClass('vertical-collpsed');
            } else {
                $('body').removeClass('vertical-collpsed');
            }
        });
    }

    function initActiveMenu() {
        // === following js will activate the menu in left side bar based on url ====
        $("#sidebar-menu a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("mm-active"); // add active to li of the current link
                $(this).parent().parent().addClass("mm-show");
                $(this).parent().parent().prev().addClass("mm-active"); // add active class to an anchor
                $(this).parent().parent().parent().addClass("mm-active");
                $(this).parent().parent().parent().parent().addClass("mm-show"); // add active to li of the current link
                $(this).parent().parent().parent().parent().parent().addClass("mm-active");
            }
        });
    }

    function initMenuItem() {
        $(".navbar-nav a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) { 
                $(this).addClass("active");
                $(this).parent().addClass("active");
                $(this).parent().parent().addClass("active");
                $(this).parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().parent().addClass("active");
            }
        });
    }

    function initFullScreen() {
        $('[data-toggle="fullscreen"]').on("click", function (e) {
            e.preventDefault();
            $('body').toggleClass('fullscreen-enable');
            if (!document.fullscreenElement && /* alternative standard method */ !document.mozFullScreenElement && !document.webkitFullscreenElement) {  // current working methods
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
            }
        });
        document.addEventListener('fullscreenchange', exitHandler );
        document.addEventListener("webkitfullscreenchange", exitHandler);
        document.addEventListener("mozfullscreenchange", exitHandler);
        function exitHandler() {
            if (!document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
                console.log('pressed');
                $('body').removeClass('fullscreen-enable');
            }
        }
    }

    function initRightSidebar() {
        // right side-bar toggle
        $('.right-bar-toggle').on('click', function (e) {
            $('body').toggleClass('right-bar-enabled');
        });

        $(document).on('click', 'body', function (e) {
            if ($(e.target).closest('.right-bar-toggle, .right-bar').length > 0) {
                return;
            }

            $('body').removeClass('right-bar-enabled');
            return;
        });
    }

    function initDropdownMenu() {
        $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
            if (!$(this).next().hasClass('show')) {
              $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
            }
            var $subMenu = $(this).next(".dropdown-menu");
            $subMenu.toggleClass('show');
    
            return false;
        });   
    }
    
    function initComponents() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    }

    function initPreloader() {
        $(window).on('load', function() {
            $('#status').fadeOut();
            $('#preloader').delay(350).fadeOut('slow');
        });
    }

    function initSettings() {
        if (window.sessionStorage) {
            var alreadyVisited = sessionStorage.getItem("is_visited");
            if (!alreadyVisited) {
                sessionStorage.setItem("is_visited", "light-mode-switch");
                updateThemeSetting(false, true, true);
            } else {
                $(".right-bar input:checkbox").prop('checked', false);
                $("#"+alreadyVisited).prop('checked', true);
                $("#"+alreadyVisited).trigger("change");
                if(alreadyVisited === "light-mode-switch") {
                    updateThemeSetting(false, true, true);
                } else if(alreadyVisited === "dark-mode-switch") {
                    updateThemeSetting(true, false, true);
                } else if(alreadyVisited === "rtl-mode-switch") {
                    updateThemeSetting(false, true, false);
                }
            }
        }

        $("#light-mode-switch, #dark-mode-switch, #rtl-mode-switch").on("change", function(e) {
            if(e.target.id === "light-mode-switch" && $(this).prop("checked")) {
                $("#dark-mode-switch").prop("checked", false);
                $("#rtl-mode-switch").prop("checked", false);
                updateThemeSetting(false, true, true);
                sessionStorage.setItem("is_visited", e.target.id);
            } else if(e.target.id === "dark-mode-switch" && $(this).prop("checked")) {
                $("#light-mode-switch").prop("checked", false);
                $("#rtl-mode-switch").prop("checked", false);
                updateThemeSetting(true, false, true);
                sessionStorage.setItem("is_visited", e.target.id);
            } else if(e.target.id === "rtl-mode-switch" && $(this).prop("checked")) {
                $("#dark-mode-switch").prop("checked", false);
                $("#light-mode-switch").prop("checked", false);
                updateThemeSetting(false, true, false);
                sessionStorage.setItem("is_visited", e.target.id);
            }
        });
    }

    function updateThemeSetting(light, dark, rtl) {
        $("#bootstrap-light").prop("disabled", light);
        $("#bootstrap-dark").prop("disabled", dark);
        $("#app-light").prop("disabled", (rtl) ? light : true);
        $("#app-dark").prop("disabled", dark);
        $("#app-rtl").prop("disabled", rtl);
    }

    function init() {
        initMetisMenu();
        initLeftMenuCollapse();
        initActiveMenu();
        initMenuItem();
        initFullScreen();
        initRightSidebar();
        initDropdownMenu();
        initComponents();
        initSettings();
        initPreloader();
        Waves.init();
    }

    init();

})(jQuery)
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": 300,
  "hideDuration": 1000,
  "timeOut": 5000,
  "extendedTimeOut": 1000,
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

function delete_action_confirm(id){
    Swal.fire(
    {
        title: 'Are you sure you want to delete this record?',
        text: "",
        icon: "warning",
        showCancelButton: true,
        dangerMode: true,
        })
        .then((confirmed) => 
        {
            if(confirmed.isConfirmed)
            {
                $("#delete_action_frm_"+id).submit();
            }
            else
            {
                Swal.fire('Your Data is Safe', '', 'info')
            }
        });
    }
$("#search_action_btn").on("click",function(){
	if($("#search_action_keyword").val() != ""){
		$("#search_perpagerecord_action_frm").submit();
	} else {
		Command: toastr["error"]('Please enter keyword for search','Search')
	}
});


$("#perpage_show_action").on("change",function(){
	$("#search_perpagerecord_action_frm").submit();
});

$("#datefiltertype").on("change",function(){
    if($(this).val() == 'custom') {

        $(".dates").show();

    } else {

        $(".dates").hide();
        
        $(".cdates").each(function(){
            $(this).val('');
        });
    }
});


if($("#datefiltertype").length)
{
    $("#datefiltertype").trigger('change');
}



$(".status_action").on("change",function(){
    var url = $(this).attr('action_url');
    if ($(this).is(':checked')) {
        status = 'Active'
    }else{
        status = 'Inactive';    
    }
    $.ajax({
        type: 'post',
        url:  url,
        data: {'e_status':status},
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) 
        {
            Command: toastr["success"](MSG_RECORD_STATUS_UPDATED,TITLE_RECORD_STATUS_UPDATED)       
        },
        error: function()
        {
            Command: toastr["error"](MSG_SOMETHING_WENT_WRONG_AT_SERVER,TITLE_SOMETHING_WENT_WRONG_AT_SERVER)   
        }
    });
})



$(".status_consumed_action").on("change",function(){
    var url = $(this).attr('action_url');
    if ($(this).is(':checked')) {
        status = 'Yes'
    }else{
        status = 'No';    
    }
    $.ajax({
        type: 'post',
        url:  url,
        data: {'e_is_consumed':status},
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) 
        {
            Command: toastr["success"](MSG_RECORD_STATUS_UPDATED,TITLE_RECORD_STATUS_UPDATED)       
        },
        error: function()
        {
            Command: toastr["error"](MSG_SOMETHING_WENT_WRONG_AT_SERVER,TITLE_SOMETHING_WENT_WRONG_AT_SERVER)   
        }
    });
})


$("#gen_select_all1").click(function(event) 
{
    if ($("#gen_select_all1").is(':checked')) 
    {
        $("#gen_select_all1_label").text('UnSelect All ('+$('.chk1').length+')');
        $(".chk1").each(function () 
        {
           $(this).attr("checked", true);
        });
    } 
    else 
    {
        $("#gen_select_all1_label").text('Select All ('+$('.chk1').length+')');
        $(".chk1").each(function () 
        {
           $(this).attr("checked", false);
        });
    }
    jQuery.uniform.update(".chk1");
});
if($(".sub_chk1").length > 0)
{
	
    var check_count1 = 0;
    $(".sub_chk1").each(function () 
    {
        if($(this).is(':checked')) 
        {
            check_count1 = parseInt(check_count1) + 1;
        }
    });

    if(parseInt(check_count1) == $(".sub_chk1").length)
    {
        $(".module_chk1").each(function () 
        {
            $('#gen_sub_module_select_all_'+$(this).attr("modulekey")+'_label').text('UnSelect All ('+$('.sub_chk1_'+$(this).attr("modulekey")).length+')');
            $(this).attr("checked", true);
        });

        $('#gen_sub_select_all1').attr("checked",true);
        $("#gen_sub_select_all1_label").text('UnSelect All ('+$('.module_chk1').length+')');

        jQuery.uniform.update(".sub_chk1");
        jQuery.uniform.update('#gen_sub_select_all1');
        jQuery.uniform.update('.module_chk1');

    }
    else
    {
        $('#gen_sub_select_all1').attr("checked",false);
        $("#gen_sub_select_all1_label").text('Select All ('+$('.module_chk1').length+')');
        

        if($(".module_chk1").length > 0)
        {
            $(".module_chk1").each(function () 
            {
                var check_count1 = 0;
                $(".sub_chk1_"+$(this).attr("modulekey")).each(function () 
                {
                    if($(this).is(':checked')) 
                    {
                        check_count1 = parseInt(check_count1) + 1;
                    }
                });
                
                if(parseInt(check_count1) == $(".sub_chk1_"+$(this).attr("modulekey")).length)
                {
                    $('#gen_sub_module_select_all_'+$(this).attr("modulekey")+'_label').text('UnSelect All ('+$('.sub_chk1_'+$(this).attr("modulekey")).length+')');

                    $("#gen_sub_module_select_all"+$(this).attr("modulekey")).attr("checked", true);

                }
                else
                {
                    $('#gen_sub_module_select_all_'+$(this).attr("modulekey")+'_label').text('Select All ('+$('.sub_chk1_'+$(this).attr("modulekey")).length+')');

                    $("#gen_sub_module_select_all"+$(this).attr("modulekey")).attr("checked", false);
                }
                jQuery.uniform.update("#gen_sub_module_select_all"+$(this).attr("modulekey"));

            });
        }
    }
    jQuery.uniform.update('#gen_sub_select_all1');
    jQuery.uniform.update(".module_chk1");
}

$(".sub_chk1").click(function(event) 
{
    if($(this).is(':checked')) 
    {
        var check_count = 0;
        $(".sub_chk1").each(function () 
        {
            if($(this).is(':checked')) 
            {
                check_count = parseInt(check_count) + 1;
            }
        });
        
        if(parseInt(check_count) == $(".sub_chk1").length)
        {
            $(".module_chk1").each(function () 
            {
                $('#gen_sub_module_select_all_'+$(this).attr("modulekey")+'_label').text('UnSelect All ('+$('.sub_chk1_'+$(this).attr("modulekey")).length+')');
                $(this).attr("checked", true);
            });

            $('#gen_sub_select_all1').attr("checked",true);
            $("#gen_sub_select_all1_label").text('UnSelect All ('+$('.module_chk1').length+')');

            jQuery.uniform.update(".sub_chk1");
            jQuery.uniform.update('#gen_sub_select_all1');
            jQuery.uniform.update('.module_chk1');

        }
        else
        {
            $('#gen_sub_select_all1').attr("checked",false);
            $("#gen_sub_select_all1_label").text('Select All ('+$('.module_chk1').length+')');

            var check_count1 = 0;
            $(".sub_chk1_"+$(this).attr('modulekey')).each(function () 
            {
                if($(this).is(':checked')) 
                {
                    check_count1 = parseInt(check_count1) + 1;
                }
            });

            jQuery.uniform.update(".sub_chk1");
            jQuery.uniform.update('#gen_sub_select_all1');

            if(parseInt(check_count1) == $(".sub_chk1_"+$(this).attr('modulekey')).length)
            {
                $('#gen_sub_module_select_all_'+$(this).attr("modulekey")+'_label').text('UnSelect All ('+$('.sub_chk1_'+$(this).attr("modulekey")).length+')');
                $("#gen_sub_module_select_all"+$(this).attr("modulekey")).attr("checked", true);
            }
            else
            {
                $('#gen_sub_module_select_all_'+$(this).attr("modulekey")+'_label').text('Select All ('+$('.sub_chk1_'+$(this).attr("modulekey")).length+')');
                $("#gen_sub_module_select_all"+$(this).attr("modulekey")).attr("checked", false);
            }

            jQuery.uniform.update("#gen_sub_module_select_all"+$(this).attr("modulekey"));

        }
    }
    else 
    {
        $('#gen_sub_select_all1').attr("checked",false);
        $("#gen_sub_select_all1_label").text('Select All ('+$('.module_chk1').length+')');
    

        var check_count1 = 0;
        $(".sub_chk1_"+$(this).attr('modulekey')).each(function () 
        {
            if($(this).is(':checked')) 
            {
                check_count1 = parseInt(check_count1) + 1;
            }
        });

        jQuery.uniform.update(".sub_chk1");
        jQuery.uniform.update('#gen_sub_select_all1');

        if(parseInt(check_count1) == $(".sub_chk1_"+$(this).attr('modulekey')).length)
        {
            $('#gen_sub_module_select_all_'+$(this).attr("modulekey")+'_label').text('UnSelect All ('+$('.sub_chk1_'+$(this).attr("modulekey")).length+')');
            $("#gen_sub_module_select_all"+$(this).attr("modulekey")).attr("checked", true);
        }
        else
        {
            $('#gen_sub_module_select_all_'+$(this).attr("modulekey")+'_label').text('Select All ('+$('.sub_chk1_'+$(this).attr("modulekey")).length+')');
            $("#gen_sub_module_select_all"+$(this).attr("modulekey")).attr("checked", false);
        }

        jQuery.uniform.update("#gen_sub_module_select_all"+$(this).attr("modulekey"));

    }

    

    
});

$(".module_chk1").click(function(event) 
{
    if($(this).is(':checked')) 
    {
        $('#gen_sub_module_select_all_'+$(this).attr("modulekey")+'_label').text('UnSelect All ('+$('.sub_chk1_'+$(this).attr("modulekey")).length+')');

        $(".sub_chk1_"+$(this).attr("modulekey")).each(function () 
        {
           $(this).attr("checked", true);
        });

    } 
    else 
    {
        $('#gen_sub_module_select_all_'+$(this).attr("modulekey")+'_label').text('Select All ('+$('.sub_chk1_'+$(this).attr("modulekey")).length+')');

        $(".sub_chk1_"+$(this).attr("modulekey")).each(function () 
        {
           $(this).attr("checked", false);
        });
    }
    jQuery.uniform.update(".sub_chk1_"+$(this).attr("modulekey"));
});

$("#gen_sub_select_all1").click(function(event) 
{
    if ($("#gen_sub_select_all1").is(':checked')) 
    {
        $("#gen_sub_select_all1_label").text('UnSelect All ('+$('.module_chk1').length+')');
        $(".sub_chk1").each(function () 
        {
           $(this).attr("checked", true);
        });

        $(".module_chk1").each(function () 
        {
            $('#gen_sub_module_select_all_'+$(this).attr("modulekey")+'_label').text('UnSelect All ('+$('.sub_chk1_'+$(this).attr("modulekey")).length+')');
            $(this).attr("checked", true);
        });

    } 
    else 
    {
        $("#gen_sub_select_all1_label").text('Select All ('+$('.module_chk1').length+')');
        $(".sub_chk1").each(function () 
        {
           $(this).attr("checked", false);
        });

        $(".module_chk1").each(function () 
        {
            $('#gen_sub_module_select_all_'+$(this).attr("modulekey")+'_label').text('Select All ('+$('.sub_chk1_'+$(this).attr("modulekey")).length+')');
            $(this).attr("checked", false);
        });
    }
    jQuery.uniform.update(".sub_chk1");
    jQuery.uniform.update(".module_chk1");
});

$("#subchk_search_textbox1").on("keyup", function() 
{
    var value = $(this).val().toLowerCase();
    $("#subchk_box_div1_panel div.panelSearch").filter(function() 
    {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#chk_search_textbox1").on("keyup", function() 
{
    var value = $(this).val().toLowerCase();
    $("#chk_box_div1 div.sales-list").filter(function() 
    {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
}); 

$("#chk_search_textbox2").on("keyup", function() 
{
    var value = $(this).val().toLowerCase();
    $("#chk_box_div2 div.sales-list").filter(function() 
    {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
}); 
$("#gen_select_all2").click(function(event) 
{
    if ($("#gen_select_all2").is(':checked')) 
    {
        $("#gen_select_all2_label").text('UnSelect All ('+$('.chk2').length+')');
        $(".chk2").each(function () 
        {
           $(this).attr("checked", true);
        });
    } 
    else 
    {
        $("#gen_select_all2_label").text('Select All ('+$('.chk2').length+')');
        $(".chk2").each(function () 
        {
           $(this).attr("checked", false);
        });
    }
    jQuery.uniform.update(".chk2");
});




if($("#map").length)
{

    
    

    function geocodePosition(pos) {
        
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                marker.formatted_address = responses[0].formatted_address;
            } else {
                marker.formatted_address = 'Cannot determine address at this location.';
            }
            $("#t_address").val(marker.formatted_address);
            infowindow.setContent('<div><strong>'+marker.formatted_address+'</strong></div>');
            infowindow.open(map, marker);
        });
    }


    function initMap() {
        
        var geocoder = new google.maps.Geocoder();

        if($("#v_latitude").val() == '' && $("#v_longitude").val() == '')
        {
            var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: 39.8097343, lng: -98.5556199},
              zoom: 6
            });
        }
        else
        {
            selected_latlong = {lat: parseInt($("#v_latitude").val()), lng: parseInt($("#v_longitude").val())};

            var map = new google.maps.Map(document.getElementById('map'), {
              center: selected_latlong,
              zoom: 8
            });

            

            // Add info window
            const infowindow = new google.maps.InfoWindow({
                content: '<div><strong>'+$("#t_address").val()+'</strong></div>'
            });
            
            // The marker, positioned at selected location
            const marker = new google.maps.Marker({
                position: selected_latlong,
                map: map,
                title: 'User Selected Location',
                anchorPoint: new google.maps.Point(0, -29),
                draggable: true
            });

            // Marker click event: open info window
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
            });

            // Open info window on load
            infowindow.open(map, marker);

           

            map.setCenter(marker.position);
            marker.setMap(map);

            
           



        } 


        var input = document.getElementById('search_input_box');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29),
          draggable: true
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
              window.alert("Autocomplete's returned place contains no geometry");
              return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
              map.fitBounds(place.geometry.viewport);
          } else {
              map.setCenter(place.geometry.location);
              map.setZoom(17);
          }
          marker.setIcon(({
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);
      
          var address = '';
          if (place.address_components) {
              address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
              ].join(' ');
          }
      
          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
        
          var address = place.formatted_address;

          // Location details
          for (var i = 0; i < place.address_components.length; i++) {
            if(place.address_components[i].types[0] == 'country'){
              address = address+','+place.address_components[i].long_name;
            }
            if(place.address_components[i].types[0] == 'postal_code'){
              address = address+','+place.address_components[i].long_name;
            }
          }
          $("#t_address").val(address);
          $("#v_latitude").val(place.geometry.location.lat());
          $("#v_longitude").val(place.geometry.location.lng());
          
        });



         google.maps.event.addListener(marker, 'dragend', function() {
            geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results && results.length > 0) 
                    {
                        /*var address_components = results[0].address_components;
                        var components={};
                        jQuery.each(address_components, function(k,v1) {jQuery.each(v1.types, function(k2, v2){components[v2]=v1.long_name});});
                        var city;
                        var postal_code;
                        var state;
                        var country;
                        if(components.locality) {
                            city = components.locality;
                        }
                        if(!city) {
                            city = components.administrative_area_level_1;
                        }
                        if(components.postal_code) {
                            postal_code = components.postal_code;
                        }
                        if(components.administrative_area_level_1) {
                            state = components.administrative_area_level_1;
                        }
                        if(components.country) {
                            country = components.country;
                        }*/
                            
                        if (results && results.length > 0) {
                            marker.formatted_address = results[0].formatted_address;
                        } else {
                            marker.formatted_address = 'Cannot determine address at this location.';
                        }
                        $("#t_address").val(marker.formatted_address);
                        infowindow.setContent('<div><strong>'+marker.formatted_address+'</strong></div>');
                        infowindow.open(map, marker);


                        
                        $('#t_address').val(results[0].formatted_address);
                        $('#v_latitude').val(marker.getPosition().lat().toFixed(7));
                        $('#v_longitude').val(marker.getPosition().lng().toFixed(7));
                        
                    }
                }
            });
        });
         
    }

}
    
