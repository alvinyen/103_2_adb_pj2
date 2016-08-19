<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include"../header.php";
		include"../link.php";?>
	</head>



	<body>
<div id="container">

		<?php include"banner.php";?>
		<br>
	<div id="centermain">
		<div id="sidebar">
			<?php include"../sidebar.php";?>
		</div>
		<div id="sidebody">

		<h1>個人資料</h1>

			<div class="maindiv" style="color:white;">
		<?php
		if ( isset($_SESSION['MemID']) )
		{
			?><div class="maindiv" style="color:white;">
			<table>
			<?php
			$query_profile = "SELECT * FROM Member WHERE MemID ='".$_SESSION['MemID']."'";
			$profileRes = sqlsrv_query( $conn, $query_profile );
			while ( $row = sqlsrv_fetch_array( $profileRes , SQLSRV_FETCH_ASSOC)) {
				echo "<tr align=center><td>身分證字號</td><td>".$row['MemSsn']."</td>";
				echo "<tr align=center><td>姓名</td><td>".$row['MemName']."</td>";
				echo "<tr align=center><td>住址</td><td>".$row['MemAddress']."</td>";
				echo "<tr align=center><td>電話</td><td>".$row['MemPhone']."</td>";
				echo "<tr align=center><td>E-mail</td><td>".$row['MemEmail']."</td>";
			}
			?></table></div>
			<h3>修改資料</h3>
			<div class="maindiv" style="color:white;">

				<form class="cmxform" id="commentForm" action= "profile_mod.php" method="POST">
				
					<label for="cname">姓名：</label>
					<input id="cname" type="text" name="name">
					<br><br>
					<label for="cssd">身分證字號：</label>
					<input id="cssd" class="digits" type="text" name="ssd" maxlength="10">
					<br><br>
					<label for="cphone">電話：</label>
					<input id="cphone" type="text" name="phone" maxlength="11">
					<br><br>
					<label for="caddress">居住地址：</label>
					<input id="caddress" type="text" name="address">
					<br><br>
					<label for="cemail">E-Mail：</label>
					<input id ="cemail" class="email" type="text" name="email">
					<br><br>
					<button type="submit" value="finish" class="button_login" style="color:white;">修改</button>
				
				</form>

			</div>




			<?php

		}
		else
		{
				echo "<script>alert('您可能尚未登入，或閒置過久已自動登出。請登入以使用個人資訊頁！');</script>";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=../login/login.php>";
		}
		?>
		</div>

	</div>
	    	<div id="clear"></div>
</div>



	</body>
</html>