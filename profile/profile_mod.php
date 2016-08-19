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

		<h1>個人資料－修改確認</h1>

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

				您想修改的資料如下：<br><br>
				<?php 
				if ( !empty($_POST["name"]) )
				{
					echo "姓名：".$_POST["name"]."<br><br>";
					$_SESSION['name']=$_POST["name"];
				} 
				if ( !empty($_POST["ssd"]) )
				{
					echo "身分證字號：".$_POST["ssd"]."<br><br>";
					$_SESSION['ssd']=$_POST['ssd'];
				} 
				if ( !empty($_POST["phone"]) )
				{
					echo "電話：".$_POST["phone"]."<br><br>";
					$_SESSION['phone']=$_POST['phone'];
				} 
				if ( !empty($_POST["address"]) )
				{
					echo "地址：".$_POST["address"]."<br><br>";
					$_SESSION['address']=$_POST['address'];
				} 
				if ( !empty($_POST["email"]) )
				{
					echo "E-Mail：".$_POST["email"]."<br><br>";
					$_SESSION['email']=$_POST['email'];
				} 
				
				?>
				確定要修改嗎？
				<form action="profile_finish.php" method="POST">
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