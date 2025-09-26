@extends($ViewFolder.'.layouts.master')



@section('title') {{ config('app.name') }} | {{$Module}} @endsection



@section('css')

	@include($ViewFolder.'.layouts.css_components.forms')

@endsection

@section('content')

   	@component($ViewFolder.'.common-components.breadcrumb')
		 @slot('title') {{$Module}} @endslot
		 @slot('li_1') Dashboard @endslot
		 @slot('li_2') {{$Module}} @endslot
	@endcomponent

	<div class="row">
	    <div class="col-lg-12">
	        <div class="card">
	            <div class="card-body">

	                <h4 class="card-title">{{$Module}} Tabs</h4>
	                <p class="card-title-desc">Admin can manage project setting</p>

	                <div class="row">
	                    <div class="col-md-3">
	                        @if(!empty($Types))
	                        	<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		                        	@foreach($Types as $Key => $Type)

		                        		<a class="nav-link mb-2 {{ (( $SelectedType == '' && $Key == 0 ) || $SelectedType == $Type['e_type']  ?'active':'') }}" id="{{$Type['e_type']}}-tab" data-toggle="pill" href="#{{$Type['e_type']}}" role="tab" aria-controls="{{$Type['e_type']}}" aria-selected="{{ (( $SelectedType == '' && $Key == 0 ) || $SelectedType == $Type['e_type']  ?'true':'false') }}">{{$Type['e_type']}}</a>
		                        	@endforeach
	                        	</div>
	                        @endif
	                      
	                    </div>
	                    <div class="col-md-9">
	                        @if(!empty($Types))
	                        	
		                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
		                            @foreach($Types as $Key => $Type)
			                            @if(isset($Type['tabs']))
			                            	@if(count($Type['setting_tabs']))
				                            	<div class="tab-pane fade {{ (( $SelectedType == '' && $Key == 0 ) || $SelectedType == $Type['e_type']  ?'show':'') }} {{ (( $SelectedType == '' && $Key == 0 ) || $SelectedType == $Type['e_type']  ?'active':'') }}" id="{{$Type['e_type']}}" role="tabpanel" aria-labelledby="{{$Type['e_type']}}-tab">

				                            		<ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
				                            			@foreach($Type['setting_tabs'] as $TabKey => $SettingTab)
												        <li class="nav-item">
												            <a class="nav-link {{$TabKey == 0 ? 'active':''}}" data-toggle="tab" href="#tabsetting_{{$Type['e_type']}}_{{$TabKey}}" role="tab">
												                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
												                <span class="d-none d-sm-block">{{$SettingTab}}</span> 
												            </a>
												        </li>
												        @endforeach
												    </ul>
												    {{ Form::open(['route'=>[$RoutePrefixName.'.store',['type'=>$Type['e_type']]], 'method'=>'POST','class'=>'needs-validation','novalidate'=>'novalidate','enctype'=>'multipart/form-data']) }}
				                                	@csrf
												    <!-- Tab panes -->
												    <div class="tab-content p-3 text-muted">
												    	@foreach($Type['tabs'] as $TabKey => $SettingTab)
													        <div class="tab-pane {{$TabKey == 0 ? 'active':''}}" id="tabsetting_{{$Type['e_type']}}_{{$TabKey}}" role="tabpanel">
													           
													           @include($IncludeViewFolder.'.form_elements',['Settings'=>$SettingTab['settings'],'Type' => $Type])

													        </div>
												        @endforeach
												    </div>

												    <div class="col-lg-12 text-center">
					                                    <div class="form-group">
					                                        {{ Form::submit('Update Settings', ['class'=>'btn btn-primary']) }}
					                                    </div>
					                                </div>
				                                	{{ Form::close() }}

				                            	</div>
				                            @endif
			                            @else

				                            <div class="tab-pane fade {{ (( $SelectedType == '' && $Key == 0 ) || $SelectedType == $Type['e_type']  ?'show':'') }} {{ (( $SelectedType == '' && $Key == 0 ) || $SelectedType == $Type['e_type']  ?'active':'') }}" id="{{$Type['e_type']}}" role="tabpanel" aria-labelledby="{{$Type['e_type']}}-tab">
				                                {{ Form::open(['route'=>[$RoutePrefixName.'.store',['type'=>$Type['e_type']]], 'method'=>'POST','class'=>'needs-validation','novalidate'=>'novalidate','enctype'=>'multipart/form-data']) }}
				                                @csrf
				                                	
				                                	@include($ModuleViewFolder.'.include.form_elements',['Settings'=>$Type['settings'],'Type' => $Type])
					                                
					                                <div class="col-lg-12 text-center">
					                                    <div class="form-group">
					                                        {{ Form::submit('Update Settings', ['class'=>'btn btn-primary']) }}
					                                    </div>
					                                </div>

				                                {{ Form::close() }}
				                            </div>
				                        @endif
			                        @endforeach
		                        </div>
		                    @endif
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- end card -->
	    </div>
	</div>

@endsection

@section('script')

   @include($ViewFolder.'.layouts.js_components.forms')
   @include($ModuleViewFolder.'.js.index')

@endsection


