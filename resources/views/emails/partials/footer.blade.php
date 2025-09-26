<table style="width: 100%;max-width: 823px;margin: 0 auto;
	    background-size: 100%;border-spacing: 0;font-family: sans-serif;color: #000;
	    font-size: 16px;">
			<tr>
				<td style="width: 100%;max-width: 823px;height: 139px;margin: 0 auto;position: relative;">
					<a target="_blank" href="{{env('FRONT_SITE_URL')}}">
						@if(!isset($footer_img))
							<img src="{{ URL::asset(FRONTEND_EMAIL_IMAGE_FOLDER_PATH.'footer-img.png')}}" alt="logo-banner" style="height:auto;width:100%;">
						@else
							<img src="{{$footer_img}}" alt="logo-banner" style="height:auto;width:100%;">
						@endif
					</a>
					<div style="margin-top: -58px;margin-left: 0;text-align: center;">
						
					</div>
				</td>
			</tr>
			<tr style="display: inline-table;padding: 20px;padding-bottom: 10px;">
				<td style="width: 100%;max-width: 8%;">
					
				</td>
				<td style="width: 100%;max-width: 55%;">
					<p style="font-size:16px;text-align: center;line-height: 1.4;">
						for any query write us at <br/>
						<a href="{{env('APP_URL')}}" style="color: #1499e3;">{{SUPPORT_EMAIL}}</a>
					</p>
				</td>
			</tr>
		</table>
	</div>
</div>