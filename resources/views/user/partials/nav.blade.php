 <nav class="nav-secondary d-flex gap-3 justify-content-center w-100"
     aria-label="Learn more about POBox51">
     <div class="d-flex gap-3 margin-top-nav-secondary">
         <a class="nav-secondary__button btn d-flex justify-content-center align-items-center" type="button"
             aria-describedby="how-it-works-desc" data-bs-toggle="modal" data-bs-target="#how_it_work_modal">
             <span class="nav-secondary__text text-label-1">{{ __('text.how_it_works') }}</span>
         </a>

         <a class="nav-secondary__button btn d-flex justify-content-center align-items-center" type="button"
             aria-describedby="why-pobox-desc" data-bs-toggle="modal" data-bs-target="#why_pobox51_modal">
             <span class="nav-secondary__text text-label-1">{{ __('text.why_pobox51') }}</span>
         </a>
     </div>


     <span id="how-it-works-desc" class="visually-hidden">{{ __('text.learn_how_it_works') }}</span>
     <span id="why-pobox-desc" class="visually-hidden">{{ __('text.discover_benefits') }}</span>
 </nav>
