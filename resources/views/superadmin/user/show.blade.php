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

								<th><strong>Full Name </strong></th>

								<td>

									@if(isset($Record->v_full_name)){{ $Record->v_full_name }} @endif

								</td>

							</tr>



							<tr>

								<th><strong>Email</strong></th>

								<td>

									@if(isset($Record->v_email)){{ $Record->v_email }} @endif

								</td>

							</tr>



							<tr>

								<th><strong>Profile Pic</strong></th>

								<td>

									@if(isset($Record->v_profile_pic))

										<img src="{{ $Record->v_profile_pic_path }}" class="img-thumbnail img-responsive img-emp" />

									@else

										<img src="{{ env('APP_URL').DEFAULT_FILE_PATH.'default-avatar.png' }}" class="img-thumbnail img-responsive img-emp "/>

									@endif

								</td>

							</tr>

							

							<tr>

								<th><strong>Mobile Number </strong></th>

								<td>

									@if(isset($Record->v_phone_no)){{ $Record->v_phone_no }} @endif

								</td>

							</tr>

							

							<tr>

								<th><strong>Status </strong></th>

								<td>

									<div class="tag-design-1 green-tag-bg border-r-50 mt-1">

									@if(isset($Record->e_status)){{ $Record->e_status }} @endif

									</div>

								</td>

							</tr>

							<tr>

								<th><strong>Created At </strong></th>

								<td>

									{{ \Carbon::parse($Record->created_at)->format(DATE_TIME_DISPLAY_FORMAT) }}

								</td>

							</tr>

							<tr>

								<th><strong>Updated At</strong></th>

								<td>

									{{ \Carbon::parse($Record->updated_at)->format(DATE_TIME_DISPLAY_FORMAT) }}

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

