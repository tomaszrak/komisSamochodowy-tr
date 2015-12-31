var xmlHttpobj

function WyslijDane() {
	xmlHttpobj = GetXmlHttpObject();
        var send = document.form4.send.value;
	var i=0;
	params="&send=";


	for (i=0; i<document.getElementsByTagName("input").length; i++)
	{
		if (document.getElementsByTagName("input")[i].type == "checkbox") 
		{
			 if (document.getElementsByTagName("input")[i].checked) {
					params += document.getElementsByTagName("input")[i].name + "[]=" + 
							 document.getElementsByTagName("input")[i].value + "&";
			 } else {
					params += document.getElementsByTagName("input")[i].name + "[]=&";
			 }
		}
	}
	xmlHttpobj.onreadystatechange = stateChanged;
	xmlHttpobj.open("POST", "../formularz_usun_oferte.php");
	xmlHttpobj.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	xmlHttpobj.send(params);
}

function stateChanged() {
	if (xmlHttpobj.readyState <  4)
				document.getElementById("odp").innerHTML = "<img src='img/load.gif' />";
				
	if (xmlHttpobj.readyState == 4 || xmlHttpobj.readyState == "complete") {
		document.getElementById("odp").innerHTML=xmlHttpobj.responseText;
	}
}

function GetXmlHttpObject() {
	var request = null;
	if (window.XMLHttpRequest) {
		request = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		request=new ActiveXObject("Microsoft.XMLHTTP");
	}
	return request;
}	



