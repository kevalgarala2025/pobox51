<form name="search_perpagerecord_action_frm" id="search_perpagerecord_action_frm" action="{{    route($module_route_prefix.'.index') }}" method="GET">
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div>
                <label>Show 
                    <select id="perpage_show_action" name="perpage" class="custom-select custom-select-sm form-control form-control-sm w-50">
                        @foreach(getPerPageRecordList() as $key => $perpage)
                            <option {{ app('request')->input('perpage') == $perpage ? 'selected' : '' }} value="{{$perpage}}">{{$perpage}}</option>
                        @endforeach
                    </select> 
                </label>entries
            </div>
        </div>
        <div class="col-sm-12 col-md-8">
            <div  class="searchAlignBtn">
                <label>
                    <input type="search" value="{{app('request')->input('keyword')}}" id="search_action_keyword" name="keyword" class="form-control form-control-sm" placeholder="Enter Search Keyword">
                </label>
            
                <button type="button" id="search_action_btn" class="btn btn-primary waves-effect waves-light  btn-sm"><i class="fas fa-search"></i> Search</button>
            
                <a href="{{ route($module_route_prefix.'.index') }}" class="btn btn-danger waves-effect waves-light btn-sm"><i class="fas fa-undo-alt"></i> Reset</a>
            </div>
        </div>
    </div>
</form>