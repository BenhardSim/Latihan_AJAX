function getXMLHTTPRequest(){
    if(window.XMLHttpRequest){
        return new XMLHttpRequest;
    }else{
        return new ActiveXObject('Microsoft.XMLHTTP');
    }
}


function add_customer_get(){
    let xmlhttp = getXMLHTTPRequest();
    let name = encodeURI(document.getElementById('name').value);
    let address = encodeURI(document.getElementById('address').value);
    let city = encodeURI(document.getElementById('city').value);

    // validate
    if(name != "" && address != "" && city != ""){
        let url = "add_customer_get.php?name=" + name + "&address=" + address + "&city=" + city;
        let inner = "add_response";
        xmlhttp.open('GET',url,true);
        xmlhttp.onreadystatechange = () => {
            document.getElementById(inner).innerHTML = '<p>Loading...</p>';
            if((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
                document.getElementById(inner).innerHTML = xmlhttp.responseText;
            }
            return false;
        }
        xmlhttp.send(null);
    }else{
        alert('Please fill all the fields');
    }
}

function edit_customer_get(id){
    let xmlhttp = getXMLHTTPRequest();
    let name = encodeURI(document.getElementById('name').value);
    let address = encodeURI(document.getElementById('address').value);
    let city = encodeURI(document.getElementById('city').value);

    // validate
    if(name != "" && address != "" && city != ""){
        let url = "edit_customer_get.php?name=" + name + "&address=" + address + "&city=" + city + "&id=" + id;
        let inner = "add_response";
        xmlhttp.open('GET',url,true);
        xmlhttp.onreadystatechange = () => {
            document.getElementById(inner).innerHTML = '<p>Loading...</p>';
            if((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
                document.getElementById(inner).innerHTML = xmlhttp.responseText;
            }
            return false;
        }
        xmlhttp.send(null);
    }else{
        alert('Please fill all the fields');
    }
}