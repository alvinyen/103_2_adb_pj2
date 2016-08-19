<?php session_start();?>
<html>
<head>
<?php
include"../header.php";
include "link.php";
$ColClass = $_POST ["ColClass"];
//Author ID尋找
$AuthorName = $_POST["AuthorName"];

$findAuthor = "SELECT * FROM AUTHOR WHERE AuthorName = '".$AuthorName."'";
$findRes = sqlsrv_query($conn,$findAuthor);
if ( sqlsrv_has_rows($findRes) ) //有找到已有的Author = 找ID
{
	while( $row = sqlsrv_fetch_array( $findRes, SQLSRV_FETCH_ASSOC) ) 
	{
		$ColAuthorID = $row['AuthorID'];
	}
}
else //不存在的Author = 新增Author
{			
$newAuthor = "INSERT INTO Author(AuthorName) VALUES (?)";
$insertAuthor = sqlsrv_query($conn,$newAuthor,array($AuthorName));

$findAuthorID = "SELECT AuthorID FROM AUTHOR WHERE AuthorName = '".$AuthorName."'";
$findAuthorRes =  sqlsrv_query($conn,$findAuthorID);
while ($row = sqlsrv_fetch_array( $findAuthorRes, SQLSRV_FETCH_ASSOC))
//$ColAuthorID = $_POST ["ColAuthorID"];
//$_POST["AuthorName"];
{$ColAuthorID = $row['AuthorID'];}

}//找完AuthorID
$ColName = $_POST ["ColName"];
$ColVersion = $_POST ["ColVersion"];
$ColDate = $_POST ["year"] . "-" . $_POST ["month"] . "-01";
$ColISBN = $_POST ["ColISBN"];
$ColStatus = "0";
$ColLocation = $_POST ["ColLocation"];
$CollectionTypeID = $_POST ["CollectionTypeID"];

$isql= 'INSERT INTO [Library].[dbo].[Collection] 
		([ColClass],[ColAuthorID],[ColName],[ColVersion],[ColDate],[ColISBN],[ColStatus],[ColLocation],[ColTypeID])
		VALUES 
		(?,?,?,?,?,?,?,?,?)';

$stmt=sqlsrv_query($conn,$isql,array($ColClass,$ColAuthorID,$ColName,$ColVersion,$ColDate,$ColISBN,$ColStatus,$ColLocation,$CollectionTypeID));

?>

</head>
	<body>

<div id="container">

		<?php include"banner.php";?>
		<br>
	<div id="centermain">
		<div id="sidebar">
			<?php include"../sidebar.php";?>
		</div>
		<div id="sidebody">
			<h1>館藏入庫</h1>

<div class="maindiv" style="color:white;">
<?php

if($stmt){
	echo "館藏新增完成！";?>
	<button value="back" class="button_login" style="color:white;" onclick="javascript:location.href='table.php'">繼續入庫</button>

	<?php

}else{
	die( print_r( sqlsrv_errors(), true));
}
sqlsrv_free_stmt( $stmt);
sqlsrv_close( $conn);
?>

</div>

		</div>

	</div>
	    	<div id="clear"></div>
</div>


</body>