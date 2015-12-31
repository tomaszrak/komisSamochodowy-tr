var xmlHttpobj

function WyslijDane() {
	xmlHttpobj = GetXmlHttpObject();
	var marka = document.form2.marka.value;
	var rodzajsilnika;
	var przebieg = document.form2.przebieg.value;
	var rokprodukcji = document.form2.rokprodukcji.value;
	var kolor = document.form2.kolor.value;
	var cena = document.form2.cena.value;
	var informacje = document.form2.informacje.value;
	var send = document.form2.send.value;

	for (var i=0; i < document.form2.rodzajsilnika.length; i++)
  {
		if (document.form2.rodzajsilnika[i].checked)
		{
			rodzajsilnika = document.form2.rodzajsilnika[i].value;
		}
  }
	
	var params="&marka="+marka;
	params+="&rodzajsilnika="+rodzajsilnika;
	params+="&przebieg="+przebieg;
	params+="&rokprodukcji="+rokprodukcji;
	if(kolor!='')
		params+="&kolor="+kolor;
	if(cena!='')	
		params+="&cena="+cena;
	if(informacje!='')	
		params+="&informacje="+informacje;
		
	params+="&send="+send;	
	
	xmlHttpobj.onreadystatechange = stateChanged;
	xmlHttpobj.open("POST", "../formularz_administracja.php");
	xmlHttpobj.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	xmlHttpobj.send(params);
}

function stateChanged() {
	if (xmlHttpobj.readyState <  4)
				document.getElementById("odp").innerHTML = "<img src='../img/load.gif' />";
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



