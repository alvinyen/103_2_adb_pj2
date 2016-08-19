<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<?php include"../header.php";?>

		<script type="text/javascript">

			/*function check(){
				if (regi.name.value==""){
					alert("請輸入姓名");
				}
			};*/

			$(function(){
				//須與form表單ID名稱相同
				$("#commentForm").validate();
			});

		</script>

		<?php

			include "../link.php";
			$employeeid = $_POST["employee_id"];
			$collectionid = $_POST["collection_id"];
			$memberid = $_POST["member_id"];
			$today = date("Y-m-d");
			$DueDate = date("Y-m-d", strtotime($today."+1 month"));
			$DueDate_reserve = date("Y-m-d", strtotime($today."+5 day"));


			/*$sql_insert = "INSERT INTO Borrow(ColID,MemID,BorrowDate,DueDate,ReturnDate, BorrowStatus) VALUES   
			(".$collectionid.", ".$memberid.", '".$today."', '".$DueDate."', NULL, '0')";*/

			$sql_update_borrow = "UPDATE Borrow SET BorrowStatus = '1', ReturnDate = '".$today."' WHERE ColID = ".$collectionid." AND MemID = ".$memberid." AND BorrowStatus = '0'";


			$sql_select_collection = "SELECT * FROM Collection WHERE ColID=".$collectionid;
			//先來找看看這本書的狀態是不是被預約了
			$params_select_collection = array(1, "some data");
			$stmt_select_collection = sqlsrv_query( $conn, $sql_select_collection, $params_select_collection);
			if( $stmt_select_collection === false ) {
     			die( print_r( sqlsrv_errors(), true));
			}

			while( $row_select_collection  = sqlsrv_fetch_array( $stmt_select_collection , SQLSRV_FETCH_ASSOC) ) 
			{
			
				$colstatus = $row_select_collection ['ColStatus'];
				$collocation = $row_select_collection ['ColLocation'];
			
			}

			//echo "預約狀態".$colstatus;

			if ($colstatus=1){ //沒有被預約

				$sql_update_collection = "UPDATE Collection SET ColStatus='0', ColLocation='".$_POST["employee_type"]."' WHERE ColID = ".$collectionid;
				//可流通----沒被預約
			
			}else{

				$sql_select_reserve = "SELECT * FROM Reserve WHERE ColID=".$collectionid;
				$params_select_reserve = array(1, "some data");
				$stmt_select_reserve = sqlsrv_query( $conn, $sql_select_reserve, $params_select_reserve);
					if( $stmt_select_reserve === false ) {
     					die( print_r( sqlsrv_errors(), true));
				}

				while( $row_select_reserve  = sqlsrv_fetch_array( $stmt_select_reserve , SQLSRV_FETCH_ASSOC) ) 
				{
					$libraryid = $row_select_reserve ['LibraryID'];
				}
				
				if($libraryid == $collocation){//預約跟還書同一個地點
					
					$sql_update_collection = "UPDATE Collection SET ColStatus='2', ColLocation='".$_POST["employee_type"]."' WHERE ColID = ".$collectionid;
					//被預約
					$sql_reserve="UPDATE Reserve SET DueDate='".$DueDate_reserve."' WHERE ColID = ".$collectionid." AND Status = '0'";
					$params_reserve = array(1, "some data");
					$stmt_reserve = sqlsrv_query( $conn, $sql_reserve, $params_reserve);
					if( $stmt_reserve === false ) {
     					die( print_r( sqlsrv_errors(), true));
					}

				}else{
					$sql_update_collection = "UPDATE Collection SET ColStatus='3', ColLocation='".$_POST["employee_type"]."' WHERE ColID = ".$collectionid;
				}
			}

			//echo $sql_update_collection;

			$sql_select_borrow = "SELECT * FROM Borrow WHERE ColID = ".$collectionid." AND MemID = ".$memberid." AND BorrowStatus = '0'";

			//echo $sql_select_borrow."<br>";

			//echo $sql_update_borrow."<br>";

			//echo $sql_update_collection;

			$params_select_borrow = array(1, "some data");


			$stmt_select_borrow = sqlsrv_query( $conn, $sql_select_borrow, $params_select_borrow);
			if( $stmt_select_borrow === false ) {
     			die( print_r( sqlsrv_errors(), true));
			}

			$params_update_borrow = array(1, "some data");


			$stmt_update_borrow = sqlsrv_query( $conn, $sql_update_borrow, $params_update_borrow);
			if( $stmt_update_borrow === false ) {
     			die( print_r( sqlsrv_errors(), true));
			}

			$params_update_collection = array(1, "some data");
			$stmt_update_collection = sqlsrv_query( $conn, $sql_update_collection, $params_update_collection);
			if( $stmt_update_collection === false ) {
     			die( print_r( sqlsrv_errors(), true));
			}
			//echo $employeeid;
		?>

	</head>
	<body>

			



	<div id="container">
		<?php include"banner.php";   /*這一個是最上方的banner*/?>
		<br>
	<div id="centermain">
		<div id="sidebar">

		<?php include "sidebar.php";?>

		</div>
		<div id="sidebody">

		<h1>還書</h1>

			<div class="maindiv" style="color:white;">
			<table border="0px">
				<legend>還書完成</legend>  <br>
				<tr>
					<td>還書人：</td>
					<td><?php echo $memberid; ?></td>
				</tr>
				<tr>
				<td>經手人：</td>
				<td><?php echo $employeeid; ?></td>
				</tr>
				<tr>
				<td>館藏ID：</td>
				<td><?php echo $collectionid; ?></td>
				</tr>
				<tr>
				<td>借書時間：</td>
				<td><?php echo $today; ?></td>
				</tr>
				<tr>
				<td>還書時間：</td>
				<td><?php echo $DueDate; ?></td>
				</tr>
				<tr>
				<td>確實還書時間：</td>
				<td><?php echo $today; ?></td>
				</tr>
			</table>
			</div>

		</div>

	</div>
	    	<div id="clear"></div>
</div>




	</body>
</html>