var xmlHttpobj
var tab = new Array();
function WyslijDane(przycisk) 
{
	xmlHttpobj = GetXmlHttpObject();
	var params='';
	var i=0;
	if(!tab[8])
		temp=''
	else
		temp="&aktualne_zdj="+tab[8];
	params+="&przycisk="+przycisk+temp;
	xmlHttpobj.onreadystatechange = stateChanged;
	xmlHttpobj.open("POST", "skrypty_sql/oferty.php");
	xmlHttpobj.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	xmlHttpobj.send(params);
}

function stateChanged() 
{
	if (xmlHttpobj.readyState <  4)
		document.getElementById("czekaj").innerHTML = "<img src='img/wait2.gif' />";
				
	if (xmlHttpobj.readyState == 4 || xmlHttpobj.readyState == "complete") 
	{
		//document.getElementById("obraz").innerHTML=xmlHttpobj.responseText;
		PrzetworzDane(xmlHttpobj.responseText);
	
		document.getElementById("czekaj").innerHTML=" ";
	}
}

function GetXmlHttpObject()
{
	var request = null;
	if (window.XMLHttpRequest) {
		request = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		request=new ActiveXObject("Microsoft.XMLHTTP");
	}
	return request;
}	

function PrzetworzDane(lancuch)
{ 
	
	tab=lancuch.split("##");
	document.getElementById("opis_poz1").innerHTML=tab[0];
	document.getElementById("opis_poz2").innerHTML=tab[1];
	document.getElementById("opis_poz3").innerHTML=tab[2];
	document.getElementById("opis_poz4").innerHTML=tab[3];
	document.getElementById("opis_poz5").innerHTML=tab[4];
	document.getElementById("opis_poz6").innerHTML=tab[5];
	document.getElementById("opis_poz7").innerHTML=tab[6];
	//tmp="<a type='button' value='Zdjecie' onClick="+'"'+"window.open("+"'"+tab[7]+"'"+",'Zdjecie','width=800,height=600,scrollbars=1')>";
	
	if(tab[7]=='Brak')
		document.getElementById("obraz_tresc").innerHTML="<img src='"+"img/brak.jpg"+"'/>";
	else
		document.getElementById("obraz_tresc").innerHTML="<img src='"+tab[7].replace("auta_oferty","miniaturki")+"'/>";
	document.getElementById("ilosc").innerHTML=tab[8]+"/"+tab[9];
}



