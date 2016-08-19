<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<?php include"header.php";?>

		<script type="text/javascript">

			/*function check(){
				if (regi.name.value==""){
					alert("請輸入姓名");
				}
			};*/

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

			<h1>REGISTER</h1>

<?php

	include "link.php";
?>
			<div class="maindiv" style="color:white;">

				<form class="cmxform" id="commentForm" action= "register_confirm.php" method="POST">
				
					<label for="cname">姓名：</label>
					<input id="cname" type="text" name="name" required>
					<br><br>
					<label for="cssd">身分證字號：</label>
					<input id="cssd" class="digits" type="text" name="ssd" required maxlength="10">
					<br><br>
					<label for="cphone">電話：</label>
					<input id="cphone" type="text" name="phone" required maxlength="11">
					<br><br>
					<label for="caddress">居住地址：</label>
					<input id="caddress" type="text" name="address" required>
					<br><br>
					<label for="cemail">E-Mail：</label>
					<input id ="cemail" class="email" type="text" name="email" required>
					<br><br>
					<button type="submit" value="finish" class="button_login" style="color:white;">完成</button>
				
				</form>

			</div>


		</div>

	</div>
	    	<div id="clear"></div>
</div>
</body>
</html>














	<body>

			



	</body>
</html>