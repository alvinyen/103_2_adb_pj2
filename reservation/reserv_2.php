<?php session_start(); ?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
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

			<h1>館藏預約</h1>

<div class ="maindiv" style="color:white;">

	請選擇欲取書之分館：<br>

	<form id="target" name="form1" method="post" action="reserv_3.php">
		<table border="1" width=80% cellspacing=5 cellpadding=16>
		<?php

		include "link.php";
		function toUTF88($str) {
			return $str;
			// return iconv("Big5", "UTF-8", $str);
		}
		
		$stmt = sqlsrv_query ( $conn, "select * FROM Library" );
		$recno = 0;
		while ( $rec = sqlsrv_fetch_array ( $stmt, SQLSRV_FETCH_ASSOC ) ) {
			echo "<tr align=center>";
			$lid = $rec ["LibraryID"];
			$ladd = $rec ["LibraryAddress"];
			echo "<td><input type=\"radio\" name=\"location\" value=\"$lid\">" . toUTF88 ( $rec ["LibraryName"] ) . "</td>";
			echo "<td>" . toUTF88 ( $ladd ) . "</br>";
			echo "</tr>";
			$recno ++;
		}
		sqlsrv_free_stmt ( $stmt );
		sqlsrv_close ( $conn );
		?>
		</table>
		<input type="submit" value="Submit">

	</form>

</div>

</div>

	</div>
	    	<div id="clear"></div>
</div>


</body>
</html>







