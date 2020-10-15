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

function postToURL(thisURL) {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = true;
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4) {
            console.log(this.responseText);
        }
    });
    xhr.open("POST", thisURL);
    xhr.send();
}
