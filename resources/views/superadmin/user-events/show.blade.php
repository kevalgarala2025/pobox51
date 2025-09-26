@extends($ViewFolder.'.layouts.master')







@section('title') {{ config('app.name') }} | {{$RecordShowModule}} @endsection







@section('css')



	@include($ViewFolder.'.layouts.css_components.responsivetable')



@endsection



@section('content')



   	@component($ViewFolder.'.common-components.breadcrumb')



		@slot('title') {{$RecordShowModule}} @endslot



		@slot('link') {{route($RoutePrefixName.'.index')}} @endslot



		@slot('li_1')  {{$Module}} @endslot



		@slot('li_2') {{$RecordShowModule}} @endslot



	@endcomponent



	<div class="row">



		<div class="col-12 col-md-12">



			<div class="card">



				<div class="card-body">



					<table  class="table table-striped table-bordered border-theme-color">



						<tbody>



							



							



							<tr>



								<th><strong>User </strong></th>



								<td>



									@if(isset($Record->user->v_full_name)){{ $Record->user->v_full_name }} @endif



								</td>



							</tr>







							<tr>



								<th><strong>Event Unique Id </strong></th>



								<td>



									<div class="tag-design-1 green-tag-bg border-r-50 mt-1">
										#{{ $Record->v_event_unique_id }}
									</div>



								</td>



							</tr>







							





							<tr>



								<th><strong>Event Email Prefix</strong></th>



								<td>



										@if(isset($Record->v_email))



											{{ $Record->v_email }}



										@endif



								</td>



							</tr>







							<tr>



								<th><strong>Event Total Participant</strong></th>



								<td>



									<div class="tag-design-1 red-tag-bg border-r-10">{{ $Record->i_total_participant }}</div>



								</td>



							</tr>







						


							<tr>



								<th><strong>Event Date/Time </strong></th>



								<td>



									{{ \Carbon::parse($Record->created_at)->format(DATE_TIME_DISPLAY_FORMAT) }}



								</td>



							</tr>











							<tr>



								<th><strong>Status</strong></th>



								<td>

									<div class="tag-design-1 {{getUserEventStatusClass($Record->e_status)}}  border-r-5">
										{{ $Record->e_status }}
									</div>



								</td>



							</tr>



						




							



							



						</tbody>



					</table>



				</div>



			</div>



		</div> <!-- end col -->



















		







		



	</div> <!-- end row -->



@endsection



@section('script')



	@include($ViewFolder.'.layouts.js_components.responsivetable')



@endsection



