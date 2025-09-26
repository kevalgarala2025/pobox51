@foreach($Settings as $SKey => $Setting)
	@php
    	$HideSettingsValues = [];
    	$HideShowCurrentValue = '';
    @endphp

	@if($Setting->j_hide_setting_values != "")
		@php
			$HideSettingsValues = json_decode($Setting->j_hide_setting_values,true);
			if(count($HideSettingsValues))
			{
				$HideShowCurrentValue = array_keys($HideSettingsValues)[0];
			}
		@endphp
	@endif

	@if($Setting->e_form_element_type == App\Models\Settings::FORM_ELEMENT_TYPE_TEXTBOX)

		@include($ElementIncludeViewFolder.'.textbox',['Setting'=>$Setting,'Type' => $Type])

    @elseif($Setting->e_form_element_type == App\Models\Settings::FORM_ELEMENT_TYPE_NUMBER)
		
		@include($ElementIncludeViewFolder.'.numberbox',['Setting'=>$Setting,'Type' => $Type])

	@elseif($Setting->e_form_element_type == 
	App\Models\Settings::FORM_ELEMENT_TYPE_SELECTBOX)
		
		@include($ElementIncludeViewFolder.'.selectbox',['Setting'=>$Setting,'Type' => $Type])

    @elseif($Setting->e_form_element_type == App\Models\Settings::FORM_ELEMENT_TYPE_DATE)
		
		@include($ElementIncludeViewFolder.'.date',['Setting'=>$Setting,'Type' => $Type])

	@elseif($Setting->e_form_element_type == App\Models\Settings::FORM_ELEMENT_TYPE_CHECKBOX)

		@include($ElementIncludeViewFolder.'.checkbox',['Setting'=>$Setting,'Type' => $Type])

	@elseif($Setting->e_form_element_type == App\Models\Settings::FORM_ELEMENT_TYPE_RADIO)

		@include($ElementIncludeViewFolder.'.radio',['Setting'=>$Setting,'Type' => $Type])

	@elseif($Setting->e_form_element_type == App\Models\Settings::FORM_ELEMENT_TYPE_TEXTAREA)

		@include($ElementIncludeViewFolder.'.textarea',['Setting'=>$Setting,'Type' => $Type])

	@elseif($Setting->e_form_element_type == App\Models\Settings::FORM_ELEMENT_TYPE_TEXTAREA_EDITOR)

		@include($ElementIncludeViewFolder.'.textarea_editor',['Setting'=>$Setting,'Type' => $Type])
		
	@endif

@endforeach