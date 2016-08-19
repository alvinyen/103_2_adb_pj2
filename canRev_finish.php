<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include"header.php";?>
		<link rel=stylesheet type="text/css" href="CSS.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="jquery.js" type="text/javascript"></script>
		<script src="jquery.validate.js" type="text/javascript"></script>
		<script src="cmxforms.js" type="text/javascript"></script>

		<script type="text/javascript">
			$(function(){
				//須與form表單ID名稱相同
				$("#commentForm").validate();
			});

		</script>

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


			<h1>取消預約</h1>

			<?php
				//echo $_POST["sql"];
			include "link.php";

			//新增員工
			$sql = $_POST["sql"];


			$stmt = sqlsrv_query( $conn, $sql);
			if( $stmt === false ) {
     			die( print_r( sqlsrv_errors(), true));
			}
			?>



			<div class="maindiv" style="color:white;">

				<br><br>您已取消預約<br><br>

				<button value="back" class="button_login" style="color:white;" onclick="javascript:location.href='myshelf.php'">回到我的書庫</button>

			</div>

			</div>

	</div>
	    	<div id="clear"></div>
</div>


	</body>
</html>