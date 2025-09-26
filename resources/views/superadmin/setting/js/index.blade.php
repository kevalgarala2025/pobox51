<script>
$(document).ready(function() 
{

	if($('.hide_show_element').length)
	{
		$('.hide_show_element').each(function(index) 
		{
			$(this).trigger('change');
		});
	}

    $(".hide_show_element").on('change',function(){
   		if($(this).val() != '')
   		{
   			var hide_show_divs = $(this).attr('hide_show_divs').split(',');
   			if($(this).attr('hide_show_current_value') == $(this).val())
	   		{
	   			$(($(this).attr('hide_show_divs')).split(',')).each(function(index) {
				  $('.'+hide_show_divs[index]).hide();
				  $('#'+hide_show_divs[index]).val('');
				});
	   		}
	   		else
	   		{
	   			$(($(this).attr('hide_show_divs')).split(',')).each(function(index) {
				  $('.'+hide_show_divs[index]).show();
				});	
	   		}
	   	}

   })
});

</script>