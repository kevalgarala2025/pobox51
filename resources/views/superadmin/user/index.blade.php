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

						

						<!-- <a href="{{ route($RoutePrefixName.'.create') }}" class="btn btn-success mb-1"><i class="fas fa-plus"></i> {{$RecordAddModule}}</a> -->



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

									<th>Name</th>

									<th>Mobile Number</th>

									<th>Email</th>

									<th>Total Events</th>

									<th data-priority="2">Profile Pic</th>

									<th data-priority="3">Status</th>

									<th data-priority="4">Created At</th>

									<th>Action</th>

								</tr>

								</thead>

								<tbody>

									@if(!empty($Records) && $Records->count())

										@foreach($Records as $key => $Record)

											<tr>

												<td>

													{{ $Record->v_full_name }}

												</td>

												<td>{{ $Record->v_phone_no }}</td>

												<td>{{ $Record->v_email }}</td>

												<td>
													<div class="tag-design-1 red-tag-bg border-r-10">{{$Record->i_user_event_count}}</div>
												</td>

												<td>
													@if(isset($Record->v_profile_pic))
														<img src="{{ $Record->v_profile_pic_path }}" class="img-thumbnail img-responsive img-emp" />
													@else
														<img src="{{ env('APP_URL').DEFAULT_FILE_PATH.'default-avatar.png' }}" class="img-thumbnail img-responsive img-emp"/>
													@endif
												</td>

												<td>

											 		<div>

					                                    <input class="status_action" type="checkbox" action_url="{{ route($RoutePrefixName.'.status',$Record->id) }}" id="switch{{$key}}"  switch="bool" @if($Record->e_status == 'Active') checked @endif/>

					                                    <label for="switch{{$key}}" data-on-label="Active" data-off-label="Inactive"></label>

					                                </div>

												</td>

											 	<td>{{ \Carbon::parse($Record->created_at)->format(DATE_TIME_DISPLAY_FORMAT) }}</td>

												<td>

													<a href="{{ route($RoutePrefixName.'.show',$Record->id) }}" class="btn btn-warning waves-effect waves-light float-left m-1"><i class="fas fa-eye"></i> View</a>

													<a href="{{ route($RoutePrefixName.'.edit',$Record->id) }}" class="btn btn-success waves-effect waves-light float-left m-1"><i class="fas fa-pencil-alt"></i> Edit</a>

													<form name="delete_action" id='delete_action_frm_{{$Record->id}}' action="{{ route($RoutePrefixName.'.destroy', $Record->id) }}" method="POST" class="float-left m-1">

														@csrf

														{{ method_field('DELETE') }}

														<button type="button" class="btn btn-danger delete_action" onclick="delete_action_confirm({{$Record->id}});"> <i class="fas fa-trash-alt"></i> Delete</button>

													</form>

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

@endsection

