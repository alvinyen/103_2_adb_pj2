<?php session_start(); ?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php include"../header.php";
			include"link.php";?>
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

			<h1>館藏查詢</h1>
			
			<div class ="maindiv" style="color:white;">	
			<form id="target" name="form1" method="post" action="reserv_1.php">
		<p>
			查詢項： <select name="searchType" onChange="location = this.options[this.selectedIndex].id;">
				<option id="search_1.php" value="0">請選擇</option>
				<option id="search_1_1.php" value="1">書名</option>
				<option id="search_1_2.php" value="2">館藏類型</option>
				<option id="search_1_3.php"value="3" selected="selected">館藏地</option>
			</select>
		</p>
		</br>

		<p>
			館藏地： <select name="searchText">
			<?php
			$findLocation = sqlsrv_query ( $conn, "select * FROM Library" );
			while ( $findRec = sqlsrv_fetch_array ( $findLocation, SQLSRV_FETCH_ASSOC ) ) {
			?>
			<option value="<?php echo $findRec['LibraryID'];?>">
			<?php
			$LibraryName = $findRec['LibraryName'];
			echo $LibraryName;
			echo "</option>";
			}
			sqlsrv_free_stmt ( $findLocation );
			?>
			</select>
		</p>
		</br>
		<input type="submit" value="submit" >
	</form>

				</div>

		</div>

	</div>
	    	<div id="clear"></div>
</div>


	
</body>
</html>
