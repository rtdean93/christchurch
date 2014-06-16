function setCookie(c_name,value,expiredays)
{
var exdate=new Date()
exdate.setDate(exdate.getDate()+expiredays)
document.cookie=c_name+ "=" +escape(value)+
((expiredays==null) ? "" : ";expires="+exdate)
}

function getCookie(c_name)
{
if (document.cookie.length>0)
  {
  c_start=document.cookie.indexOf(c_name + "=")
  if (c_start!=-1)
    { 
    c_start=c_start + c_name.length+1 
    c_end=document.cookie.indexOf(";",c_start)
    if (c_end==-1) c_end=document.cookie.length
    return unescape(document.cookie.substring(c_start,c_end))
    } 
  }
return null
}

function toggleClock()
{
	var clock = document.getElementById('clock');
	if( getCookie("timeformat") == "12" )
	{
		setCookie("timeformat","24",30);
		clock.innerHTML = getClock24();
	}
	else
	{
		setCookie("timeformat","12",30);
		clock.innerHTML = getClock12();
	}
}

function getClock24()
{
	var today=new Date();
	var h=today.getHours();
	var m=today.getMinutes();
	
	if (h < 10)
		h = "0"+h.toString();
	if (m < 10)
		m = "0"+m.toString();
	
	return h+":"+m;
}

function getClock12()
{
	var today=new Date();
	var htmp=today.getHours();
	var m=today.getMinutes();
	if (htmp > 12) 
		var h = htmp - 12;
	else
		var h = htmp;
		
	if (h < 10)
		h = "0"+h.toString();
	if (m < 10)
		m = "0"+m.toString();
		
	if (htmp <= 12)
		return h+":"+m+" am";
	else
		return h+":"+m+" pm";
}

function initclock()
{
	var clock = document.getElementById('clock');
	if( getCookie("timeformat") == "12" )
		clock.innerHTML = getClock12();
	else
		clock.innerHTML = getClock24();
}
