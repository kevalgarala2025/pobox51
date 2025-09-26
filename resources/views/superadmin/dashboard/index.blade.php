@extends($ViewFolder.'.layouts.master')

@section('title') Dashboard @endsection

@section('content')

    @component($ViewFolder.'.common-components.breadcrumb')
         @slot('title') Dashboard  @endslot
         @slot('li_1') Welcome to {{env('APP_NAME')}} Dashboard @endslot
    @endcomponent
          
    <div class="row">
        <!-- <div class="col-xl-4">
            <div class="card overflow-hidden">
                <div class="bg-soft-primary">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p>{{env('APP_NAME')}} Dashboard</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="{{ URL::asset('assets/images/profile-img.png')}}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="avatar-md profile-user-wid mb-4">
                                <img src="{{ URL::asset('assets/images/users/avatar-1.jpg')}}" alt="" class="img-thumbnail rounded-circle">
                            </div>
                            <h5 class="font-size-15 text-truncate">{{\Auth::user(GUARD_SUPERADMIN)->v_name}}</h5>
                            <p class="text-muted mb-0 text-truncate">{{\Auth::user(GUARD_SUPERADMIN)->v_email_id}}</p>
                        </div>

                        <div class="col-sm-8">
                            <div class="pt-4">
                                <div class="mt-4">
                                    <a href="{{route('profile')}}" class="btn btn-primary waves-effect waves-light btn-sm">Edit Profile <i class="mdi mdi-arrow-right ml-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div> -->


        <div class="col-xl-12">
            <div class="row">
                @if(isset($Dashboard['dashboardstastics']))
                    @foreach($Dashboard['dashboardstastics'] as $key => $stasticsdata)
                        <!-- <a href="{{$stasticsdata['link']}}"> -->
                            @component($ViewFolder.'.common-components.dashboard-widget')
                                @slot('link') {{$stasticsdata['link']}}  @endslot
                                @slot('label') {{$stasticsdata['label']}}  @endslot
                                @slot('count') {{$stasticsdata['count']}}  @endslot
                                @slot('icon') {{$stasticsdata['icon']}} font-size-24  @endslot
                            @endcomponent
                        <!-- </a> -->
                    @endforeach
                @endif
            </div>
            <!-- end row -->
        </div>
    </div>



    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                @if(isset($Dashboard['stasticscount']))
                    @foreach($Dashboard['stasticscount'] as $key => $stasticsdata)
                        <!-- <a href="{{$stasticsdata['link']}}"> -->
                            @component($ViewFolder.'.common-components.index-widget')
                                @slot('link') {{$stasticsdata['link']}}  @endslot
                                @slot('title') {{$stasticsdata['label']}}  @endslot
                                @slot('count') {{$stasticsdata['count']}}  @endslot
                                @slot('icon') {{$stasticsdata['icon']}} font-size-24  @endslot
                            @endcomponent
                        <!-- </a> -->
                    @endforeach
                @endif
            </div>
            <!-- end row -->
        </div>
    </div>

    <!-- end row -->
   
@endsection

@section('script')
       
@endsection