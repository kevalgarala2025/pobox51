<!-- START HEADER -->
    <header class="fixed-top main-header">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand animation" href="{{route(ALIAS_USER.'index')}}" data-animation="fadeInDown" data-animation-delay="1s">
                    <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH.'logo.png') }}" alt="logo" class="logo">
                </a>
                <button class="navbar-toggler navbar-toggler-right animation collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" data-animation="fadeInDown" data-animation-delay="1.1s">
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">                     
                        <li class="animation nav-item" data-animation="fadeInDown" data-animation-delay="1.1s" class="nav-item">
                          <a class="nav-link page-scroll w700" href="#platform">Why?</a>
                        </li>
                        <li class="animation nav-item" data-animation="fadeInDown" data-animation-delay="1.2s">   
                          <a class="nav-link page-scroll w700" href="#annaTokens">About</a>
                        </li>
                        @if(\Auth::guard(GUARD_USER)->check())
                            <li class="animation nav-item" data-animation="fadeInDown" data-animation-delay="1.2s">   
                              <a class="nav-link page-scroll w700" href="{{route(ALIAS_USER.'logout')}}">Logout</a>
                            </li>
                        @endif
                    </ul>
                 </div>
            
            </nav>
        </div>
    </header>
<!-- END HEADER -->