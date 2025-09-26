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
									<th>Template Name</th>
									<th>Subject</th>
									<th>From Email</th>
									<!-- <th data-priority="2">Status</th> -->
									<th data-priority="3">Created At</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
									@if(!empty($Records) && $Records->count())
										@foreach($Records as $Record)
											<tr>
												<td>{{ $Record->v_template_name }}</td>
												<td>{{ $Record->v_subject }}</td>
												<td>{{ $Record->v_from_email_id }}</td>
												<!-- <td>
											 		<div>
					                                    <input class="status_action" type="checkbox" action_url="{{ route($RoutePrefixName.'.status',$Record->id) }}" id="switch{{$Record->id}}"  switch="bool" @if($Record->e_status == 'Active') checked @endif/>
					                                    <label for="switch{{$Record->id}}" data-on-label="Active" data-off-label="Inactive"></label>
					                                </div>
												</td> -->
												<td>{{ \Carbon::parse($Record->created_at)->format(DATE_TIME_DISPLAY_FORMAT) }}</td>
												<td>
													<a href="{{ route($RoutePrefixName.'.edit',$Record->id) }}" class="btn btn-success waves-effect waves-light float-left m-1"><i class="fas fa-pencil-alt"></i> Edit</a>
													{{-- <form name="delete_action" id='delete_action_frm_{{$Record->id}}' action="{{ route($RoutePrefixName.'.destroy', $Record->id) }}" method="POST" class="float-left m-1">
														@csrf
														{{ method_field('DELETE') }}
														<button type="button" class="btn btn-danger delete_action" onclick="delete_action_confirm({{$Record->id}});"> <i class="fas fa-trash-alt"></i> Delete</button>
													</form> --}}
												</td>
											</tr>
										@endforeach
									@else
										<tr class="odd">
											<td valign="top" colspan="5" class="text-center">{{MSG_NO_RECORD_FOUND}}
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
