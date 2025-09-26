    <!-- JavaScript -->
    <script src="{{ asset(FRONTEND_JS_FOLDER_PATH.'libraries.js') }}"></script>

    <script src="{{ mix(FRONTEND_JS_FOLDER_PATH.'script.js') }}"></script>

    <script type="text/javascript">
    	$(document).ready(function()
      {
  	    //Background Images Slider
        $('.banner-slider').owlCarousel(
        {
          autoplay: true,
          lazyLoad: true,
          rewind: true,
          margin: 30,
          /*
          animateOut: 'fadeOut',
          animateIn: 'fadeIn',
          */
          responsiveClass: true,
          autoHeight: true,
          autoplayTimeout: 7000,
          smartSpeed: 800,
          nav: false,
          dots: false,
          responsive: {
            0: {
              items: 1
            },

            600: {
              items: 1
            },

            1024: {
              items: 1
            },

            1366: {
              items: 1
            }
          }
        });

        $('.banner-slider-screen2').owlCarousel(
        {
          autoplay: false,
          lazyLoad: true,
          rewind: true,
          margin: 30,
          /*
          animateOut: 'fadeOut',
          animateIn: 'fadeIn',
          */
          responsiveClass: true,
          autoHeight: true,
          autoplayTimeout: 7000,
          smartSpeed: 800,
          nav: false,
          dots: true,
          responsive:
          {
            0: {
              items: 1
            },

            600: {
              items: 1
            },

            1024: {
              items: 1
            },

            1366: {
              items: 1
            }
          }
        });

      });

      var MSG_SOMETHING_WENT_WRONG_AT_SERVER = '<?= MSG_SOMETHING_WENT_WRONG_AT_SERVER ?>';
      var MSG_FOR_SUCCESSFULLY_ADD_TIME_IN_RUNNIG_EVENT = '<?= MSG_FOR_SUCCESSFULLY_ADD_TIME_IN_RUNNIG_EVENT ?>';
      var MSG_FOR_FILL_EMAIL_BEFORE_START_EVENT = '<?= MSG_FOR_FILL_EMAIL_BEFORE_START_EVENT ?>';
      var MSG_FOR_EVENT_NOT_FOUND = '<?= MSG_FOR_EVENT_NOT_FOUND ?>';
      var MSG_FOR_FILL_VALID_EMAIL_PREFIX_BEFORE_START_EVENT = '<?= MSG_FOR_FILL_VALID_EMAIL_PREFIX_BEFORE_START_EVENT ?>';
      var MSG_EVENT_NAME_SPACE_NOT_ALLOWED = '<?= MSG_EVENT_NAME_SPACE_NOT_ALLOWED ?>';


      var MSG_GEOLOCATION_NOT_SUPPORT_BY_BROWSER            = '<?= MSG_GEOLOCATION_NOT_SUPPORT_BY_BROWSER ?>';
      var MSG_GEOLOCATION_DENIED_BY_USER_TO_CREATE_EVENT    = '<?= MSG_GEOLOCATION_DENIED_BY_USER_TO_CREATE_EVENT ?>';
    </script>
