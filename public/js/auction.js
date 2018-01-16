var id;
try{
var xmlHttp=new XMLHttpRequest();
//document.getElementById("abc").innerHTML="<p>gsff</p>";
}
catch(e)
{
	alert("error in xml object");
}

var flag=1;
var c,bid;
function ab(){
	window.location.href="http://localhost:8000/profile";
}

function timedCount() {
	if(c<=0)
	{
		document.getElementById('bid_button').innerHTML="";
		alert("Auction Ended!!");
		setTimeout(function(){ ab() }, 2000);
	}
    document.getElementById("time").innerHTML= c;
    c = c - 1;

		setTimeout(function(){ timedCount() }, 1000);
}

function bid_update()
{
		if(xmlHttp.readyState==0 || xmlHttp.readyState==4)
		{
			bid=(document.getElementById('bidding_price1').innerHTML);

			//var xmlHttp=new XMLHttpRequest();
			xmlHttp.open("GET",'/getbidupdate/'+id,true);
			xmlHttp.onreadystatechange=handleServerResponse;
			xmlHttp.send(null);
		}
		else
		{
		setTimeout('bid_update()',1000);
		}

}

function handleServerResponse()
{
	//document.getElementById("abc").innerHTML=c;
	if(xmlHttp.readyState==4)
	{

		if(xmlHttp.status==200)
		{


			/*xmlResponse=xmlHttp.responseXML;
			xmlDocumentElement=xmlResponse.documentElement;
			new_data=xmlDocumentElement.firstChild.data.split(",");
			document.getElementById("abc").innerHTML=new_data[0]; */
			response=xmlHttp.responseText.split(",");
			if(bid!=response[0])
			{
				document.getElementById("bidding_price1").innerHTML=response[0];
				document.getElementById("bidder_name").innerHTML=response[1];
			}

			//alert(response[0]);
			//document.getElementById("abc").innerHTML=response;
			setTimeout('bid_update()',1000);
		}
		else
		{
			// alert("something went wrong");
		}
	}

}
