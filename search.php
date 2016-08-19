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

			<h1>館藏搜尋</h1>

<?php

	include "link.php";
?>
			<div class="maindiv" style="color:white;">

				<form class="cmxform" id="commentForm" action= "search_list.php" method="POST">
					進階搜尋：<br><br>
					<label for="ColName">書名：</label>
					<input id="ColName" type="text" name="name">
					<br><br>
					<label for="ColAuthor">作者：</label>
					<input id="ColAuthor" type="text" name="name">
					<br><br>
					<label for="keyword">關鍵字：</label>
					<input id="keyword" type="text" name="keyword">
					<br><br>
					<button type="submit" value="finish" class="button_login" style="color:white;">搜尋</button>
				
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