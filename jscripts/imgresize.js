function imgresize(idName,i)
{
var imge = document.getElementById(idName).getElementsByTagName('img')[0];
var w=imge.width;
var h=imge.height;

if(h>w)
{
	document.getElementById(idName).getElementsByTagName('img')[0].style.width="180px";
}

if(h<w)
{
	document.getElementById(idName).getElementsByTagName('img')[0].style.width="300px";
}
alert("test");

document.write(w);

}
/* 
imgresize("scrnShts");
imgresize("mScrsht");

*/