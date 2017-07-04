function setFocus()
{
	var fieldSelected = false;
	
	for(var x = 0; x < document.getElementsByName("first_lap").length; x++)
	{
		if(document.getElementsByName("first_lap")[x].value == '')
		{
			document.getElementsByName("first_lap")[x].focus();
			fieldSelected = true;
			break;
		}
	}
	
	if(fieldSelected == false)
	{
		for(var x = 0; x < document.getElementsByName("second_lap").length; x++)
		{
			if(document.getElementsByName("second_lap")[x].value == '')
			{
				document.getElementsByName("second_lap")[x].focus();
				break;
			}
		}
	}
}