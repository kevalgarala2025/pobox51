<!-- ========== Left Sidebar Start ========== -->

<div class="vertical-menu">



    <div data-simplebar class="h-100">



        <!--- Sidemenu -->

        <div id="sidebar-menu">

            <!-- Left Menu Start -->

            <ul class="metismenu list-unstyled" id="side-menu">

                <li class="menu-title">Menu</li>

                <li class="{{ (request()->is(PREFIX_SUPERADMIN.'/dashboard*')) ? 'mm-active' : '' }}">

                    <a href="{{ route('dashboard') }}" class=" waves-effect {{ (request()->is(PREFIX_SUPERADMIN.'/dashboard*')) ? 'active' : '' }}">

                        <i class="bx bx-home-circle"></i>

                        <span>Dashboard</span>

                    </a>

                </li>


                <li class="{{ (request()->is(PREFIX_SUPERADMIN.'/users*')) ? 'mm-active' : '' }}">

                    <a href="{{ route('users.index') }}" class=" waves-effect {{ (request()->is(PREFIX_SUPERADMIN.'/users*')) ? 'active' : '' }}">

                        <i class="bx bx-user"></i>

                        <span>Users</span>

                    </a>

                </li>

                
                <li class="{{ (request()->is(PREFIX_SUPERADMIN.'/user-events*')) ? 'mm-active' : '' }}">

                    <a href="{{ route('user-events.index') }}" class=" waves-effect {{ (request()->is(PREFIX_SUPERADMIN.'/user-events*')) ? 'active' : '' }}">

                        <i class="bx bx-building-house"></i>

                        <span>User Events</span>

                    </a>

                </li>

                
               <li class="menu-title">Master Modules</li>

                <li class="{{ (request()->is(PREFIX_SUPERADMIN.'/cms-pages*') || request()->is(PREFIX_SUPERADMIN.'/email-templates*')) ? 'mm-active' : '' }}">

                    <a href="javascript: void(0);" class="has-arrow waves-effect {{ (request()->is(PREFIX_SUPERADMIN.'/cms-pages*') || request()->is(PREFIX_SUPERADMIN.'/email-templates*')) ? 'mm-active' : '' }}">

                        <i class="bx bx-layout"></i>
                        
                        <span>Master</span>
                        
                    </a>
                    
                    <ul class="sub-menu {{ (request()->is(PREFIX_SUPERADMIN.'/cms-pages*') || request()->is(PREFIX_SUPERADMIN.'/email-templates*') ) ? 'mm-show' : '' }}" aria-expanded="false">
                        
                        <li class="{{ (request()->is(PREFIX_SUPERADMIN.'/cms-pages*')) ? 'mm-active' : '' }}">

                            <a href="{{ route('cms-pages.index') }}" class=" waves-effect {{ (request()->is(PREFIX_SUPERADMIN.'/cms-pages*')) ? 'active' : '' }}">

                                <i class="bx bxs-notepad"></i>

                                <span>CMS Pages</span>

                            </a>

                        </li>

                        <li class="{{ (request()->is(PREFIX_SUPERADMIN.'/email-templates*')) ? 'mm-active' : '' }}">

                            <a href="{{ route('email-templates.index') }}" class=" waves-effect {{ (request()->is(PREFIX_SUPERADMIN.'/email-templates*')) ? 'active' : '' }}">

                                <i class="bx bxs-notepad"></i>

                                <span>Email Templates</span>

                            </a>

                        </li>


                    </ul>

                </li>


                <li class="{{ (request()->is(PREFIX_SUPERADMIN.'/setting*')) ? 'mm-active' : '' }}">
                    <a href="{{ route('setting.index') }}" class=" waves-effect {{ (request()->is(PREFIX_SUPERADMIN.'/setting*')) ? 'active' : '' }}">
                        <i class="bx bx-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>

                <li class="{{ (request()->is(PREFIX_SUPERADMIN.'/profile*')) ? 'mm-active' : '' }}">

                    <a href="{{ route('profile') }}" class=" waves-effect {{ (request()->is(PREFIX_SUPERADMIN.'/profile*')) ? 'active' : '' }}">

                        <i class="bx bxl-baidu"></i>

                        <span>Edit Profile</span>

                    </a>

                </li>



                <li>

                    <a href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class=" waves-effect">

                        <i class="bx bx-power-off"></i>

                        <span>Logout</span>

                    </a>

                </li>

                

        </div>

        <!-- Sidebar -->

    </div>

</div>

<!-- Left Sidebar End -->

