/**
     * Fills a given table with rows
     * 
	 * ind - the index of the table
	 * tables - the number of rows to fill the table with
	 * fillText - the text to fill each row with
     */
function getTable(ind, tables, fillText){
	//Gets the HTML of the table with the given class 'ind'
	var tableString=jQuery(ind).html();
	//Gets the index of the end of the table and splits the html into two parts, the generated rows go in between both strings
	var index=tableString.indexOf("</tr>");
	var strBeg=tableString.substring(0,index+5);
	var strEnd=tableString.substring(index+5);
	//Fills up the rows
	for(i=0;i<tables;i++){
		strBeg+="<tr><td>"+fillText+"</td><td>"+fillText+"</td><td>"+fillText+"</td></tr>";
	}
	return strBeg+strEnd;
}

jQuery(document).ready(function(){
	var ret=getTable("#tb1",prompt("Number of rows"),prompt("Fill Text"));
	jQuery(".tab").html(ret);
});
