var id_lista=["menu_lista","menu_pod1","menu_pod2"];
var przesuniecie=-1;

function StworzMenu(){
for (var i=0; i<id_lista.length; i++)
{
	var listy=document.getElementById(id_lista[i]).getElementsByTagName("ul");
		for (var j=0; j<listy.length; j++)
		{
			listy[j].style.top=listy[j].parentNode.offsetHeight+przesuniecie+"px";
			var spanref=document.createElement("span");
			spanref.className="arrowdiv";
			spanref.innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;";
			listy[j].parentNode.getElementsByTagName("a")[0].appendChild(spanref);
			
			listy[j].parentNode.onmouseover=function()
			{
				this.getElementsByTagName("ul")[0].style.visibility="visible";
			}
			
			listy[j].parentNode.onmouseout=function()
			{
				this.getElementsByTagName("ul")[0].style.visibility="hidden";
			}
		}
	}
}

if (window.addEventListener)
	window.addEventListener("load", StworzMenu, false);
else if (window.attachEvent)
	window.attachEvent("onload", StworzMenu);