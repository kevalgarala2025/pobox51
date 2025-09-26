@php
	$Validations = [];
	$ValidationAttr = '';
@endphp

@if($Setting['j_validation'] != "")
	@php
		$Validations = json_decode($Setting['j_validation'],true);
	@endphp
	@if(count($Validations))
		@foreach($Validations as $ValidationKey => $ValidationValue)
			@php
            	$ValidationAttr .= ' '.$ValidationValue['attr'].'='.$ValidationValue['val'];
            @endphp
		@endforeach
	@endif
@endif

<div class="form-group row {{$Setting->v_key}}">
    <label for="{{$Setting->v_key}}" class="col-md-5 col-form-label">
    	{{$Setting->v_label}}
    	@if($Setting['e_is_required'] == "Yes")
			<span class="required"> * </span>
		@endif
    </label>
    <div class="col-md-7">
        <input {{$ValidationAttr}} name="{{$Setting->v_key}}" class="form-control" type="date" value="{{$Setting->t_value}}" required="{{($Setting['e_is_required'] == 'Yes'?'required':'')}}"  id="{{$Setting->v_key}}">

        <div class="invalid-feedback">
            Please select a {{$Setting->v_label}}.
        </div>
    </div>
</div>