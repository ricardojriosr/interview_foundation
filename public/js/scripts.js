function getFromURL(thisURL) {
    var xmlhttp =  new XMLHttpRequest();
    var response;
    xmlhttp.open('GET', thisURL, false);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if(xmlhttp.status === 200 || xmlhttp.status == 0)
            {
                response = xmlhttp.responseText;
            }
        }
    }
    xmlhttp.send(null);
    return response;
}
