@extends($ViewFolder.'.layouts.master')







@section('title') {{ config('app.name') }} | {{$Module}} @endsection







@section('css')



	@include($ViewFolder.'.layouts.css_components.responsivetable')



@endsection



@section('content')



@component($ViewFolder.'.common-components.breadcrumb')



	@slot('title') {{$Module}} @endslot



	@slot('li_1') Dashboard @endslot



	@slot('li_2') {{$Module}} @endslot



@endcomponent



	@include($ModuleViewFolder.'.comman.filter')



	<div class="row">



		<div class="col-12">



			<div class="card">



				<div class="card-body">



					<div class="d-flex align-items-center justify-content-end">



					



					</div>







					<!-- START SEARCH/PERPAGE DROPDOWN CODE-->



					@component($ViewFolder.'.common-components.index-search-perpagerecordshow')



                        @slot('module_route_prefix') {{ $RoutePrefixName }} @endslot



                    @endcomponent



					<!-- END SEARCH/PERPAGE DROPDOWN CODE-->



					



					<div class="table-rep-plugin">



						<div class="table-responsive" data-pattern="priority-columns">



							<table  class="table table-striped table-bordered">



								<thead>

								<tr>

									<th>User</th>

									<th>Event Unique Id</th>

									<th>Event Email Prefix</th>

									<th>Event Total Time (Min:Sec)</th>

									<th>Event Total Participant</th>

									<th>Event Date/Time</th>

									<th>Event Status</th>

									<th>Action</th>

								</tr>



								</thead>



								<tbody>



									@if(!empty($Records) && $Records->count())



										@foreach($Records as $key => $Record)

											<tr>

												<td>{{ $Record->user->v_full_name }}</td>

												<td>
													<div class="tag-design-1 green-tag-bg border-r-50 mt-1">
														#{{ $Record->v_event_unique_id }}
													</div>
												</td>

												<td>{{ $Record->v_email }}</td>

												<td>{{ $Record->i_event_display_total_time }}</td>

												<td><div class="tag-design-1 red-tag-bg border-r-10">{{ $Record->i_total_participant }}</div></td>

												<td>{{ \Carbon::parse($Record->created_at)->format(DATE_TIME_DISPLAY_FORMAT) }}</td>

												<td>
													<div class="tag-design-1 {{getUserEventStatusClass($Record->e_status)}}  border-r-5">
													{{ $Record->e_status }}
													</div>
												</td>
												
												<td>
													<a href="{{ route($RoutePrefixName.'.show',$Record->id) }}" class="btn btn-warning waves-effect waves-light float-left m-1"><i class="fas fa-eye"></i> View</a>
												</td>


											</tr>



										@endforeach



									@else



										<tr class="odd">



											<td valign="top" colspan="11" class="text-center">{{MSG_NO_RECORD_FOUND}}



											</td>



										</tr>



									@endif



								</tbody>



							</table>	



						</div>



					</div>



					



					@if(!empty($Records) && $Records->count())



						<div class="row">



							<div class="col-sm-12 col-md-3">



								<div role="status" aria-live="polite">



									Showing {{$Records->firstItem()}} to {{$Records->lastItem()}} of {{$Records->total()}} entries



								</div>



							</div>



							<div class="col-sm-12 col-md-9">



								<div class="float-right">



									{{$Records->appends(request()->input())->links()}}



								</div>



							</div>



						</div>



					@endif



				</div>



			</div>



		</div> <!-- end col -->



	</div> <!-- end row -->



@endsection



@section('script')



	@include($ViewFolder.'.layouts.js_components.responsivetable')



	@include($ModuleViewFolder.'.js.index')



@endsection



