<div class="col-xl-12  mt-3 mb-3">

    <form action="" method="get" accept-charset="utf-8">

        <div class="row">

            <div class="col-sm-12 d-flex">

                

                <div class="col-12 col-sm-3 col-md-4 col-lg-4 col-xl-2">

                    <select  id="e_status" name="status" class="form-control select2">

                        <option value="">Select Status</option>

                        @foreach(getUsersStatus() as $key => $Status)

                        <option value="{{ $Status }}"  @if($Request->status ==  $Status) {{ 'selected' }} @endif>{{ $Status }}</option>

                        @endforeach

                    </select>

                </div>

                <div class="col-12 col-sm-3 col-md-4 col-lg-4 col-xl-2">

                  
                </div>

                <div class="col-12 col-sm-3 col-md-4 col-lg-4 col-xl-2">

                    

                </div>

                <div class="col-12 col-sm-3 col-md-4 col-lg-4 col-xl-2">

                    

                </div>

                <div class="col-12 col-sm-3 col-md-4 col-lg-4 col-xl-2">

                    <button type="submit" class="btn btn-primary">Submit</button>

                    <button class="btn btn-warning ml-2 reset_btn"><a href="{{ route($RoutePrefixName.'.index') }}" >Reset</a></button>

                </div>

            </div> 

        </div>

    </form>

</div> 