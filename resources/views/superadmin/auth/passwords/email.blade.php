@extends($ViewFolder.'.layouts.master-without-nav')

@section('title') {{ config('app.name') }} | {{$PageName}} @endsection

@section('body')
<body>
@endsection

@section('css')
    @include($ViewFolder.'.layouts.css_components.forms')
@endsection

@section('content')
    <div class="home-btn d-none d-sm-block">
        <a href="{{env('APP_URL')}}" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary"> {{$PageName}}</h5>
                                        <p>Re-Password with {{env('APP_NAME')}}.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ URL::asset('/assets/images/profile-img.png')}}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0"> 
                            <div>
                                <a href="{{url('index')}}">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ URL::asset('/assets/images/logo.png')}}" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="form-horizontal needs-validation" novalidate="novalidate" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                    <div class="form-group">
                                        <label for="v_email_id">Email</label>
                                        <input name="v_email_id" required type="email" class="form-control" @if(old('v_email_id')) value="{{ old('v_email_id') }}" @endif  id="v_email_id" placeholder="Enter email" autocomplete="email" autofocus>
                                        <div class="invalid-feedback">
                                            Please provide a registered email.
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-12 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <p>Remember It ? <a href="{{route('login')}}" class="font-weight-medium text-primary"> Sign In here</a> </p>
                        <p>© <script>document.write(new Date().getFullYear())</script> {{env('APP_NAME')}}. Created with <i class="mdi mdi-heart text-danger"></i> by {{DASHBOARD_CREATED_BY_TEXT}}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
   @include($ViewFolder.'.layouts.js_components.forms')
@endsection