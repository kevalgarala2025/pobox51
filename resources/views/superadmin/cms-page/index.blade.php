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

	<div class="row">

		<div class="col-12">

			<div class="card">

				<div class="card-body">

					



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

									
									<th data-priority="2">Name</th>

									<th data-priority="4">Status</th>

									<th data-priority="5">Updated At</th>

									<th>Action</th>

								</tr>

								</thead>

								<tbody>

								@if(!empty($Records) && $Records->count())

									@foreach($Records as $Record)

										<tr>

											
											<td>{{ $Record->v_name }}</td>

											<td>
												@if($Record->e_status == 'Active')
													<span class="badge badge-success">{{$Record->e_status}}</span>
												@else 
													<span class="badge badge-danger">{{$Record->e_status}}</span>
												@endif
											</td>

											<td>{{ \Carbon::parse($Record->updated_at)->format(DATE_TIME_DISPLAY_FORMAT) }}</td>

											<td>

												<a href="{{ route($RoutePrefixName.'.edit',$Record->id) }}" class="btn btn-success waves-effect waves-light float-left m-1"><i class="fas fa-pencil-alt"></i> Edit</a>

											</td>

										</tr>

									@endforeach

								@else

									<tr class="odd">

										<td valign="top" colspan="7" class="text-center">{{MSG_NO_RECORD_FOUND}}

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

