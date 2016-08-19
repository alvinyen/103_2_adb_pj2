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

			$query = "INSERT INTO Employee(EmpSsn,EmpName,EmpType,EmpSalary) VALUES   
			('".$_POST['ssd']."', '".$_POST['name']."', '".$_POST['type']."', '".$_POST['salary']."')";

			//echo $query;

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


			<h1>聘用員工</h1>

			<?php include"../link.php";?>

			<div class="maindiv" style="color:white;">

				您新增的員工如下：<br><br>
				姓名：<?php echo $_POST["name"];  ?> <br><br>
				身分證字號：<?php echo $_POST["ssd"];  ?> <br><br>
				員工所屬分館：
				<?php

						$LibraryName="";
						$query_findName="SELECT LibraryID,LibraryName FROM Library Where LibraryID=('".$_POST["type"]."') ";
						//echo $query_findName;
						$stmt = sqlsrv_query( $conn, $query_findName);
						if( $stmt === false ) {
		     			die( print_r( sqlsrv_errors(), true));
		     			}
		     			//echo "1";
						while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
							echo $row["LibraryName"];
							
						//echo "2";
						}

				?><br><br>
				薪資等級：<?php echo $_POST["salary"];  ?> <br><br>
				<form action="employee_finish.php" method="POST">
					<input type="hidden" name="sql" value="<?php echo $query; ?>" />
					<input type="hidden" name="member_name" value="<?php echo $_POST['name']; ?>" />
					<button type="submit" value="finish" class="button_login" style="color:white;">確認</button>
				</form>
			</div>



		</div>

	</div>
	    	<div id="clear"></div>
</div>



	</body>
</html>