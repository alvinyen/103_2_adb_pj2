<?php session_start(); ?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<?php 
include"../header.php";
include "link.php";
?>
</head>
<body>
<div id="container">

		<?php include"banner.php";?>
		<br>
	<div id="centermain">
		<div id="sidebar">
			<?php include"sidebar.php";?>
		</div>
		<div id="sidebody">
<?php   

$MemSsn=$_SESSION['MemSsn'];
$ColID=$_SESSION ['ColID'];
$LibraryID=$_POST ['location'];
$x=true;

$MemID=$_SESSION['MemID'];



$qsqlColStatus='select [ColStatus] from [Library].[dbo].[Collection] where [ColID] =\''.$ColID.'\'';
//取得ColStatus
$stmt=sqlsrv_query($conn,$qsqlColStatus);
$rec=sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
$ColStatus=$rec["ColStatus"];
//echo gettype($ColStatus).'</br>';

//insetString
$isql="INSERT INTO Reserve(ColID,MemID,LibraryID,Status) VALUES (?,?,?,?)";
$stmt=sqlsrv_query($conn,$isql,array($ColID,$MemID,$LibraryID,0));

	if ( $stmt )
{
	echo"Reserve插入成功";
}

echo "ColID:".$ColID."MemID:".$MemID."LID".$LibraryID."<br>";

//if(!$stmt)
	//echo '插入失敗';
//插入預約表

if( $stmt  &&  ($ColStatus==1) ){
	$upadate_sql_ColStatus='UPDATE [Library].[dbo].[Collection] SET [ColStatus] = ( ?) WHERE [ColID] = ( ?)';
	$params_upadate_sql_ColStatus = array(2,$ColID );
	$stmt_update = sqlsrv_query( $conn, $upadate_sql_ColStatus, $params_upadate_sql_ColStatus);
	if($stmt_update){
		echo '預約成功！';
	}else{
		echo '預約失敗！';
	}
	sqlsrv_free_stmt( $stmt_update);
}else if( $stmt  &&  ($ColStatus==2) ){
	if($stmt){
		echo '預約成功！!';
	}else{
		echo '預約失敗！!';
	}
}else{
	//插入失敗
	//$dsql='DELETE FROM [Library].[dbo].[Reserve] WHERE [ColID] = ( ?) AND [MemID] = ( ?)';
	//$params_delete_sql = array($ColID,$MemID);
	//$stmt_delete = sqlsrv_query( $conn, $dsql, $params_delete_sql);
	echo "預約失敗!!請勿重複預約!!";
	//插入失敗：重複預約
}

if($stmt===true)
	sqlsrv_free_stmt($stmt);
sqlsrv_close( $conn);

echo "</br>";
echo '<input type="button"  value="回到查詢頁" onclick="location.href=\'search_1.php\'">';
//$qsqlColResTimes='select [ColResTimes] from [Library].[dbo].[Collection] where [ColID] =\''.$ColID.'\'';
//step3.
//$usqlColResTimes='UPDATE [Library].[dbo].[Collection] SET [ColResTimes] = ( ?) WHERE [ColID] = ( ?)';
//$usqlColResTimes='UPDATE [Library].[dbo].[Collection] SET [ColResTimes] =\''.($ColResTimes+1).'\' where [ColID] =\''.$ColID.'\'';
//$usqlColResTimes='UPDATE Collection SET ColResTimes =\''.($ColResTimes+1).'\' where ColID =\''.$ColID.'\'';
//$params=array(&$ColResTimes,&$ColID);
//echo $usqlColResTimes.'</br>';
//echo $ColResTimes."=>".$ColID;
//echo $qsqlMemID;
/*if($stmt){
 echo "OK";
 }else{
 echo "NOT OK!!";
 }*/
//$MemID=sqlsrv_get_field( $stmt, 0);
//echo "MemID=".$MemID.'</br>';
//echo $_POST ['location'];
//echo $_SESSION ['ColID'];
?>

</div>

	</div>
	    	<div id="clear"></div>
</div>


</body>
</html>