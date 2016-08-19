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

			<?php include"../link.php";


			//新增員工
			$sql = $_POST["sql"];
			$name = $_POST["member_name"];
			$params = array(1, "some data");


			$stmt = sqlsrv_query( $conn, $sql, $params);
			if( $stmt === false ) {
     			die( print_r( sqlsrv_errors(), true));
			}

/*
			//刪除員工
			$sql_d = $_POST["sql_de"];
			$name_d = $_POST["member_name_de"];
			$params_d = array(1, "some data");


			$stmt = sqlsrv_query( $conn, $sql_d, $params_d);
			if( $stmt === false ) {
     			die( print_r( sqlsrv_errors(), true));
			}
*/
			//echo $sql;
			//echo $name;

			?>



			<div class="maindiv" style="color:white;">

				已新增 <?php echo $_POST["member_name"]; ?> 先生/女士

				<button value="back" class="button_login" style="color:white;" onclick="javascript:location.href='employee.php'">修改下一筆員工資料</button>

			</div>


		</div>

	</div>
	    	<div id="clear"></div>
</div>


	</body>
</html>