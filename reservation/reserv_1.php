<?php session_start(); ?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<?php 
include"../header.php";
include "link.php";
?>
<script language="JavaScript" src="resources/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="resources/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
$(function() {
	$("input[name='btn']").on("click", function()
			
		{
			
			//alert("The paragraph was clicked.");
		    // Get the src of the image
		    ColIDD = $(this).attr("id");
			/*alert(ColIDD);*/
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
				/*success:function(msg){alert(msg);}*/
			    });
		    
		    //$.get( "reserv_second.php?ColID="+ColID);
		    //$.post("reserv_second.php",{});
		    //$.post("reserv_second.php", {ColID: "ColID"});
			javascript:location.href='reserv_2.php';

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
<div id="container">

		<?php include"banner.php";?>
		<br>
	<div id="centermain">
		<div id="sidebar">
			<?php include"sidebar.php";?>
		</div>
		<div id="sidebody">
<h1>搜尋結果</h1>

<div class="maindiv">
<table border="1" width=80%  cellspacing=5 cellpadding=16>
　<tr align=center>
　<td>書名</td><!-- 在書名之下出現預約按鈕-->
　<td>作者</td>
　<td>出版日期</td>
  <td>索書號</td>
　<td>館藏類型</td>
　<td>館藏地</td>
　<td>狀態</td><!-- 預約人數-->
　<td>預約人數</td>
　</tr>

<?php

function toUTF88($str){
	//return $str;
	return iconv("Big5", "UTF-8", $str);
}

function toUTF8($str){
		return $str;
		//return iconv("Big5", "UTF-8", $str);
}

function date_normalizer($d){
	if($d instanceof  DateTime){
		return $d->getTimestamp();
	}else{
		return strtotime($d);
	}
}



function search($searchType,$searchText){
	switch ($searchType) {
		case 0:
			return "SELECT * FROM [Library].[dbo].[Collection],[Library].[dbo].[CollectionType],Library WHERE [Library].[dbo].[Collection].ColTypeID = [dbo].[CollectionType].[CollectionTypeID] AND Library.LibraryID=Collection.ColLocation";
			break;
		case 1:
			return "SELECT * FROM [Library].[dbo].[Collection],[Library].[dbo].[CollectionType],Library where [ColName] LIKE '%".$searchText."%' AND [Library].[dbo].[Collection].ColTypeID = [dbo].[CollectionType].[CollectionTypeID] AND Library.LibraryID=Collection.ColLocation";
			break;
		case 2:
			return "SELECT * FROM [Library].[dbo].[Collection],[Library].[dbo].[CollectionType],Library where [ColTypeID] =".$searchText." AND [Library].[dbo].[Collection].ColTypeID = [dbo].[CollectionType].[CollectionTypeID] AND Library.LibraryID=Collection.ColLocation";
			break;
		case 3:
			return "SELECT * FROM [Library].[dbo].[Collection],[Library].[dbo].[CollectionType],Library where [ColLocation] =".$searchText." AND [Library].[dbo].[Collection].ColTypeID = [dbo].[CollectionType].[CollectionTypeID] AND Library.LibraryID=Collection.ColLocation";
			break;
	}
}

function colStatus($s){
	switch ($s){
		case 0:
			return '可流通';
			break;
		case 1:
			return '外借中';
			break;
		case 2:
			return '外借中';//預約呈現在預約人數
			break;
		case 3:
			return '館際運送中';
			break;
		case 4:
			return '限館內';
			break;
		case 5:
			return '遺失';
			break;
			
	}
}

//=====================================================================
$searchType=$_POST ['searchType'];
@$searchText=$_POST ['searchText'];

// echo $_POST ['searchType']."   ".$_POST ['searchText'];
//search($searchType,$searchText);
//echo $searchText;

//$qsql="SELECT * FROM [Library].[dbo].[Collection]";
$qsql=search($searchType,toUTF88($searchText));


$stmt=sqlsrv_query($conn,$qsql);

$recno=0;
while($rec=sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
	//預約人數!!!!!!!!!!!!!!!!!!!!!
	$qsql_res="select MemID from Reserve where ColID=".$rec["ColID"]."AND Status=0";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt_res = sqlsrv_query( $conn, $qsql_res,$params,$options);
	$num=sqlsrv_num_rows($stmt_res);
	/*if ($num === false)
      echo "\nerror\n";
   else if ($num >=0)
      echo "\n$num\n";*/
	
	
	echo "<tr align=center>";
	//echo "<td>".toUTF8($rec["ColID"])."</br>";
	echo "<td>". toUTF8($rec["ColName"])."</br>";
	
	//echo "<td>".toUTF8($rec["ColName"])."<input type=\"submit\" value=\"submit\" >";
	
	if($rec["ColStatus"]=="1" || $rec["ColStatus"]=="2"){
		$ColID=$rec["ColID"];
		echo "<input   name=\"btn\" type=\"submit\" value=\"預約\" id=\"$ColID\" >";
		/*echo $ColID;*/
	}
	/*echo "<td>".$rec["ColVersion"];*/
	$findAuthor = "SELECT * FROM Author WHERE AuthorID=".$rec['ColAuthorID'];
	$findQuery = sqlsrv_query( $conn, $findAuthor);
	while ( $findRes = sqlsrv_fetch_array( $findQuery, SQLSRV_FETCH_ASSOC))
	{
		echo"<td>".$findRes['AuthorName'];
	}

	
	$tempDate=date_normalizer($rec["ColDate"]);
	$newDate = date("l dS F Y",$tempDate );
	//$newDate = DateTime::createFromFormat("l dS F Y", $rec["ColDate"]);
	//$newDate = $newDate->format('d/m/Y'); // for example
	
	echo "<td>".$newDate;
	echo "<td>".$rec['ColClass']." ".$rec['ColAuthorID'];
	echo "<td>".$rec["CollectionTypeName"];
	echo "<td>".$rec["LibraryName"];////////
	echo "<td>".colStatus($rec["ColStatus"]);///
	echo "<td>".$num;
	//echo "<td>".$rec["ColResTimes"];
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
</div>

</div>

	</div>
	    	<div id="clear"></div>
</div>



</body>
</html>