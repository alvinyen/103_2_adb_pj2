<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>123</title>
<meta http-equiv="content-type" content="text/html" charset="UTF-8">
<script language="JavaScript" src="./resources/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="./resources/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
$(function() {
	$("input[name='btn']").on("click", function()
			
		{
			
			//alert("The paragraph was clicked.");
		    // Get the src of the image
		    ColIDD = $(this).attr("id");
			alert(ColIDD);
		    // Send Ajax request to backend.php, with src set as "img" in the POST data
		    // $.session.set("example",$(this).attr("id"));
		     //alert($.session.get("example"));
		    //$.post("reserv_second.php", {ColID: $(this).attr("id")},function(data){alert(data);});
		    // $.post("reserv_second.php");
		    $.ajax({
				type:"POST",
				url:"setSession.php",
				data:"ColID="+ColIDD,
				cache:false,
				success:function(msg){alert(msg);}
			    });
		    
		    //$.get( "reserv_second.php?ColID="+ColID);
		    //$.post("reserv_second.php",{});
		    //$.post("reserv_second.php", {ColID: "ColID"});
			javascript:location.href='reserv_second.php';

		    /*$(document).ready(function()
		    	    // window.location.href='./A/index.html'; // 跳转到A目录
		    	    location.href='reserv_second.php'; // 跳转到B目录
		    });*/
		});
   });
</script>
</head>
<body>
<!-- -->
<!-- <form id="target" name="form1" method="post" action="reserv_second.php" >-->
<table border="1" width=80%  cellspacing=5 cellpadding=16>
　<tr align=center>
　<td>書名</td><!-- 在書名之下出現預約按鈕-->
　<td>版本</td>
　<td>出版日期</td>
　<td>館藏類型</td>
　<td>館藏地</td>
　<td>狀態</td><!-- 預約人數-->
　<td>預約人數</td>
　</tr>

<?php
header ( "Content-Type:text/html; charset=utf-8" );
include "../link.php";

$sessionOrNot=true;

if($sessionOrNot){
	session_start ();
	$_SESSION ['username'] = "yamapi06150@gmail.com";
	$_SESSION ['password'] = "cestlavi";
}

function toUTF8($str){
		return iconv("Big5", "UTF-8", $str);
}

function date_normalizer($d){
	if($d instanceof  DateTime){
		return $d->getTimestamp();
	}else{
		return strtotime($d);
	}
}

//=====================================================================

$qsql="SELECT * FROM [Library].[dbo].[Collection]";
$stmt=sqlsrv_query($conn,$qsql);

$recno=0;
while($rec=sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
	echo "<tr align=center>";
	//echo "<td>".toUTF8($rec["ColID"])."</br>";
	echo "<td>". toUTF8($rec["ColName"])."</br>";
	
	//echo "<td>".toUTF8($rec["ColName"])."<input type=\"submit\" value=\"submit\" >";
	if($rec["ColStatus"]=="1"){
		$ColID=$rec["ColID"];
		echo "<input   name=\"btn\" type=\"submit\" value=\"預約\" id=\"$ColID\" >";
		//echo $ColID;
	}
	echo "<td>".$rec["ColVersion"];
	
	$tempDate=date_normalizer($rec["ColDate"]);
	$newDate = date("l dS F Y",$tempDate );
	//$newDate = DateTime::createFromFormat("l dS F Y", $rec["ColDate"]);
	//$newDate = $newDate->format('d/m/Y'); // for example
	
	echo "<td>".$newDate;
	echo "<td>".$rec["ColTypeID"];
	echo "<td>".$rec["ColLocation"];
	echo "<td>".$rec["ColStatus"];
	echo "<td>".$rec["ColResTimes"];
	echo "</tr>";
	$recno++;
}
if($stmt){
	//echo "OK";
}else{
	die( print_r( sqlsrv_errors(), true));
}
sqlsrv_free_stmt( $stmt);
sqlsrv_close( $conn);
?>
	</table>
<!--</form>-->
</body>
</html>