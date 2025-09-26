@php
	$event_email = getSettings('event_email_domain_name');
	$event_mobile = getSettings('event_mobile_number');
	$event_addon_timer_in_seconds = getSettings('event_addon_timer_in_seconds');
	$event_timer_start_cancel_event_allow_time_in_seconds = getSettings('event_timer_start_cancel_event_allow_time_in_seconds');
@endphp
<section class="header-flex-title">

	<input type="hidden" name="event_addon_timer_in_seconds" id="event_addon_timer_in_seconds" value="{{$event_addon_timer_in_seconds}}">
	<input type="hidden" name="event_share_email_url" id="event_share_email_url" value="{{route(ALIAS_USER.'share-email')}}">
	<input type="hidden" name="event_share_email_received_url" id="event_share_email_received_url" value="{{route(ALIAS_USER.'event-share-email-received')}}">
	<input type="hidden" name="event_share_email_addon_time_url" id="event_share_email_addon_time_url" value="{{route(ALIAS_USER.'event-share-email-addon-time')}}">
	<input type="hidden" name="event_content_check_delete_url" id="event_content_check_delete_url" value="{{route(ALIAS_USER.'event-content-check-delete')}}">
	<input type="hidden" name="event_timer_start_cancel_event_allow_time_in_seconds" id="event_timer_start_cancel_event_allow_time_in_seconds" value="{{$event_timer_start_cancel_event_allow_time_in_seconds}}">

    <input type="hidden" name="latitude" id="latitude" value="">
    <input type="hidden" name="longitude" id="longitude" value="">


	@if(isset($event_detail->e_status)   && $event_detail->e_status == App\Models\UserEvents::STATUS_ACTIVE)
		@php
			$event_initial_timer_in_seconds = $event_email_share_remaning_seconds;
		@endphp
		<input type="hidden" name="user_event_id" id="user_event_id" value="{{$event_detail->id}}">
		<input type="hidden" name="event_initial_timer_in_seconds" id="event_initial_timer_in_seconds" value="{{$event_email_share_remaning_seconds}}">
		<input type="hidden" name="event_status" id="event_status" value="{{$event_detail->e_status}}">
		<input type="hidden" name="user_event_email_prefix" id="user_event_email_prefix" value="{{$event_detail->v_email}}">
	@else
		@php
			$event_initial_timer_in_seconds = getSettings('event_initial_timer_in_seconds');
		@endphp
		<input type="hidden" name="user_event_id" id="user_event_id" value="">
		<input type="hidden" name="event_initial_timer_in_seconds" id="event_initial_timer_in_seconds" value="{{$event_initial_timer_in_seconds}}">

		<input type="hidden" name="event_status" id="event_status" value="">

	@endif

	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-xl-4 col-lg-4 col-md-4 col-12">
				<div class="eventBlock d-flex flex-column justify-content-center">
					<!-- Part 1 -->
					<div class="createEventIdBlock" style="display:block;">

						@if(Auth::guard(GUARD_USER)->check())
							<div class="text-center w900">Welcome {{Auth::guard(GUARD_USER)->user()->v_full_name}}</div>

							<div class="text-center w600">Create a temporary Event ID </div>
							<div class="font-12px text-center mtop-15 floatLeft eventIDBlock">
								<span class="w500">
									<input type="text" name="v_event_name" id="v_event_name" class="v_event_name" placeholder="Enter event ID">
								</span>
								<span class="email-text-clr">&nbsp;|&nbsp;</span>
								<span class="w400 email-text-clr">{{'@'.$event_email}}</span>
							</div>
						@endif

						@if(!Auth::guard(GUARD_USER)->check())
							<div class="text-center mtop-15 floatLeft">
								<div class="w400 email-text-clr mb-1 font-15">Log In With</div>
								<ul class="loginIcon-list">
									@if(getSettings('social_media_login_google_mode') == 'On')
										<li>
											<a href="{{ route(ALIAS_USER.ALIAS_USER_AUTH.'google.login') }}">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'google-icon.png') }}" alt="icon" class="img-fluid">
											</a>
										</li>
									@endif


									@if(getSettings('social_media_login_facebook_mode') == 'On')
										<li>
											<a href="{{ route(ALIAS_USER.ALIAS_USER_AUTH.'facebook.login') }}">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'facebook-icon.png') }}" alt="icon" class="img-fluid">
											</a>
										</li>
									@endif

									@if(getSettings('social_media_login_instagram_mode') == 'On')
										<li>
											<a href="{{ route(ALIAS_USER.ALIAS_USER_AUTH.'instagram.login') }}">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'instagram-icon.png') }}" alt="icon" class="img-fluid">
											</a>
										</li>
									@endif

									@if(getSettings('social_media_login_twitter_mode') == 'On')
										<li>
											<a href="{{ route(ALIAS_USER.ALIAS_USER_AUTH.'twitter.login') }}">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'twitter-icon.png') }}" alt="icon" class="img-fluid">
											</a>
										</li>
									@endif

									@if(getSettings('social_media_login_linkedin_mode') == 'On')
										<li>
											<a href="{{ route(ALIAS_USER.ALIAS_USER_AUTH.'linkedin.login') }}">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'linkedlin-icon.png') }}" alt="icon" class="img-fluid">
											</a>
										</li>
									@endif

									@if(getSettings('social_media_login_github_mode') == 'On')
										<li>
											<a href="{{ route(ALIAS_USER.ALIAS_USER_AUTH.'github.login') }}">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'github-icon.png') }}" alt="icon" class="img-fluid">
											</a>
										</li>
									@endif

									@if(getSettings('social_media_login_apple_mode') == 'On')
										<li>
											<a href="{{ route(ALIAS_USER.ALIAS_USER_AUTH.'apple.login') }}">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'app-store-icon.png') }}" alt="icon" class="img-fluid">
											</a>
										</li>
									@endif

								</ul>
							</div>
						@endif

						<div createevent_url="{{route(ALIAS_USER.'create-event')}}" @if(Auth::guard(GUARD_USER)->check()) class="continue-btn ptop-80 floatLeft create_event_btn" @else
							class="continue-btn ptop-80 floatLeft" @endif>
							<a href="javascript:void(0)">
								CONTINUE
							</a>
						</div>

						<a href="{{route(ALIAS_USER.'context')}}" class="w600 linkText font-12 blue-text mtop-15 floatLeft">
							Understand the context, before sharing your contact >
						</a>
					</div>

					<!-- Part 2 -->
					<div class="contactReceivedBlock" style="display:none;">
						<div class="text-center w600"><span class="event_name"></span>{{'@'.$event_email}}</div>
						<div class="w400 email-text-clr font-12 text-center">is created. Contact wil be shared within {{round($event_initial_timer_in_seconds / 60)}} minutes</div>

						<div class="countTimer-Section eventIDBlock">
							<div class="tk_countdown_time">
								<span class="counter_box">
									<span class="tk_counter minutes">00</span>
								</span>
    							<span class="counter_box">
    								<span class="tk_counter seconds">00</span>
    							</span>
							</div>

                            <span class="counter_box minAddBlock" id="add_time_btn">
                                <span class="tk_counter hours">+{{$event_addon_timer_in_seconds / 60}}</span>
                                <span class="tk_text">Mins</span>
                            </span>
						</div>
						<div class="w700 text-center">
							CONTACTS RECEIVED: <contact_count class="contact_count">{{(isset($user_event_contact_received)?$user_event_contact_received:0)}}</contact_count>
						</div>

						<div cancelevent_url="{{route(ALIAS_USER.'completed-event')}}" class="continue-btn floatLeft cancel_event_btn">
							<a href="javascript:void(0)">
								CANCEL
							</a>
						</div>

						<div class="w400 email-text-clr font-12 text-center">
							Tell everyone to share their phone number in subject line
						</div>

						<div class="emailBlock">
							<div class="headingEmail">
								<div class="w700">New E-Mail</div>
								<div class="mailIcons-top">
									<span>
										<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'mail-icon-1.png') }}" alt="mail-icon" class="img-fluid">
									</span>
									<span>
										<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'mail-icon-2.png') }}" alt="mail-icon" class="img-fluid">
									</span>
									<span>
										<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'mail-icon-3.png') }}" alt="mail-icon" class="img-fluid">
									</span>
								</div>
							</div>
							<div class="bodyMailId">
								<div class="mailText">
									<event-name class="event_name"></event-name>{{'@'.$event_email}}
								</div>
								<div class="mailTextAttachment">
									<span>Cc</span>
									<span>Bcc</span>
								</div>
							</div>
							<div class="bodyMessage">
								{{$event_mobile}}
							</div>
						</div>
					</div>

					<!-- Part 3 -->
					<div class="contactSharedBlock" style="display:none;">
						{{-- <div class="text-center w600">Event is closed, check your email for contact</div> --}}
                        <div class="text-center w600">Postman at work! Running to deliver…</div>
						<div class="w400 email-text-clr font-12 text-center">PS: All data deleted from our server</div>
						<div class="countTimer-Section eventIDBlock">
							<div class="tk_countdown_time">
								<span class="counter_box">
									<span class="tk_counter">00</span>
								</span>
    							<span class="counter_box">
    								<span class="tk_counter">00</span>
    							</span>
							</div>
						</div>
						<div class="w700 text-center">
							CONTACTS RECEIVED: <contact_count class="contact_count">{{(isset($user_event_contact_received)?$user_event_contact_received:0)}}</contact_count>
						</div>
						<div class="contactImage">
							<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'contact-video.gif') }}" alt="contact-image" class="img-fluid mx-auto d-block">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer START -->
        <div class="row copyrightFixed">
			<div class="col-md-12 col-12">
				<div class="white-text w600 font-15 text-left">
					We promise not to ever look at your data or retain it after the contacts are exchanged
				</div>
			</div>
		</div>
        <!-- Footer END -->
	</div>
</section>
