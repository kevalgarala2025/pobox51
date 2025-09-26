 <!-- start page title -->
 <div class="row">
     <div class="col-12">
         <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ $title }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">
                        @if(isset($link))
                            <a href="{{ $link }}">{{ $li_1 }}</a>
                        @else
                            {{ $li_1 }}
                        @endif
                    </li>
                    @if(isset($li_2))
                        <li class="breadcrumb-item">{{ $li_2 }}</li>
                    @endif
                </ol>
            </div>
         </div>
     </div>
 </div>
 <!-- end page title -->