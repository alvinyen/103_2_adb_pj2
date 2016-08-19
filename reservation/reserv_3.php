<?php   
//	$sql_update_borrow = "UPDATE Borrow SET BorrowStatus = '1',     $sql_update_borrow = "UPDATE Borrow SET BorrowStatus = '1', 
//$params_update_borrow = array(1, "some data");
//$stmt_update_borrow = sqlsrv_query( $conn, $sql_update_borrow, $params_update_borrow);

//$usqlColResTimes='UPDATE [Library].[dbo].[Collection] SET [ColResTimes] = ( ?) WHERE [ColID] = ( ?)';
//$upadate_sql_ColStatus='UPDATE [Library].[dbo].[Collection] SET [ColStatus] = ( ?) WHERE [ColID] = ( ?)';
//$params_upadate_sql_ColStatus = array(987, 4);
//$stmt_update = sqlsrv_query( $conn, $upadate_sql_ColStatus, $params_upadate_sql_ColStatus);

//INSERT INTO Production.UnitMeasure VALUES (N'FT', N'Feet', '20080414');

header ( "Content-Type:text/html; charset=utf-8" );
include "link.php";

session_start ();
$MemSsn=$_SESSION['username'];
$ColID=$_SESSION ['ColID'];
$LibraryID=$_POST ['location'];
$x=true;

//取得MemID→比對資料用
$qsqlMemID='select [MemID] from [Library].[dbo].[Member] where [MemSsn] =\''.$MemSsn.'\'';
$stmt=sqlsrv_query($conn,$qsqlMemID);
$rec=sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
$MemID=$rec["MemID"];

//取得ColStatus→比對資料用
$qsqlColStatus='select [ColStatus] from [Library].[dbo].[Collection] where [ColID] =\''.$ColID.'\'';
$stmt=sqlsrv_query($conn,$qsqlColStatus);
$rec=sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
$ColStatus=$rec["ColStatus"];


if ( sqlsrv_begin_transaction( $conn ) === false ) {
	die( print_r( sqlsrv_errors(), true ));
}

//Transaction STEP1. 在Reserve Table 預約表插入預約資料
$isql_t1='INSERT INTO [Library].[dbo].[Reserve] 
		([ColID],[MemID],[LibraryID])
		VALUES 
		(?,?,?)';
$stmt_t2=sqlsrv_query($conn,$isql_t1,array($ColID,$MemID,$LibraryID));

if($ColStatus==1 ){
	//Transaction STEP2. 更改Collection Table 館藏表 的館藏狀態
	$upadate_sql_ColStatus='UPDATE [Library].[dbo].[Collection] SET [ColStatus] = ( ?) WHERE [ColID] = ( ?)';
	$params_upadate_sql_ColStatus = array(2,$ColID );
	$stmt_update = sqlsrv_query( $conn, $upadate_sql_ColStatus, $params_upadate_sql_ColStatus);
	if($isql_t1 && $stmt_t2){
		sqlsrv_commit( $conn );
		echo '預約成功！';
	}else{
		sqlsrv_rollback( $conn );
		echo '預約失敗！';
	}
	sqlsrv_free_stmt( $stmt_update);
}













else if($ColStatus==2 ){
	
	
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


