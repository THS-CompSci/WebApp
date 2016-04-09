//Could be used for generation of pages through QR codes. With this, the html can take variables from the URL and turn them into arrays.
//For example: parseURLParams("www.thshallpass.com?name=something") returns {name: ["something"]}
//-------This function should be moved to a separate file relating to the qr generation, but realistically doesn't need to exist
//-------as php can already read POST data from urls.
 function parseURLParams(url) {
    var queryStart = url.indexOf("?") + 1,
        queryEnd   = url.indexOf("#") + 1 || url.length + 1,
        query = url.slice(queryStart, queryEnd - 1),
        pairs = query.replace(/\+/g, " ").split("&"),
        parms = {}, i, n, v, nv;

    if (query === url || query === "") {
        return;
    }

    for (i = 0; i < pairs.length; i++) {
        nv = pairs[i].split("=");
        n = decodeURIComponent(nv[0]);
        v = decodeURIComponent(nv[1]);

        if (!parms.hasOwnProperty(n)) {
            parms[n] = [];
        }

        parms[n].push(nv.length === 2 ? v : null);
    }
    return parms;
}

function requestStudent(){
    var student=jQuery("#stuID").val();
    jQuery("#tit").text(student);
    //This line assumes that passHistory.php requires a 'student_name' parameter
    callPage('passHistory.php?student_name='+student,document.getElementById("testDisplay"));
}

function AjaxCaller(){
    //Sets up the xml file
    var xmlhttp=false;
    try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }catch(e){
        try{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch(E){
            xmlhttp = false;
        }
    }

    if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function callPage(url, div){
    ajax=AjaxCaller();
    //Requests with the specified url
    ajax.open("POST", url, true);
    ajax.onreadystatechange=function(){
        //Request is finished and the response is ready
        if(ajax.readyState==4){
            if(ajax.status==200){
                //Gets the response from the server and then updates the table based on it
				            var json=ajax.resposeText;
				            updateTable(json);
            }
        }
    }
    ajax.send(null);
}

function updateTable(jsonString){
	    try{
		    var json=jQuery.parseJSON(jsonString);
		    $("#table").bootstrapTable('load',json);
	    }catch(err){
		    document.getElementById("testDisplay").innerHTML=err;
	}
}

jQuery(document).ready(function(){

});
