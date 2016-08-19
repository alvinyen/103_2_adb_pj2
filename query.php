<!DOCTYPE html>
<html>
	<head>
		<link rel=stylesheet type="text/css" href="CSS.css">
	</head>
	<body>

			<h1>SEARCH RESULT</h1>

			<?php
				$con = mysql_connect("localhost","root","root");
				if (!$con){die('Could not connect: ' . mysql_error());}

				$dbname = "Library";

				mysql_select_db($dbname);//選擇要使用哪一個資料庫 ?>

			<div class="maindiv" style="color:white;">

				<?php

				echo "您搜尋的書名為： ".$_POST["book_name"]."<br><br>";

				$sql_search = "SELECT * FROM Collection WHERE book_name = '".$_POST["book_name"]."'";

						$result_search = mysql_query($sql_search);

						//echo $sql_search;
						?>

						<table border="0">

     							<tr>
       								<td>id</td>
       								<td>name</td>
       								<td>author</td>
     							</tr>
						<?php
						while($row_search = mysql_fetch_array($result_search)){ 
							$id = $row_search['id'];
							$name = $row_search['book_name'];
							$author = $row_search['author'];
        				?>
							<tr>
								<td><?php echo $id ?></td>
								<td><?php echo $name ?></td>
								<td><?php echo $author ?></td>
							</tr>

						<?php
    					} 

				?>

				</table>

			</div>
	</body>
</html>