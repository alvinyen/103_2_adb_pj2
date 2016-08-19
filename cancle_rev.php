<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<?php include"header.php";?>
		<link rel=stylesheet type="text/css" href="CSS.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="jquery.js" type="text/javascript"></script>
		<script src="jquery.validate.js" type="text/javascript"></script>
		<script src="cmxforms.js" type="text/javascript"></script>

		<script type="text/javascript">
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
			<h1>取消預約</h1>

			<?php
				
			include "link.php";

				$query="UPDATE Reserve
						SET Status = 2
						WHERE ReserveID = '".$_POST["Memrevid"]."' ;";

			?>

			<div class="maindiv" style="color:white;">

				您預計取消預約的館藏資料如下：<br><br>
				<table border="1" width=80%  cellspacing=5 cellpadding=16>

					　<tr align=center>
					　<td>館藏編號</td><!-- 在書名之下出現預約按鈕-->
					　<td>書名</td>
					　<td>作者</td>
					　<td>ISBN</td>
					　<td>到館日期</td>
					　</tr>

					  <tr align=center>
					　<td><?php echo $_POST["revid"];  ?></td><!-- 在書名之下出現預約按鈕-->
					　<td><?php echo $_POST["revNa"];  ?></td>
					　<td><?php echo $_POST["revAuNa"];  ?></td>
					　<td><?php echo $_POST["revISBN"];  ?></td>
					　<td><?php echo $_POST["revDa"];  ?></td>
					　</tr>
		

				</table>
				
				<form action="canRev_finish.php" method="POST">
					<input type="hidden" name="sql" value="<?php echo $query; ?>" />
					<input type="hidden" name="MemId_web" value="".$MemId_web. " " />
					<button type="submit" value="finish" class="button_login" style="color:white;">確認</button>
				</form>
			</div>

			</div>

	</div>
	    	<div id="clear"></div>
</div>


	</body>
</html>