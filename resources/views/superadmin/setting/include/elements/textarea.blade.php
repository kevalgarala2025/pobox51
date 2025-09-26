<div class="form-group row {{$Setting->v_key}}">
    <label for="{{$Setting->v_key}}" class="col-md-5 col-form-label">
    	{{$Setting->v_label}}
    	@if($Setting['e_is_required'] == "Yes")
			<span class="required"> * </span>
		@endif
    </label>
    <div class="col-md-7">
        <textarea name="{{$Setting->v_key}}" class="form-control" required="{{($Setting['e_is_required'] == 'Yes'?'required':'')}}"  id="{{$Setting->v_key}}">{{$Setting->t_value}}</textarea>

        <div class="invalid-feedback">
            Please enter a {{$Setting->v_label}}.
        </div>

    </div>
</div>