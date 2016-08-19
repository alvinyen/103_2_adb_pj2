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

		<div class="maindiv"> 
		<h1>員工登出</h1> <br>


		您已經成功登出！<br>


		<?php
		unset($_SESSION['EmpName'] );
		unset($_SESSION['EmpID'] );
		unset($_SESSION['EmpSsn'] );
		echo "<meta http-equiv=REFRESH CONTENT=1;url=../main.php>";?>
		<script language=JavaScript>
 		parent.banner.location.reload();
		</script>		    
				

			</div>

		<br>
		</div>

		</div>
	</div>

	    	<div id="clear"></div>
</div>
		




	</body>
</html>