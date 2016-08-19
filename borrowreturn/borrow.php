<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<?php include"../header.php";?>

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

		<?php
			include "../link.php";
			$employeeid = $_SESSION['EmpID'];

		?>

	</head>
	<body>



	<div id="container">
		<?php include"banner.php";   /*這一個是最上方的banner*/?>
		<br>
	<div id="centermain">
		<div id="sidebar">

		<?php include "sidebar.php";?>

		</div>
		<div id="sidebody">

			<h1>借書</h1>

			<div class="maindiv" style="color:white;">

				<form class="cmxform" id="commentForm" action= "borrow_query.php" method="POST">
				
					<label for="cid">借書人ID：</label>
					<input id="cid" type="text" name="member_id" required>
					<br><br>
					<label for="ccol">館藏ID：</label>
					<input id="ccol" type="text" name="collection_id" required>
					<br><br>
					<input type="hidden" name="employee_id" value="<?php echo $employeeid; ?>" />
					<button type="submit" value="送出" class="button_login" style="color:white;">送出</button>
				
				</form>

			</div>

		</div>

	</div>
	    	<div id="clear"></div>
</div>




	</body>
</html>