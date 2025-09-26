<!doctype html>
<html lang="en">
    <head>
    	<!-- BEGIN INCLUDED META -->
		  @include($ViewFolder.'.partials.meta')
		<!-- END INCLUDED META -->
		
        <!-- BEGIN INCLUDED CSS -->
		  @include($ViewFolder.'.partials.css')
		<!-- END INCLUDED CSS -->
    </head>
    <body data-spy="scroll" data-offset="110">
        
    	<!-- BEGIN INCLUDED HEADER -->
		  @include($ViewFolder.'.partials.header')
		<!-- END INCLUDED HEADER -->
		
        <!-- Banner START -->
		<div class="banner-slider owl-carousel owl-theme">  
			<div class="item">			
				<div class="header-banner" style="background-image: url('{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'slider-bg-solid-1.png') }}')">
					<section class="header-flex-title-screen2">
						<div class="container-fluid">
							<div class="row align-items-center">
								<div class="col-lg-4 col-md-4 col-12">
									<div class="banner-slider-screen2 owl-carousel owl-theme">
										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<div class="font-15 text-center eventIDBlock mtop-24 floatLeft">
													<span class="w500">Enter event ID</span>
													<span class="email-text-clr">&nbsp;|&nbsp;</span>
													<span class="w400 email-text-clr">@justexhangecontacts.world</span>
												</div>
												<div class="continue-btn ptop-40 floatLeft">
													<a href="#">
														CONTINUE
													</a>
												</div>
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'mail-box.png') }}" alt=" mail-box" class="img-fluid mx-auto d-block">
											</div>
										</div>

										<div class="item">
											<div>
												<div class="eventBlock h-400px countTimer-Section">
													<div class="tk_countdown_time" data-time="2023/07/01 00:00"></div>
													<!-- <span class="counter_box">
					                                    <span class="tk_counter days">09 </span>
					                                </span>
					                                <span class="counter_box">
					                                    <span class="tk_counter days">43 </span>
					                                </span> -->
					                                <span class="counter_box minAddBlock">
					                                    <span class="tk_counter hours">+2</span>
					                                    <span class="tk_text">Mins</span>
					                                </span>
												</div>
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-start">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'attachment-image.png') }}" alt=" mail-box" class="img-fluid mr-auto d-block" style="width: auto;">
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'delete-icon.png') }}" alt=" mail-box" class="img-fluid mx-auto d-block" style="width: auto;">
											</div>
										</div>
									</div>																		
								</div>

								<div class="col-lg-1 col-md-1 col-12"></div>
								<div class="col-lg-7 col-md-7 col-12">
									<h1 class="white-text text-left w600 font-48">Create a temporary Event ID </h1>
									<div class="continue-btn-white ptop-24 width-340px floatLeft">
										<a href="{{route(ALIAS_USER.'index')}}">
											START CONNECTING
										</a>
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
				</div>
			</div>

			<div class="item">
				<div class="header-banner" style="background-image: url('{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'slider-bg-solid-2.png') }}')">
					<section class="header-flex-title-screen2">
						<div class="container-fluid">
							<div class="row align-items-center">
								<div class="col-lg-4 col-md-4 col-12">
									<div class="banner-slider-screen2 owl-carousel owl-theme">
										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<div class="font-15 text-center eventIDBlock mtop-24 floatLeft">
													<span class="w500">Enter event ID</span>
													<span class="email-text-clr">&nbsp;|&nbsp;</span>
													<span class="w400 email-text-clr">@justexhangecontacts.world</span>
												</div>
												<div class="continue-btn ptop-40 floatLeft">
													<a href="#">
														CONTINUE
													</a>
												</div>
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'mail-box.png') }}" alt=" mail-box" class="img-fluid mx-auto d-block">
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px countTimer-Section">
												<div class="tk_countdown_time" data-time="2023/07/01 00:00"></div>
				                                <span class="counter_box minAddBlock">
				                                    <span class="tk_counter hours">+2</span>
				                                    <span class="tk_text">Mins</span>
				                                </span>
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-start">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'attachment-image.png') }}" alt=" mail-box" class="img-fluid mr-auto d-block" style="width: auto;">
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<img  src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'delete-icon.png') }}" alt=" mail-box" class="img-fluid mx-auto d-block" style="width: auto;">
											</div>
										</div>
									</div>																		
								</div>

								<div class="col-lg-1 col-md-1 col-12"></div>
								<div class="col-lg-7 col-md-7 col-12">
									<h1 class="white-text w600 font-48 text-left">
										Send an email to this temporary Id <br class="d-xl-block d-lg-block d-md-block d-none" />
										with subject of their phone number
									</h1>
									<div class="continue-btn-white ptop-24 width-340px floatLeft">
										<a href="{{route(ALIAS_USER.'index')}}">
											START CONNECTING
										</a>
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
				</div>
			</div>

			<div class="item">
				<div class="header-banner" style="background-image: url('{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'slider-bg-solid-3.png') }}')">
					<section class="header-flex-title-screen2">
						<div class="container-fluid">
							<div class="row align-items-center">
								<div class="col-lg-4 col-md-4 col-12">
									<div class="banner-slider-screen2 owl-carousel owl-theme">
										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<div class="font-15 text-center eventIDBlock mtop-24 floatLeft">
													<span class="w500">Enter event ID</span>
													<span class="email-text-clr">&nbsp;|&nbsp;</span>
													<span class="w400 email-text-clr">@justexhangecontacts.world</span>
												</div>
												<div class="continue-btn ptop-40 floatLeft">
													<a href="#">
														CONTINUE
													</a>
												</div>
											</div>
										</div>

										

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'mail-box.png') }}" alt=" mail-box" class="img-fluid mx-auto d-block">
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px countTimer-Section">
												<div class="tk_countdown_time" data-time="2023/07/01 00:00"></div>
				                                <span class="counter_box minAddBlock">
				                                    <span class="tk_counter hours">+2</span>
				                                    <span class="tk_text">Mins</span>
				                                </span>
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-start">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'attachment-image.png') }}" alt=" mail-box" class="img-fluid mr-auto d-block" style="width: auto;">
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'delete-icon.png') }}" alt=" mail-box" class="img-fluid mx-auto d-block" style="width: auto;">
											</div>
										</div>
									</div>																		
								</div>

								<div class="col-lg-1 col-md-1 col-12"></div>
								<div class="col-lg-7 col-md-7 col-12">
									<h1 class="white-text w600 font-48 text-left">
										Send emails for next 10 minutes,<br class="d-xl-block d-lg-block d-md-block d-none" />
										To extend  press “+” besides the timer
									</h1>
									<div class="continue-btn-white ptop-24 width-340px floatLeft">
										<a href="{{route(ALIAS_USER.'index')}}">
											START CONNECTING
										</a>
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
				</div>
			</div>

			<div class="item">
				<div class="header-banner" style="background-image: url('{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'slider-bg-solid-3.png') }}')">
					<section class="header-flex-title-screen2">
						<div class="container-fluid">
							<div class="row align-items-center">
								<div class="col-lg-4 col-md-4 col-12">
									<div class="banner-slider-screen2 owl-carousel owl-theme">
										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<div class="font-15 text-center eventIDBlock mtop-24 floatLeft">
													<span class="w500">Enter event ID</span>
													<span class="email-text-clr">&nbsp;|&nbsp;</span>
													<span class="w400 email-text-clr">@justexhangecontacts.world</span>
												</div>
												<div class="continue-btn ptop-40 floatLeft">
													<a href="#">
														CONTINUE
													</a>
												</div>
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'mail-box.png') }}" alt=" mail-box" class="img-fluid mx-auto d-block">
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px countTimer-Section">
												<div class="tk_countdown_time" data-time="2023/07/01 00:00"></div>
				                                <span class="counter_box minAddBlock">
				                                    <span class="tk_counter hours">+2</span>
				                                    <span class="tk_text">Mins</span>
				                                </span>
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-start">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'attachment-image.png') }}" alt=" mail-box" class="img-fluid mr-auto d-block" style="width: auto;">
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'delete-icon.png') }}" alt=" mail-box" class="img-fluid mx-auto d-block" style="width: auto;">
											</div>
										</div>
									</div>																		
								</div>

								<div class="col-lg-1 col-md-1 col-12"></div>
								<div class="col-lg-7 col-md-7 col-12">
									<h1 class="white-text w600 font-48 text-left">
										Once event time is over, you will receive all 
										contacts in your inbox. Save the attachment
										& the contacts will add up in your phonebook
									</h1>
									<div class="continue-btn-white ptop-24 width-340px floatLeft">
										<a href="{{route(ALIAS_USER.'index')}}">
											START CONNECTING
										</a>
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
				</div>
			</div>

			<div class="item">
				<div class="header-banner" style="background-image: url('{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'slider-bg-solid-1.png') }}')">
					<section class="header-flex-title-screen2">
						<div class="container-fluid">
							<div class="row align-items-center">
								<div class="col-lg-4 col-md-4 col-12">
									<div class="banner-slider-screen2 owl-carousel owl-theme">
										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<div class="font-15 text-center eventIDBlock mtop-24 floatLeft">
													<span class="w500">Enter event ID</span>
													<span class="email-text-clr">&nbsp;|&nbsp;</span>
													<span class="w400 email-text-clr">@justexhangecontacts.world</span>
												</div>
												<div class="continue-btn ptop-40 floatLeft">
													<a href="#">
														CONTINUE
													</a>
												</div>
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'mail-box.png') }}" alt=" mail-box" class="img-fluid mx-auto d-block">
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px countTimer-Section">
												<div class="tk_countdown_time" data-time="2023/07/01 00:00"></div>
				                                <span class="counter_box minAddBlock">
				                                    <span class="tk_counter hours">+2</span>
				                                    <span class="tk_text">Mins</span>
				                                </span>
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-start">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'attachment-image.png') }}" alt=" mail-box" class="img-fluid mr-auto d-block" style="width: auto;">
											</div>
										</div>

										<div class="item">
											<div class="eventBlock h-400px d-flex flex-column justify-content-center">
												<img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'delete-icon.png') }}" alt=" mail-box" class="img-fluid mx-auto d-block" style="width: auto;">
											</div>
										</div>
									</div>																		
								</div>

								<div class="col-lg-1 col-md-1 col-12"></div>
								<div class="col-lg-7 col-md-7 col-12">
									<h1 class="white-text w600 font-48 text-left">
										Once email is sent we will delete this
										temporary email and all contact info and<br class="d-xl-block d-lg-block d-md-block d-none" />
										data from our system. No hidden conditions.
									</h1>
									<div class="continue-btn-white ptop-24 width-340px floatLeft">
										<a href="{{route(ALIAS_USER.'index')}}">
											START CONNECTING
										</a>
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
				</div>
			</div>
		</div>
        <!-- Banner END -->

        <!-- BEGIN INCLUDED CSS -->
		  @include($ViewFolder.'.partials.js')
		<!-- END INCLUDED CSS -->
    </body>
</html>