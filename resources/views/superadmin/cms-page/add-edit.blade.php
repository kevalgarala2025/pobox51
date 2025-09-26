@extends($ViewFolder.'.layouts.master')



@section('title') {{ config('app.name') }} | {{$Module}} @endsection



@section('css')

	@include($ViewFolder.'.layouts.css_components.forms')

@endsection

@section('content')

@component($ViewFolder.'.common-components.breadcrumb')

	@slot('link') {{route($RoutePrefixName.'.index')}} @endslot

	@slot('title') @if(isset($CMSPage)) <i class="bx bx-pencil"></i> @else <i class="bx bx-plus"></i> @endif {{$Module}} @endslot

	@slot('li_1') {{$Module}} @endslot

	@slot('li_2') @if(isset($CMSPage)) {{ $RecordEditModule }} @else {{ $RecordAddModule }} @endif @endslot

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

				<h4 class="card-title">{{$RecordModule}}</h4>

				@if(isset($CMSPage))

					{{ Form::model($CMSPage,['route'=>[$RoutePrefixName.'.update', $CMSPage->id], 'method'=>'PATCH','class'=>'needs-validation','novalidate'=>'novalidate']) }}

				@else

					{{ Form::open(['route'=>$RoutePrefixName.'.store', 'method'=>'POST','class'=>'needs-validation','novalidate'=>'novalidate']) }}

				@endif

				@csrf

					<div class="row">

                        <div class="col-md-6 offset-md-2 col-12">

                            <div class="row">

                                

                                <div class="col-lg-12 col-12">

                                    <div class="form-group">

                                        <label class="control-label">Title<span class="required"> * </span></label>

										{{ Form::text('v_name', old('v_name'), ['class' => 'form-control','required' => 'required']) }}

										<div class="invalid-feedback">

		                                    Please provide a title.

		                                </div>

                                    </div>

                                </div>

                                <div class="col-lg-12 col-12">

                                    <div class="form-group">

                                        <label class="control-label">Content<span class="required"> * </span></label>


										{{ Form::textarea('t_page_content', old('t_page_content'), ['class' => 'form-control t_page_content summernote','required' => 'required']) }}

										<div class="invalid-feedback">

		                                    Please provide a content.

		                                </div>

                                    </div>

                                </div>


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

