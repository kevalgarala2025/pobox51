 <!-- Header Start -->
 <header>

    <div class="line-image-first d-none d-lg-block"></div>
    <div class="line-image-second d-none d-lg-block">
         <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'second_row.svg') }}" alt="second row" class="img-fluid">
    </div>


    <nav class="navbar navbar-expand-lg desktop-header">
         <div class="container-fluid">
             <div class="navbar-collapse justify-content-end">
                 <ul class="navbar-nav poppins-medium">
                     <!-- Moblie And Tablet Menu start -->
                     <div class="nav_moblie">
                         <a class="nav-link dropdown-toggle d-lg-none" id="navbarDropdown" role="button"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <img src="{{ asset(FRONTEND_IMAGE_FOLDER_PATH . 'main_logo.svg') }}" alt="Mobile_logo"
                                 class="mobile_logo">
                             <i class="fas fa-chevron-down"></i>
                         </a>
                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" data-toggle="modal" data-target="#how_it_work_modal">How it
                                 Works</a>
                            <!-- <a class="dropdown-item" data-toggle="modal" data-target="#about_us_modal">About Us</a> -->
                            <!-- <a class="dropdown-item" data-toggle="modal" data-target="#contact_us_modal">Contact Us</a> -->
                            <a class="dropdown-item" data-toggle="modal" data-target="#why_pobox51_modal">Why
                                 POBox51</a>
                         </div>
                     </div>
                     <!-- Moblie And Tablet Menu End -->
                     <li class="nav-item d-none d-lg-block">
                         <a class="nav-link" data-toggle="modal" data-target="#how_it_work_modal">How it Works</a>
                     </li>

                     <!-- <li class="nav-item d-none d-lg-block">
                         <a class="nav-link" data-toggle="modal" data-target="#about_us_modal">About Us</a>
                     </li> -->
                     <!-- <li class="nav-item d-none d-lg-block">
                         <a class="nav-link" data-toggle="modal" data-target="#contact_us_modal">Contact Us</a>
                     </li> -->

                     <li class="nav-item d-none d-lg-block">
                         <a class="nav-link" data-toggle="modal" data-target="#why_pobox51_modal">Why POBox51</a>
                     </li>

                 </ul>
             </div>
         </div>
    </nav>
 </header>
 <!-- Header End -->
