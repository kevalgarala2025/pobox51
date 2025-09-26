<!DOCTYPE html>
<html lang="en">

<head>

    <!-- BEGIN INCLUDED META -->
    @include($ViewFolder . '.partials.meta')
    <!-- END INCLUDED META -->

    <!-- BEGIN INCLUDED CSS -->
    @include($ViewFolder . '.partials.css')
    <!-- END INCLUDED CSS -->

</head>

<body>

    @php
        $event_email = getSettings('event_email_domain_name');
        $event_mobile = getSettings('event_mobile_number');
        $event_addon_timer_in_seconds = getSettings('event_addon_timer_in_seconds');
        $event_timer_start_cancel_event_allow_time_in_seconds = getSettings(
            'event_timer_start_cancel_event_allow_time_in_seconds',
        );
    @endphp
    <input type="hidden" name="event_addon_timer_in_seconds" id="event_addon_timer_in_seconds"
        value="{{ $event_addon_timer_in_seconds }}">
    <input type="hidden" name="event_share_email_url" id="event_share_email_url"
        value="{{ route(ALIAS_USER . 'share-email') }}">
    <input type="hidden" name="event_share_email_received_url" id="event_share_email_received_url"
        value="{{ route(ALIAS_USER . 'event-share-email-received') }}">
    <input type="hidden" name="event_share_email_addon_time_url" id="event_share_email_addon_time_url"
        value="{{ route(ALIAS_USER . 'event-share-email-addon-time') }}">
    <input type="hidden" name="event_content_check_delete_url" id="event_content_check_delete_url"
        value="{{ route(ALIAS_USER . 'event-content-check-delete') }}">
    <input type="hidden" name="event_get_event_time_url" id="event_get_event_time_url"
        value="{{ route(ALIAS_USER . 'event.get.event.time', ['id' => 'PLACEHOLDER_ID']) }}">
    <input type="hidden" name="event_timer_start_cancel_event_allow_time_in_seconds"
        id="event_timer_start_cancel_event_allow_time_in_seconds"
        value="{{ $event_timer_start_cancel_event_allow_time_in_seconds }}">
    <input type="hidden" name="check_event_url" value="{{route(ALIAS_USER.'check-event')}}" id="check_event_url"/>
    <input type="hidden" name="check_running_event_url" value="{{route(ALIAS_USER.'event.check-running-event')}}" id="check_running_event_url"/>

    <input type="hidden" name="latitude" id="latitude" value="">
    <input type="hidden" name="longitude" id="longitude" value="">

    <input type="hidden" name="redirect_to_url_value" id="redirect_to_url_value" value="{{ session('redirect_to_value') }}">
    <input type="hidden" name="redirect_to_value" id="redirect_to_value" value="{{ session('redirect_to_value') }}">

    @if (isset($event_detail->e_status) && $event_detail->e_status == App\Models\UserEvents::STATUS_ACTIVE)
        @php
            $event_initial_timer_in_seconds = $event_email_share_remaning_seconds;
        @endphp
        <input type="hidden" name="user_event_id" id="user_event_id" value="{{ $event_detail->id }}">
        <input type="hidden" name="event_initial_timer_in_seconds" id="event_initial_timer_in_seconds"
            value="{{ $event_email_share_remaning_seconds }}">
        <input type="hidden" name="event_status" id="event_status" value="{{ $event_detail->e_status }}">
        <input type="hidden" name="user_event_email_prefix" id="user_event_email_prefix"
            value="{{ $event_detail->v_email }}">
        <input type="hidden" name="vcf_download_url" id="vcf_download_url" value="{{ route(ALIAS_USER . 'event.download.vcf', $event_detail->id) }}">
    @else
        @php
            $event_initial_timer_in_seconds = getSettings('event_initial_timer_in_seconds');
        @endphp
        <input type="hidden" name="user_event_id" id="user_event_id" value="">
        <input type="hidden" name="event_initial_timer_in_seconds" id="event_initial_timer_in_seconds"
            value="{{ $event_initial_timer_in_seconds }}">

        <input type="hidden" name="vcf_download_url" id="vcf_download_url" value="{{ route(ALIAS_USER . 'event.download.vcf', 'REPLACE_ID') }}">

        <input type="hidden" name="event_status" id="event_status" value="">
    @endif

    <input type="hidden" name="qr_code_image_input" value="" id="qr_code_image_input">
    <input type="hidden" name="created_date_time_event" id="created_date_time_event">
    <input type="hidden" name="completed_date_time_event" id="completed_date_time_event">

    @if(session('is_loggedin'))
        <input type="hidden" id="is_user_loggedin" value="1">
    @else
        <input type="hidden" id="is_user_loggedin" value="0">
    @endif
    <input type="hidden" id="event_email_postfix" name="event_email_postfix" value="{{ $event_email }}">
    <main class="main-content">
        <!-- Hero Section -->
        @include($ViewFolder . '.partials.step1_home_page')
        @include($ViewFolder . '.partials.step2_create_temp_email')
        @include($ViewFolder . '.partials.step3_social_login')
        @include($ViewFolder . '.partials.step4_timer')
        @include($ViewFolder . '.partials.step5_pobox_active')
        @include($ViewFolder . '.partials.step6_summary_page')
        @include($ViewFolder . '.partials.step6_timer_expired')
        @include($ViewFolder . '.partials.step8_qr_code_view')
    </main>

    <!-- Handle OAuth errors -->
    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof ToastHelper !== 'undefined') {
                    // ToastHelper.error('{{ session('error') }}', 'Authentication Error');
                } else {
                    alert('{{ session('error') }}');
                }
            });
        </script>
    @endif

    <!-- BEGIN INCLUDED CSS -->
    @include($ViewFolder . '.partials.js')
    <!-- END INCLUDED CSS -->



    {{--
    <!-- BEGIN INCLUDED STEP2 SOCIAL LOGIN -->
    @include($ViewFolder . '.partials.step2_social_login')
    <!-- END INCLUDED STEP2 SOCIAL LOGIN -->


    <!-- BEGIN INCLUDED STEP3 CONTACT SHARING -->
    @include($ViewFolder . '.partials.step3_contacts_sharing')
    <!-- END INCLUDED STEP3 CONTACT SHARING -->

    <!-- BEGIN INCLUDED STEP3 CONTACT RECEIVED -->
    @include($ViewFolder . '.partials.step4_contacts_received')
    <!-- END INCLUDED STEP3 CONTACT RECEIVED -->

    <!-- BEGIN INCLUDED FOOTER -->
     @include($ViewFolder.'.partials.footer')
    <!-- END INCLUDED FOOTER -->




    <!-- BEGIN INCLUDED MODEL POPUPS -->
    @include($ViewFolder . '.partials.modal.contact_us')
    @include($ViewFolder . '.partials.modal.terms_policies')
    @include($ViewFolder . '.partials.modal.about_us')
    <!-- END INCLUDED MODEL POPUPS --> --}}
    @include($ViewFolder . '.partials.modal.how_it_works')
    @include($ViewFolder . '.partials.modal.why_postbox51')
</body>

</html>
