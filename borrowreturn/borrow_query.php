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

			include "link.php";
			$employeeid = $_POST["employee_id"];
			$collectionid = $_POST["collection_id"];
			$memberid = $_POST["member_id"];
			$today = date("Y-m-d");
			$DueDate = date("Y-m-d", strtotime($today."+1 month"));


			$sql_check_borrow_again = "SELECT * FROM Borrow WHERE ColID = ".$collectionid." AND MemID = ".$memberid." AND BorrowStatus = 0";
			$params_check_borrow_again = array(1, "some data");


			$stmt_check_borrow_again = sqlsrv_query( $conn, $sql_check_borrow_again, $params_check_borrow_again);
			if( $stmt_check_borrow_again === false ) {
     			die( print_r( sqlsrv_errors(), true));
			}	
			$count = 0;
			while( $row_check_borrow_again  = sqlsrv_fetch_array( $stmt_check_borrow_again , SQLSRV_FETCH_ASSOC) ) 
			{
			
				

				$count = $count + 1;
				
			
			}

			//echo "count:::::".$count;


			/////////////
			/////////////
			/////////////
			/////////////


			$sql_select_collection = "SELECT * FROM Collection WHERE ColID=".$collectionid;
			//先來找看看這本書的狀態是不是被預約了
			$params_select_collection = array(1, "some data");
			$stmt_select_collection = sqlsrv_query( $conn, $sql_select_collection, $params_select_collection);
			if( $stmt_select_collection === false ) {
     			die( print_r( sqlsrv_errors(), true));
			}
			$countt = 0;
			while( $row_select_collection  = sqlsrv_fetch_array( $stmt_select_collection , SQLSRV_FETCH_ASSOC) ) 
			{
			
				$colstatus = $row_select_collection ['ColStatus'];
				$collocation = $row_select_collection ['ColLocation'];
				$countt = $countt + 1;
				//echo $countt;
			}
		?>

	</head>
	<body>

	<div id="container">
		<?php include"banner.php";   /*這一個是最上方的banner*/?>
		<br>
	<div id="centermain">
		<div id="sidebar">

	<?php include "../sidebar.php"; ?>

		</div>
		<div id="sidebody">

			<h1>借書結果</h1>

			<div class="maindiv" style="color:white;">

			<?php 
			if($count == 0){//先判斷沒有被重複借

				if($colstatus==0){//可外借，就可以直接借

					$sql_update = "UPDATE Collection SET ColStatus='1' WHERE ColID = ".$collectionid."";

					$params_update = array(1, "some data");

					$stmt_update = sqlsrv_query( $conn, $sql_update, $params_update);

					if( $stmt_update === false ) {
     					die( print_r( sqlsrv_errors(), true));
					}

					$sql_insert = "INSERT INTO Borrow(ColID,MemID,BorrowDate,DueDate,ReturnDate, BorrowStatus) VALUES   
					(".$collectionid.", ".$memberid.", '".$today."', '".$DueDate."', NULL, '0')";

					$params_insert = array(1, "some data");

					$stmt_insert = sqlsrv_query( $conn, $sql_insert, $params_insert);

					if( $stmt_insert === false ) {
	    				die( print_r( sqlsrv_errors(), true));
					}
?>
					<table border="0px">
						<legend>借書完成</legend>  <br>
						<tr>
							<td>借書人：</td>
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
					</table>
<?php
				}elseif($colstatus==2){//預約中，看是不是這個人預約的

					$sql_select_reserve = "SELECT * FROM Reserve WHERE ColID = ".$collectionid."AND Status = 0";

					$params_select_reserve = array(1, "some data");
					$stmt_select_reserve = sqlsrv_query( $conn, $sql_select_reserve, $params_select_reserve);
					if( $stmt_select_reserve === false ) {
    		 			die( print_r( sqlsrv_errors(), true));
					}
					$count_reserve = 0;
					while( $row_select_reserve  = sqlsrv_fetch_array( $stmt_select_reserve , SQLSRV_FETCH_ASSOC) ) 
					{
						$count_reserve = $count_reserve +1 ;
						$memberid_check[] = $row_select_reserve ['MemID'];
					}

					//echo "count_reserve".$count_reserve;
					//echo "memberid_check::".$memberid_check[0];
					//echo "memberid::".$memberid;

					if($memberid_check[0]==$memberid && $count_reserve==1){


						//echo "$memberid_check==$memberid && $count_reserve==1";
						


						$sql_update = "UPDATE Collection SET ColStatus='1' WHERE ColID = ".$collectionid."";

						$sql_reserve="UPDATE Reserve SET Status='1' WHERE MemID = ".$memberid." AND ColID = ".$collectionid."  AND Status = '0'";

						$params_reserve = array(1, "some data");

						$stmt_reserve = sqlsrv_query( $conn, $sql_reserve, $params_reserve);
						if( $stmt_reserve === false ) {
     						die( print_r( sqlsrv_errors(), true));
						}

						$params_update = array(1, "some data");

						$stmt_update = sqlsrv_query( $conn, $sql_update, $params_update);

						if( $stmt_update === false ) {
     						die( print_r( sqlsrv_errors(), true));
						}

						$sql_insert = "INSERT INTO Borrow(ColID,MemID,BorrowDate,DueDate,ReturnDate, BorrowStatus) VALUES   
						(".$collectionid.", ".$memberid.", '".$today."', '".$DueDate."', NULL, '0')";

						$params_insert = array(1, "some data");


						$stmt_insert = sqlsrv_query( $conn, $sql_insert, $params_insert);

						if( $stmt_insert === false ) {
	    					die( print_r( sqlsrv_errors(), true));
						}
?>

						<table border="0px">
							<legend>借書完成</legend>  <br>
							<tr>
								<td>借書人：</td>
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
						</table>
<?php

					}elseif($memberid_check[0]==$memberid && $count_reserve > 1){

						$sql_update = "UPDATE Collection SET ColStatus='2' WHERE ColID = ".$collectionid."";

						$sql_reserve="UPDATE Reserve SET Status='1' WHERE MemID = ".$memberid." AND ColID = ".$collectionid."  AND Status = '0'";

						$params_reserve = array(1, "some data");

						$stmt_reserve = sqlsrv_query( $conn, $sql_reserve, $params_reserve);

						if( $stmt_reserve === false ) {
     						die( print_r( sqlsrv_errors(), true));
						}

						$params_update = array(1, "some data");

						$stmt_update = sqlsrv_query( $conn, $sql_update, $params_update);

						if( $stmt_update === false ) {
     						die( print_r( sqlsrv_errors(), true));
						}

						$sql_insert = "INSERT INTO Borrow(ColID,MemID,BorrowDate,DueDate,ReturnDate, BorrowStatus) VALUES   
						(".$collectionid.", ".$memberid.", '".$today."', '".$DueDate."', NULL, '0')";

						$params_insert = array(1, "some data");


						$stmt_insert = sqlsrv_query( $conn, $sql_insert, $params_insert);

						if( $stmt_insert === false ) {
	    					die( print_r( sqlsrv_errors(), true));
						}

?>

						<table border="0px">
							<legend>借書完成</legend>  <br>
							<tr>
								<td>借書人：</td>
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
						</table>
<?php
					}else{
?>
						<p style="color:white;">已經有人預約！</p>
<?php
					}
				}else{
?>
						<p style="color:white;">不能外借！！</p>
<?php				
				}	

			}else{

					echo "這本書已經被同一個人借閱了！";

			} ?>
			</div>

		</div>

	</div>
	    	<div id="clear"></div>
</div>
	</body>
</html>