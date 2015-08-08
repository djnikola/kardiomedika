function confirmation(message, location)
{
 var what_to = confirm(message);
 if (what_to == true)
 {
   window.location=location;
 }
 
}

function field_enable(id)
{
	document.getElementById(id).disabled = false;

}
function field_disable(id)
{
	document.getElementById(id).disabled = true;

}


		
		var Images = new Array();
		var curImage = 1;

		var slideKorak = 10;
		var zoomKorak = 50;
		
		imgWidth = 300;
		imgHeight = 185;
		
		function slideImage(key, holder, x)
		{
			
			objImgHolder = document.getElementById(holder);
		
			var curMargin = -parseInt(objImgHolder.style.marginLeft.slice(0,-2));
			
			var newMargin = (key-1) * 300 + (key-1) * 4;
			
			if(!x)	x = curMargin;
			

			if(key > curImage )
			{			
				x = x + slideKorak;
				if((newMargin - curMargin) <=slideKorak)
					x = x + (newMargin - curMargin) - slideKorak;
			}
			else
			{
				x = x - slideKorak;
				if((curMargin-newMargin) <=slideKorak)
					x = x - (curMargin-newMargin) + slideKorak;
			}	
				
			objImgHolder.style.marginLeft = "-" + x + "px";

			if( (key > curImage && x < newMargin) || (key < curImage && x > newMargin) )
				t = setTimeout("slideImage("+ key +", '"+holder+"' , " + x + ")", 1);
			else
				curImage = key;
		}