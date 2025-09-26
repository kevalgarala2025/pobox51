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

		<!-- BEGIN INCLUDED HEADER -->
		  @include($ViewFolder.'.partials.login_event_process_box')
		<!-- END INCLUDED HEADER -->
		
        <!-- Banner START -->
		<div class="banner-slider owl-carousel owl-theme">  
			<div class="item">
				<div class="header-banner" style="background-image: url('{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'slider-bg-1.png') }}')">
				</div>
			</div>
			<div class="item">
				<div class="header-banner" style="background-image: url('{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'slider-bg-2.png') }}')">
				</div>
			</div>
			<div class="item">
				<div class="header-banner" style="background-image: url('{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'slider-bg-3.png') }}')">
				</div>
			</div>
			<div class="item">
				<div class="header-banner" style="background-image: url('{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'slider-bg-4.png') }}')">
				</div>
			</div>
		</div>
        <!-- Banner END -->

        <!-- BEGIN INCLUDED CSS -->
		  @include($ViewFolder.'.partials.js')
		<!-- END INCLUDED CSS -->
    </body>
</html>