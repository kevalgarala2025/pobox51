<div class="form-group row {{$Setting->v_key}}">
    <label for="{{$Setting->v_key}}" class="col-md-5 col-form-label">
    	{{$Setting->v_label}}
    	@if($Setting['e_is_required'] == "Yes")
			<span class="required"> * </span>
		@endif
    </label>
    <div class="col-md-7">
       	
       	@php
       		$Required = "";
        	$Options = [];
        	$SelectedOptions = [];
        @endphp

        @if($Setting['j_form_values'] != "")
    		@php
    			$Options = json_decode($Setting['j_form_values'],true);
    		@endphp
    	@endif

    	@if($Setting['t_value'] != "")
    		@php
    			$SelectedOptions = json_decode($Setting['t_value'],true);
    		@endphp
    	@endif

    	@if($Setting['e_is_required'] == "Yes")
    		@php
    			$Required = 'Required';
    		@endphp
    	@endif

    	@if(count($Options))

    		@foreach($Options as $RadioOptionKey => $RadioValue)
        		
        		<div class="custom-control custom-checkbox mb-3">
                    <input  {{$Required}} value="{{$RadioValue}}" name="{{$Setting['v_key']}}[]" type="checkbox" class="chkbox custom-control-input" id="{{$Setting['v_key'].$RadioValue}}" {{ ( count($SelectedOptions) && in_array($RadioValue,$SelectedOptions)?'checked':'') }} >
                    <label class="custom-control-label" for="{{$Setting['v_key'].$RadioValue}}">{{$RadioValue}}</label>
                </div>

            @endforeach

    	@endif
       	
    </div>
</div>