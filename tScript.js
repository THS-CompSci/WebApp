/**
 * Fills a given table with rows
 *
 * ind - the index of the table
 * tables - the number of rows to fill the table with
 * fillText - the text to fill each row with
 */
//Could be used for generation of pages through QR codes. With this, the html can take variables from the URL and turn them into arrays.
//For example: parseURLParams("www.thshallpass.com?name=something") returns {name: ["something"]}
 
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
 
 
 
function getTable(ind, tables, fillText){
    //Gets the HTML of the table with the given class 'ind'
    var tableString=jQuery(ind).html();
    var row=0;
    for(i=0;i<tableString.length-4;i++){
        if(tableString.substring(i).indexOf("<tr>")===0){
            row++;
        }
    }
    //Gets the index of the end of the table and splits the html into two parts, the generated rows go in between both strings
    var index=tableString.lastIndexOf("</tr>");
    var strBeg=tableString.substring(0,index+5);
    var strEnd=tableString.substring(index+5);
    //Fills up the rows
    var month=Math.floor(Math.random() * 12) + 1;
    var day=Math.floor(Math.random() * 28) + 1;
    var date;
    if(month>9){
        date=month;
    }else{
        date="0"+month;
    }
    if(day>9){
        date+="/"+day;
    }else{
        date+="/0"+day;
    }
    var hour=Math.floor(Math.random()*12)+1;
    var minuteT=Math.floor(Math.random()*7);
    var minuteO=Math.floor(Math.random()*10);
    for(i=0;i<tables;i++){
        strBeg+="<tr><td>"+row+"</td><td>";
        strBeg+=date+"/16"+"</td><td>"+fillText+"</td><td>";
        strBeg+=hour+":"+minuteT+minuteO+"</td></tr>";
        row++;
    }
    return strBeg+strEnd;
}

function addRow(date, name, time){
    var ret=getTable("#tb1",1,"new time");
    jQuery("#tb1").html(ret);
}

function requestStudent(){
    var student=jQuery("#stuID").val();
    jQuery("#tit").text(student);
    //callPage('passHistory.php?student_id='+student,document.getElementById("testDisplay"));
    //The php has TEACHERID as the name
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
                //Sets the HTML of the given div to the response text
                div.innerHTML = ajax.responseText;
            }
        }
    }
    ajax.send(null);
}

jQuery(document).ready(function(){

});
