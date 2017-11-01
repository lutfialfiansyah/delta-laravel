
	function SelectElement(valid,valueToSelect)
	{
		$(function(){
	    	$("#"+valid).val(valueToSelect).trigger('change');
		})
	}