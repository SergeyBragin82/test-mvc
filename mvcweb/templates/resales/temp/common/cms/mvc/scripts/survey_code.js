// JavaScript Document

if (location.protocol != 'https:')
{
 location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
}

function setSurveyCookies(){
	
	if(dojo.cookie("mvc_survey")!= undefined){
		var newValue = parseInt(dojo.cookie("mvc_survey")) + parseInt(1);
		dojo.cookie("mvc_survey", newValue, {path:"/",expires:30});
		if(newValue == 5){
		   
		   function mousedown (){
			    var currentDay = new Date();
				var month = currentDay.getMonth() + 1;
				var day = currentDay.getDate();
				var year = currentDay.getFullYear();
				
				var currentTime = new Date();
				var hours = currentTime.getHours();
				var minutes = currentTime.getMinutes();


			    var urlString = '/survey.html?popid=' + month + day + year + hours + minutes;
			    window.open(urlString,'MarriottSurvey','width=640,height=351,scrollbars=0');
				document.onclick = null;
		   }
		   
		   document.onclick = mousedown;
		}
	}else{
		dojo.cookie("mvc_survey", 1, {path:"/",expires:30});
	}
	
}


//dojo.addOnLoad(setSurveyCookies);