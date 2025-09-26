@extends($ViewFolder.'.layouts.master')

@section('title') {{ config('app.name') }} | {{$PageName}} @endsection

@section('css')
    @include($ViewFolder.'.layouts.css_components.forms')
@endsection
@section('content')
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
                <h4 class="card-title">{{$PageName}}</h4>
                {{ Form::model($User,['route'=>['profile'], 'method'=>'POST','class'=>'needs-validation','novalidate'=>'novalidate','enctype'=>'multipart/form-data']) }}
                @csrf
                    <div class="row">
                        <div class="col-md-4 offset-md-4 col-12">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Profle Pic</label>
                                        @if(isset($User))
                                            @if(isset($User->v_profile_image))
                                                <br><img src="{{ $User->v_profile_pic_path }}" class="img-thumbnail img-responsive img-emp">
                                            @else
                                                <img src="{{ env('APP_URL').DEFAULT_FILE_PATH.'default-avatar.png' }}" class="img-thumbnail img-responsive img-emp"/>
                                            @endif
                                        @endif
                                        <input name="v_profile_image" type="file" class="" accept='image/png, image/jpeg'>
                                        <div class="invalid-feedback">
                                            Please provide a Profile Pic.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Name<span class="required"> * </span></label>
                                        {{ Form::text('v_name', old('v_name'), ['class' => 'form-control','required' => 'required']) }}
                                        <div class="invalid-feedback">
                                            Please provide a name.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Email<span class="required"> * </span></label>
                                        {{ Form::email('v_email_id',old('v_email_id'), ['class' => 'form-control','required' => 'required']) }}
                                        <div class="invalid-feedback">
                                            Please provide a valid contact person email.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Mobile Number<span class="required"> * </span></label>
                                        {{ Form::number('v_mobile_number',old('v_mobile_number'), ['class' => 'form-control','required' => 'required']) }}
                                        <div class="invalid-feedback">
                                            Please provide a valid contact person mobile number.
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12 text-center">
                                    <div class="form-group">
                                        {{ Form::submit('Save', ['class'=>'btn btn-primary']) }}
                                        <a href="{{route('dashboard')}}">{{ Form::button('Cancel', ['class'=>'btn btn-secondary']) }}</a>
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
