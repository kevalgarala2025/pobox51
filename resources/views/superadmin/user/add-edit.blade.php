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

					{{ Form::model($Record,['route'=>[$RoutePrefixName.'.update', $Record->id], 'method'=>'PATCH','class'=>'needs-validation','novalidate'=>'novalidate','autocomplete'=>'on','enctype'=>'multipart/form-data']) }}

				@else

					{{ Form::open(['route'=>$RoutePrefixName.'.store', 'method'=>'POST','class'=>'needs-validation','novalidate'=>'novalidate','autocomplete'=>'on','enctype'=>'multipart/form-data']) }}

				@endif

				@csrf

					<div class="row">

                        <div class="col-md-4 offset-md-4 col-12">

                            <div class="row">        

                                <div class="col-lg-12 col-12">

                                    <div class="form-group">

                                        <label class="control-label">First Name<span class="required"> * </span></label>

										{{ Form::text('v_first_name', old('v_first_name'), ['class' => 'form-control','required' => 'required']) }}

										<div class="invalid-feedback">

		                                    Please provide a first name.

		                                </div>

                                    </div>

                                </div>

                                <div class="col-lg-12 col-12">

                                    <div class="form-group">

                                        <label class="control-label">Middle Name<span class="required"> * </span></label>

										{{ Form::text('v_middle_name', old('v_middle_name'), ['class' => 'form-control','required' => 'required']) }}

										<div class="invalid-feedback">

		                                    Please provide a middle name.

		                                </div>

                                    </div>

                                </div>

                                <div class="col-lg-12 col-12">

                                    <div class="form-group">

                                        <label class="control-label">Last Name<span class="required"> * </span></label>

										{{ Form::text('v_last_name', old('v_last_name'), ['class' => 'form-control','required' => 'required']) }}

										<div class="invalid-feedback">

		                                    Please provide a last name.

		                                </div>

                                    </div>

                                </div>
                                

                                <div class="col-lg-12 col-12">

                                    <div class="form-group">

                                        <label class="control-label">Email<span class="required"> * </span></label>

										{{ Form::text('v_email', old('v_email'), ['class' => 'form-control','required' => 'required']) }}

										<div class="invalid-feedback">

		                                    Please provide a Email.

		                                </div>

                                    </div>

                                </div>



                                <div class="col-lg-12 col-12">

                                    <div class="form-group">

                                        <label class="control-label">Mobile Number<span class="required"> * </span></label>

										{{ Form::text('v_phone_no', old('v_phone_no'), ['class' => 'form-control','required' => 'required']) }}

										<div class="invalid-feedback">

		                                    Please provide a Mobile Number.

		                                </div>

                                    </div>

                                </div>


                                <div class="col-lg-12 col-12">

                                    <div class="form-group">

                                        <label class="control-label">Profle Pic</label>

                                        @if(isset($Record))

	                                        @if(isset($Record->v_profile_pic))

	                                        	<br><img src="{{ $Record->v_profile_pic_path }}" class="img-thumbnail img-responsive img-emp">

	                                        @else

												<img src="{{ env('APP_URL').DEFAULT_FILE_PATH.'default-avatar.png' }}" class="img-thumbnail img-responsive img-emp"/>

	                                        @endif

	                                    @endif

                                        <input name="v_profile_pic" type="file" class="form-control" accept='image/png, image/jpeg'>

										<div class="invalid-feedback">

		                                    Please provide a Profile Pic.

		                                </div>

                                    </div>

                                </div>


                                <!-- <div class="col-lg-12">

									<div class="form-group">

			                            <label class="control-label ">Password <br /><span style="font-size: 11px; color: red;">(Note: Password and Confirm Password both must be same) </span></label>

			                            @if(isset($Record))

			                            	<input type="password" name="v_password" id="password" class="form-control" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.cpassword.pattern = this.value;" placeholder="Password" >

			                            @else

			                            	<input type="password" name="v_password" id="password" class="form-control" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.cpassword.pattern = this.value;" placeholder="Password" required>

			                            @endif

			                        </div>

			                    </div>



			                    <div class="col-lg-12">

			                        <div class="form-group">

			                            <label class="control-label ">Confirm Password </label>

			                            @if(isset($Record))

			                             	<input type="password" name="cpassword" id="cpassword" class="form-control" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" placeholder="Verify Password">

			                            @else

			                            	<input type="password" name="cpassword" id="cpassword" class="form-control" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" placeholder="Confirm Password" required>

			                            @endif

			                        </div>

		                        </div>  -->

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

    @include($ModuleViewFolder.'.js.index')

@endsection

