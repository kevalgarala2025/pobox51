<div class="col-xl-12  mt-3 mb-3">

    <form action="" method="get" accept-charset="utf-8">

        <div class="row">

            <div class="col-sm-12 d-flex">


                <div class="col-12 col-sm-3 col-md-4 col-lg-4 col-xl-2">

                    <select  id="event_status" name="event_status" class="form-control select2">
                        
                        <option  value="">Select Status</option>
                        
                        <option value="Active"  @if($Request->event_status ==  'Active') {{ 'selected' }} @endif>Active</option>

                        <option value="Completed"  @if($Request->event_status ==  'Completed') {{ 'selected' }} @endif>Completed</option>
                        
                    </select>

                </div>

                <div class="col-12 col-sm-3 col-md-4 col-lg-4 col-xl-2">

                    <select  id="user_id" name="user_id" class="form-control select2">

                        <option value="">Select User</option>

                        @foreach($Users as $Key => $User)

                            <option value="{{ $User->id }}"  @if($Request->user_id ==  $User->id) {{ 'selected' }} @endif>{{ $User->v_full_name }}</option>

                        @endforeach

                    </select>

                </div>

                <div class="col-12 col-sm-3 col-md-4 col-lg-4 col-xl-2 dates" >
                    <input max="{{CURRENT_DATE}}" type="date" name="start_date" placeholder="Select Start Date" value="{{ $Request->start_date }}" class="form-control cdates">
                </div>
                <div class="col-12 col-sm-3 col-md-4 col-lg-4 col-xl-2 dates" >
                    <input max="{{CURRENT_DATE}}" type="date" name="end_date" placeholder="Select End Date"  value="{{ $Request->end_date }}" class="form-control cdates">
                </div>
                <div class="col-12 col-sm-3 col-md-4 col-lg-4 col-xl-2">
                    <select ref_id="1" name="created_at_date_type" class="form-control select2" id="datefiltertype">
                        <option value="">Select Date Filter Type</option>
                        @php
                            $DateTypeFilterOptions =  getDateTypeFilterOptions();
                        @endphp
                        @foreach(array_merge($DateTypeFilterOptions,['custom'=>'Custom']) as $Key => $DateOption)
                            <option value="{{ $Key }}"  @if($Request->created_at_date_type == $Key) {{ 'selected' }} @endif>{{ $DateOption }}</option>
                        @endforeach
                    </select>
                </div>

               

                <div class="col-12 col-sm-3 col-md-4 col-lg-4 col-xl-2">

                    <button type="submit" class="btn btn-primary">Submit</button>

                    <button class="btn btn-warning ml-2 reset_btn"><a href="{{ route($RoutePrefixName.'.index') }}" >Reset</a></button>

                </div>

            </div> 

        </div>

        <br>

      



    </form>

</div> 