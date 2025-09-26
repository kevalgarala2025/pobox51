@extends($ViewFolder.'.layouts.master-without-nav')

@section('title')
{{$PageName}}
@endsection

@section('body')
<body>
@endsection

@section('content')
        <div class="home-btn d-none d-sm-block">
            <a href="index" class="text-dark"><i class="fas fa-home h2"></i></a>
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
                                            <h5 class="text-primary">{{$PageName}}</h5>
                                            <p>Enter your password to unlock the screen!</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ URL::asset('assets/images/profile-img.png')}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <a href="index">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ URL::asset('assets/images/logo.png')}}" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form novalidate="novalidate" method="post" name="lockscreen_login" class="form-horizontal needs-validation" action="{{route('lockscreen.login')}}">
                                        @csrf
                                        <input type="hidden" name="v_email_id" value="{{$User->v_email_id}}">
                                        <div class="user-thumb text-center mb-4">
                                            <img src="{{ URL::asset('assets/images/users/avatar-1.jpg')}}" class="rounded-circle img-thumbnail avatar-md" alt="thumbnail">
                                            <h5 class="font-size-15 mt-3">{{$User->v_name}}</h5>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="userpassword">Password</label>
                                            <input type="password" name="password" class="form-control" required id="userpassword" placeholder="Enter password">
                                            <div class="invalid-feedback">
                                                Please provide a password.
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row mb-0">
                                            <div class="col-12 text-right">
                                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Unlock</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <p>Not you ? return <a href="{{route('login')}}" class="font-weight-medium text-primary"> Sign In </a> </p>
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