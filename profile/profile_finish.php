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

		<h1>個人資料－修改結果</h1>

			<div class="maindiv" style="color:white;">
		<?php
		if ( isset($_SESSION['MemID']) )
		{
			

				if ( isset($_SESSION["name"]) )
				{
					$query = "UPDATE Member SET MemName = '".$_SESSION["name"]."' WHERE MemID = ".$_SESSION['MemID'];
					$queryRes = sqlsrv_query( $conn, $query);
					unset($_SESSION["name"]);
				} 
				if ( isset($_SESSION["ssd"]) )
				{
					$query = "UPDATE Member SET MemSsn = '".$_SESSION["ssd"]."' WHERE MemID = ".$_SESSION['MemID'];
					$queryRes = sqlsrv_query( $conn, $query);
					unset($_SESSION["ssd"]);
				} 
				if ( isset($_SESSION["phone"]) )
				{
					$query = "UPDATE Member SET MemPhone = '".$_SESSION["phone"]."' WHERE MemID = ".$_SESSION['MemID'];
					$queryRes = sqlsrv_query( $conn, $query);
					unset($_SESSION["phone"]);
				} 
				if ( isset($_SESSION["address"]) )
				{
					$query = "UPDATE Member SET MemAddress = '".$_SESSION["address"]."' WHERE MemID = ".$_SESSION['MemID'];
					$queryRes = sqlsrv_query( $conn, $query);
					unset($_SESSION["address"]);
				} 
				if ( isset($_SESSION["email"]) )
				{
					$query = "UPDATE Member SET MemEmail = '".$_SESSION["email"]."' WHERE MemID = ".$_SESSION['MemID'];
					$queryRes = sqlsrv_query( $conn, $query);
					unset($_SESSION["email"]);
				} 
				

			?>





			<div class="maindiv" style="color:white;">
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
			<div class="maindiv" style="color:white;">

								資料成功已修改！<br><br>
				<form action="profile.php" method="POST">
					<input type="hidden" name="sql" value="<?php echo $query; ?>" />
					<button type="submit" value="finish" class="button_login" style="color:white;">確認</button>
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