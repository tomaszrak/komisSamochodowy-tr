var xmlHttpobj

function WyslijDane() {
	xmlHttpobj = GetXmlHttpObject();
	var id = document.form3.id.value;
	var marka = document.form3.marka.value;
	var rodzajsilnika;
	var przebieg = document.form3.przebieg.value;
	var rokprodukcji = document.form3.rokprodukcji.value;
	var kolor = document.form3.kolor.value;
	var cena = document.form3.cena.value;
	var informacje = document.form3.informacje.value;
	var send = document.form3.send.value;

	for (var i=0; i < document.form3.rodzajsilnika.length; i++)
  {
		if (document.form3.rodzajsilnika[i].checked)
		{
			rodzajsilnika = document.form3.rodzajsilnika[i].value;
		}
  }
	
	var params="&id="+id;
	params+="&marka="+marka;
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
	xmlHttpobj.open("POST", "../formularz_aktualizacja.php");
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



