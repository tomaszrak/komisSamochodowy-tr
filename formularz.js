var xmlHttpobj

function WyslijDane() {
	xmlHttpobj = GetXmlHttpObject();
	var marka = document.getElementById("form1").marka.value;
	var rodzajsilnika;
	var przebieg = document.getElementById("form1").przebieg.value;
	var rokprodukcji = document.getElementById("form1").rokprodukcji.value;
	var kolor = document.getElementById("form1").kolor.value;
	var cena = document.getElementById("form1").cena.value;
	var informacje = document.getElementById("form1").informacje.value;
	var imienazw = document.getElementById("form1").imienazw.value;
	var telefon = document.getElementById("form1").telefon.value;
	var email = document.getElementById("form1").email.value;
	var send = document.getElementById("form1").send.value;

	for (var i=0; i < document.getElementById("form1").rodzajsilnika.length; i++)
  {
		if (document.getElementById("form1").rodzajsilnika[i].checked)
		{
			rodzajsilnika = document.getElementById("form1").rodzajsilnika[i].value;
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
		
	params+="&imienazw="+imienazw;
	params+="&telefon="+telefon;
	params+="&email="+email;	
	params+="&send="+send;	
	
	xmlHttpobj.onreadystatechange = stateChanged;
	xmlHttpobj.open("POST", "formularz.php");
	xmlHttpobj.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	xmlHttpobj.send(params);
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



