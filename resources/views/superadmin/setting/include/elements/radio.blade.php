<div class="form-group row {{$Setting->v_key}}">
    <label for="{{$Setting->v_key}}" class="col-md-5 col-form-label">
    	{{$Setting->v_label}}
    	@if($Setting['e_is_required'] == "Yes")
			<span class="required"> * </span>
		@endif
    </label>
    <div class="col-md-7">
       	
       	@php
        	$Options = []; 
        @endphp

        @if($Setting['j_form_values'] != "")
    		@php
    			$Options = json_decode($Setting['j_form_values'],true);
    		@endphp
    	@endif
    		
    	@php
    		$HideShowClass = '';
    	@endphp
    	@if(count($HideSettingsValues))
    		@php
    			$HideShowClass = 'hide_show_element';
    		@endphp
    	@endif

    	@if(count($Options))

    		@foreach($Options as $RadioOptionKey => $RadioValue)
        		@php
            		$HideShowAttr = '';
            	@endphp
            	@if($HideShowClass != '')
            		@php
            			$HideShowAttr = implode(',',$HideSettingsValues[$HideShowCurrentValue]);
            		@endphp
            	@endif
        		<div class="custom-control custom-radio mb-3">
                    <input hide_show_current_value="{{$HideShowCurrentValue}}"  hide_show_divs="{{$HideShowAttr}}"  value="{{$RadioValue}}" {{ ($RadioValue == $Setting['t_value']?'checked':'') }}   type="radio" id="{{$Setting['v_key'].$RadioValue}}" name="{{$Setting['v_key']}}" class="custom-control-input {{$HideShowClass}}">
                    <label class="custom-control-label" for="{{$Setting['v_key'].$RadioValue}}">{{$RadioValue}}</label>
                </div>
            @endforeach

    	@endif
       	
    </div>
</div>