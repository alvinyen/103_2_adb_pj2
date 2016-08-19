<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
	<?php include"../header.php";?>

		<script type="text/javascript">
			$(function(){
				//須與form表單ID名稱相同
				$("#commentForm").validate();
			});

		</script>

		<?php

			//刪除的query
			$query_del = "DELETE FROM Employee WHERE EmpId= ('".$_POST['empId']."')";

			//查詢的query
			$query_findName="SELECT * FROM Employee WHERE EmpId= ('".$_POST['empId']."')";
			$query_findSsn="SELECT EmpSsn FROM Employee WHERE EmpId= ('".$_POST['empId']."')";
			$query_findType="SELECT EmpType FROM Employee WHERE EmpId= ('".$_POST['empId']."')";
			$query_findTSalary="SELECT EmpSalary FROM Employee WHERE EmpId= ('".$_POST['empId']."')";
			echo $query_findName;

		?>

	</head>
	<body>


<div id="container">
		<?php include"banner.php";   /*這一個是最上方的banner*/?>
		<br>
	<div id="centermain">
		<div id="sidebar">
		<?php include"sidebar.php";?>
		</div>
		<div id="sidebody">


			<h1>解雇員工</h1>

			



			<div class="maindiv" style="color:white;">

			<?php include"../link.php";

			//$sql = $_POST["sql"];
			//$name = $_POST["member_name"];

			$params = array(1, "some data");

			echo "您刪除的員工如下：<br /><br />";

			function showData($topic,$datatopic){

				global $conn, $query_findName, $params;
				$stmt = sqlsrv_query( $conn, $query_findName, $params);
				if( $stmt === false ) {
     			die( print_r( sqlsrv_errors(), true));
     			}
     			echo $topic."："; 
				while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
				echo $row[$datatopic];
				echo "<br />";

			}


			showData('姓名','EmpName');
			showData('身分證字號','EmpSsn');
			showData('所屬分館','EmpType');
			showData('薪資等級','EmpSalary');
			
			
			/*
			$stmt = sqlsrv_query( $conn, $query_findName, $params);
			if( $stmt === false ) {
     			die( print_r( sqlsrv_errors(), true));
     		}
     		echo "姓名："; 
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			echo $row['EmpName'];
			echo "<br />";

			$stmt = sqlsrv_query( $conn, $query_findName, $params);
			if( $stmt === false ) {
     			die( print_r( sqlsrv_errors(), true));
     		}
			echo "身分證字號："; 
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			echo $row['EmpSsn'];
			echo "<br />";


			$stmt = sqlsrv_query( $conn, $query_findName, $params);
			if( $stmt === false ) {
     			die( print_r( sqlsrv_errors(), true));
     		}
			echo "員工類型代碼："; 
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			echo $row['EmpType'];
			echo "<br />";

			$stmt = sqlsrv_query( $conn, $query_findName, $params);
			if( $stmt === false ) {
     			die( print_r( sqlsrv_errors(), true));
     		}
			echo "薪資等級："; 
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			echo $row['EmpSalary'];
			echo "<br />";

			*/

			?>

				
			
				<form action="employee_delete_finish.php" method="POST">
					<input type="hidden" name="sql" value="<?php echo $query_del; ?>" />
					<!--
					<input type="hidden" name="member_name" value="<?php 
						$stmt = sqlsrv_query( $conn, $query_findName, $params);
							if( $stmt === false ) {
	     						die( print_r( sqlsrv_errors(), true));
	     					}
						while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
						echo $row['EmpName'];
					?>" />
					-->
					<button type="submit" value="finish" class="button_login" style="color:white;">刪除</button>
				</form>
			</div>

		</div>

	</div>
	    	<div id="clear"></div>
</div>


	</body>
</html>