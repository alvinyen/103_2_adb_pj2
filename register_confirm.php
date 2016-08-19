<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
	<?php include"header.php";?>

		<script type="text/javascript">
			$(function(){
				//須與form表單ID名稱相同
				$("#commentForm").validate();
			});

		</script>

		<?php

			$query = "INSERT INTO Member(MemSsn,MemName,MemAddress,MemPhone,MemEmail) VALUES   
			('".$_POST['ssd']."', '".$_POST['name']."', '".$_POST['address']."', '".$_POST['phone']."', '".$_POST['email']."')";

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

			<div class="maindiv" style="color:white;">

			<h1>REGISTER</h1>

			<?php include "link.php";?>

				您填寫的表單如下：<br><br>
				姓名：<?php echo $_POST["name"];  ?> <br><br>
				身分證字號：<?php echo $_POST["ssd"];  ?> <br><br>
				電話：<?php echo $_POST["phone"];  ?> <br><br>
				地址：<?php echo $_POST["address"];  ?> <br><br>
				E-Mail：<?php echo $_POST["email"];  ?> <br><br>

				<?php
				/*攜帶登入資訊可以註冊完畢馬上登入*/
				$_SESSION['tempName'] = $_POST["name"]; /*把名字寫進session*/
				$_SESSION['tempSsn'] = $_POST["ssd"]; /*寫Ssn*/
				?>

				<form action="register_finish.php" method="POST">
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