<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include"header.php";?>
	</head>
	<body>



		
	<div id="container">
		<?php include"banner.php";   /*這一個是最上方的banner*/?>
		<br>
	<div id="centermain">
		<div id="sidebar">

			這一區是左邊欄位<br>
			可以用 include "sidebar.php"<br>

		</div>
		<div id="sidebody">

			這裡就4主要的內容區囉

			<h1>h1標籤長這樣</h1>
			<h2>h2標籤長這樣</h2>
			<h3>h3標籤長這樣</h3>

			<div class ="maindiv" style="color:white;">
			maindiv框框長這樣
			</div>

		</div>

	</div>
	    	<div id="clear"></div>
</div>


</body>
</html>