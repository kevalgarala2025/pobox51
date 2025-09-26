<div style="margin: 0 !important;color: #000;background-color: #f3f7f8;">

	<div style="width: 100%;background: #fff;max-width: 823px;
	    margin: 0 auto;table-layout: fixed;overflow: hidden;">
		<!-- Logo -->
		<table style="width: 100%;max-width: 823px;margin: 0 auto;
	    background-size: 100%;border-spacing: 0;font-family: sans-serif;color: #000;
	    font-size: 16px;">
			<tr>
				<td>
					<a target="_blank" href="{{env('FRONT_SITE_URL')}}">
						@if(isset($header_img))
							<img src="{{$header_img}}" alt="logo-banner" style="height:auto;width:100%;">
						@else
							<img src="{{ URL::asset(FRONTEND_EMAIL_IMAGE_FOLDER_PATH.'banner.png')}}" alt="logo-banner" style="height:auto;width:100%;">
						@endif
					</a>
				</td>
			</tr>
		</table>