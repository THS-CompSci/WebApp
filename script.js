function getSize(num){
	return num*20;
}
jQuery(document).ready(function(){
	var tableString=jQuery(".tab").html();
	var index=tableString.indexOf("</tr>");
	//jQuery(".tab").html("<tr><td>Date</td><td>Test</td><td>Time</td></tr>");
	var strBeg=tableString.substring(0,index+5);
	var strEnd=tableString.substring(index+5);
	//var mid="<tr><td>Test</td><td>Test</td><td>Test</td></tr>";
	for(i=0;i<5;i++){
		strBeg+="<tr><td>a</td><td>a</td><td>a</td></tr>";
	}
	var ret=strBeg+strEnd;
	jQuery(".tab").html(ret);
});
