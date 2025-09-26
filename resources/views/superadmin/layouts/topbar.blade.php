<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-dark.png')}}" alt=""  height="17">
                    </span>
                </a>

                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo-light.png')}}" alt="" class="logoSize-sm">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-light.png')}}" alt="" style="width:100% !important" class="logoSize">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            
            <div class="dropdown dropdown-mega d-none d-lg-block ml-2">
                <button type="button" class="btn header-item waves-effect" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                    Mega Menu
                    <i class="mdi mdi-chevron-down"></i> 
                </button>
                <div class="dropdown-menu dropdown-megamenu">
                    <div class="row">
                        <div class="col-sm-3">
                
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 class="font-size-14 mt-0">Other Modules</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        
                                        <li>
                                            <a href="{{ route('users.index') }}">
                                                <span>Users</span>
                                            </a>
                                        </li>
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-4">
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-5">
                                    <div>
                                        <img src="{{ URL::asset('assets/images/megamenu-img.png')}}" alt="" class="img-fluid mx-auto d-block">
                                    </div>
                                </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-search-dropdown">
                    
                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>
           
           

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(isset(Auth::user(GUARD_SUPERADMIN)->v_profile_image))
                        <img src="{{ Auth::user(GUARD_SUPERADMIN)->v_profile_pic_path }}" class="rounded-circle header-profile-user">
                    @else
                        <img src="{{ env('APP_URL').DEFAULT_FILE_PATH.'default-avatar.png' }}" class="rounded-circle header-profile-user"/>
                    @endif
                    <span class="d-none d-xl-inline-block ml-1">{{\Auth::user(GUARD_SUPERADMIN)->v_name}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route('profile')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Edit Profile</a>
                    <a class="dropdown-item" href="{{route('changepassword')}}"><i class="bx bx-key font-size-16 align-middle mr-1"></i> Change Password</a>
                    <a class="dropdown-item" href="{{route('lockscreen')}}"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> Lock Screen</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> {{ __('Logout') }} </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

           <!--  <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="bx bx-cog bx-spin"></i>
                </button>
            </div> -->
            
        </div>
    </div>
</header>