// $(document).click(function(){$("#searchResult").html("");});var req=null;
// function loadXMLDoc(url){
// 	try{req=new ActiveXObject("Msxml2.XMLHTTP");}
// catch(e){try{req=new ActiveXObject("Microsoft.XMLHTTP");}
// catch(oc){req=null;}}
// if(req==null && typeof XMLHttpRequest!="undefined"){req=new XMLHttpRequest();}
// if(req!=null){req.onreadystatechange=processChange;req.open("GET",url,true);req.send(null);}
// }
// function processChange(evt){if(req.readyState==4){if(req.status==200){getObject("searchResult").innerHTML=req.responseText;}}}
// function getObject(name){var ns4=(document.layers)?true:false;var w3c=(document.getElementById)?true:false;var ie4=(document.all)?true:false;if(ns4)return eval('document.'+ name);if(w3c)return document.getElementById(name);if(ie4)return eval('document.all.'+ name);return false;}
// window.onload=function(){getObject("q").focus();}