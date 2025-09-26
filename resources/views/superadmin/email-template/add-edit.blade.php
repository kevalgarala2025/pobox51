@extends($ViewFolder.'.layouts.master')

@section('title') {{ config('app.name') }} | {{$Module}} @endsection

@section('css')
	@include($ViewFolder.'.layouts.css_components.forms')
@endsection
@section('content')
@component($ViewFolder.'.common-components.breadcrumb')
	@slot('link') {{route($RoutePrefixName.'.index')}} @endslot
	@slot('title') @if(isset($Record)) <i class="bx bx-pencil"></i> @else <i class="bx bx-plus"></i> @endif {{$Module}} @endslot
	@slot('li_1') {{$Module}} @endslot
	@slot('li_2') @if(isset($Record)) {{ $RecordEditModule }} @else {{ $RecordAddModule }} @endif @endslot
@endcomponent
<div class="row">
	<div class="col-lg-12">
		@if($errors->any())
		<div class="alert alert-danger">
			<ul>
			@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
			</ul>
		</div>
		@endif
		<div class="card">
			<div class="card-body">
				
				@if(isset($Record))
					{{ Form::model($Record,['route'=>[$RoutePrefixName.'.update', $Record->id], 'method'=>'PATCH','class'=>'needs-validation','novalidate'=>'novalidate']) }}
				@else
					{{ Form::open(['route'=>$RoutePrefixName.'.store', 'method'=>'POST','class'=>'needs-validation','novalidate'=>'novalidate']) }}
				@endif
				@csrf
					<div class="row">
                        <div class="col-md-8 offset-md-2 col-12">
                            <div class="row">
                                
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Template Name<span class="required"> * </span></label>
										{{ Form::text('v_template_name', old('v_template_name'), ['class' => 'form-control','required' => 'required']) }}
										<div class="invalid-feedback">
		                                    Please provide a Name.
		                                </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Subject<span class="required"> * </span></label>
										{{ Form::text('v_subject', old('v_subject'), ['class' => 'form-control','required' => 'required']) }}
										<div class="invalid-feedback">
		                                    Please provide a Subject.
		                                </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label class="control-label">From Email (Readonly)<span class="required"> * </span></label>
										{{ Form::email('v_from_email_id', old('v_from_email_id'), ['class' => 'form-control','readonly'=>'readonly','required' => 'required']) }}

										<div class="invalid-feedback">
		                                    Please provide a From Email.
		                                </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Template Body<span class="required"> * </span></label>
										{{ Form::textarea('v_template_body', old('v_template_body'), ['class' => 'form-control t_page_content summernote','required' => 'required']) }}
										<div class="invalid-feedback">
		                                    Please provide a Template Body.
		                                </div>
                                    </div>
                                </div>
                                <p class="error"><strong> NOTE : Don't change the text of [].</strong></p>
                                <div class="col-lg-12 text-center">
                                    <div class="form-group">
                                        {{ Form::submit('Save', ['class'=>'btn btn-primary']) }}
										<a href="{{route($RoutePrefixName.'.index')}}">{{ Form::button('Cancel', ['class'=>'btn btn-secondary']) }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				{{ Form::close() }}
			</div>
		</div>
		<!-- end select2 -->
	</div>
</div>
<!-- end row -->
@endsection
@section('script')
   @include($ViewFolder.'.layouts.js_components.forms')
@endsection
