function loadXMLDoc(idIn)
{
    var xmlhttp;
    if (window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    }
    else
    {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function()
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            //console.log("The value of id is " + idIn);
        }
    }
    //console.log("viewUpdate.php?id="+ idIn);
    xmlhttp.open("GET","viewUpdate.php?id="+ idIn,true);
    xmlhttp.send();
}
