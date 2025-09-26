        <script src="{{ URL::asset('assets/js/theme_libraries.js')}}"></script>

        @yield('script')

        <!-- App js -->
        <script src="{{ URL::asset('assets/js/libraries.js')}}"></script>

        <script src="{{ mix('assets/js/custom.js')}}"></script>
            

        @yield('script-bottom')

        <script type="text/javascript">
            var TITLE_RECORD_STATUS_UPDATED = "<?php echo TITLE_RECORD_STATUS_UPDATED; ?>";
            var MSG_RECORD_STATUS_UPDATED = "<?php echo MSG_RECORD_STATUS_UPDATED; ?>";

            var TITLE_SOMETHING_WENT_WRONG_AT_SERVER = "<?php echo TITLE_SOMETHING_WENT_WRONG_AT_SERVER; ?>";
            var MSG_SOMETHING_WENT_WRONG_AT_SERVER = "<?php echo MSG_SOMETHING_WENT_WRONG_AT_SERVER; ?>";
        </script>



