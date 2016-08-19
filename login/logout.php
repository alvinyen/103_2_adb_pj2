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
		<h1>登出</h1> <br>


		您已經成功登出！<br>


		<?php
		unset($_SESSION['MemName'] );
		unset($_SESSION['MemID'] );
		unset($_SESSION['MemSsn'] );
		echo "<meta http-equiv=REFRESH CONTENT=1;url=../main.php>";?>	    
				

			</div>

		<br>
		</div>

		</div>
	</div>

	    	<div id="clear"></div>
</div>
		




	</body>
</html>