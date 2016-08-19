<?php session_start ();

include "link.php";
include "../header.php";


//echo $_POST ['location'];
//echo $_SESSION ['ColID'];
$MemEmail=$_SESSION['username'];
$ColID=$_SESSION ['ColID'];
$LibraryID=$_POST ['location'];

//step1
$qsqlMemID='select [MemID] from [Library].[dbo].[Member] where [MemEmail] =\''.$MemEmail.'\'';

//step2
$isql='INSERT INTO [Library].[dbo].[Reserve] 
		([ColID],[MemID],[LibraryID],[DueDate])
		VALUES 
		(?,?,?,?)';
$qsqlColResTimes='select [ColResTimes] from [Library].[dbo].[Collection] where [ColID] =\''.$ColID.'\'';


//取得預約次數
$stmt=sqlsrv_query($conn,$qsqlColResTimes);
$ColResTimes=sqlsrv_get_field($stmt, 0);
$ColResTimes++;


//step3.
$usqlColResTimes='UPDATE [Library].[dbo].[Collection] SET [ColResTimes] = ( ?) WHERE [ColID] = ( ?)';
//$usqlColResTimes='UPDATE [Library].[dbo].[Collection] SET [ColResTimes] =\''.($ColResTimes+1).'\' where [ColID] =\''.$ColID.'\'';
//$usqlColResTimes='UPDATE Collection SET ColResTimes =\''.($ColResTimes+1).'\' where ColID =\''.$ColID.'\'';
$params=array(&$ColResTimes,&$ColID);

//取得MemID
/*echo $qsqlMemID;
$stmt=sqlsrv_query($conn,$qsqlMemID);
$rec=sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
$MemID=$rec["MemID"];

if($stmt){
	echo "OK";
}else{
	echo "NOT OK!!";
}
*/
$MemID = $_SESSION['MemID'];
//$MemID=sqlsrv_get_field( $stmt, 0);
echo "MemID=".$MemID.'</br>';
echo $usqlColResTimes.'</br>';
echo $ColResTimes."=>".$ColID;

//插入預約表
$stmt=sqlsrv_query($conn,$isql,array($ColID,$MemID,$LibraryID,NULL));
if($stmt){
	//插入成功
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$stmt = sqlsrv_prepare( $conn, $usqlColResTimes, $params);
	if( $stmt )
	{
		echo "Statement prepared.\n";
	}
	else
	{
		echo "Error in preparing statement.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	
	/* Execute the statement. Display any errors that occur. */
	if( sqlsrv_execute( $stmt))
	{
		echo "Statement executed.\n";
	}
	else
	{
		echo "Error in executing statement.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	
	/*$stmt=sqlsrv_prepare($conn, $usqlColResTimes,array(&$ColResTimes,&$ColID));
	if(!$stmt){echo "again fail!!!!!!!!!!!!";}
	$temp=array($ColResTimes=>$ColID);
	foreach ($temp as $ColResTimes=>$ColID){
		if( sqlsrv_execute( $conn,$stmt ) === false ) {
          	die( print_r( sqlsrv_errors(), true));
    	}
	}
	
	/*if($conn->query($usqlColResTimes)){
		//預約次數更新成功
		echo "預約成功!!!!!!!!!";
	}else{
		//預約次數更新失敗
		echo "預約失敗!!";
	}*/
}else{
	//插入失敗
	echo "預約失敗!!";
}

//echo $qsqlMemID;

sqlsrv_free_stmt( $stmt);
sqlsrv_close( $conn);
?>