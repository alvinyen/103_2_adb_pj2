<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include"../header.php";?>
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

		
		<h1>員工登入</h1> <br>
	
			<div class="maindiv" style="color:white;">

				<form class="cmxform" id="commentForm" action= "emplogin_finish.php" method="POST">
					
					<label for="EmpSsn">身分證字號</label>
					<input id="EmpSsn" class="digits" type="text" name="EmpSsn" required maxlength="10"><br><br><br>
					<label for="EmpEmail">員工編號：</label>
					<input id ="EmpID" class="digits" type="text" name="EmpID" required><br><br>

					<button type="submit" value="finish" class="button_login" style="color:white;">登入GO!</button>

				</form>

			</div>
		
		</div>
	</div>

	    	<div id="clear"></div>
</div>




</body>
</html>