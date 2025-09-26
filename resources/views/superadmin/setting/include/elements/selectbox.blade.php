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
        	$SelectOptions = ['class' => 'form-control select2','id' =>	$Setting->v_key];
        @endphp

        @if($Setting['j_form_values'] != "")
    		@php
    			$Options = json_decode($Setting['j_form_values'],true);
    		@endphp
    	@endif

    	@if($Setting['e_is_required'] == "Yes")
        	@php
        		$SelectOptions['required'] = 'required';
        	@endphp
		@endif

        {{ Form::select($Setting->v_key,$Options,$Setting->t_value,$SelectOptions) }}

    </div>
</div>