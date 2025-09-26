@extends($ViewFolder.'..layouts.master')

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
                {{ Form::model($User,['route'=>['changepassword'], 'method'=>'POST','class'=>'needs-validation','novalidate'=>'novalidate']) }}
                @csrf
                    <div class="row">
                        <div class="col-md-4 offset-md-4 col-12">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Password<span class="required"> * </span></label>
                                        {{ Form::password('password',['class' => 'form-control','required' => 'required','id'=>'password']) }}
                                        <div class="invalid-feedback">
                                            Please provide a password.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Confirm Password<span class="required"> * </span></label>
                                        {{ Form::password('password_confirmation',['class' => 'form-control','required' => 'required','id'=>'password_confirmation']) }}
                                        <div class="invalid-feedback">
                                            Please provide a confirm password.
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
