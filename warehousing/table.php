<?php session_start();?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
	include"../header.php";
	include"link.php";?>
<link href="../autocomplete/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script src="../jquery.js" type="text/javascript"></script>
<script src="../autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
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
			<h1>館藏入庫</h1>

<div class="maindiv" style="color:white;">

<form name="form1" method="post" action="tableCheck.php">

分類號：<input name="ColClass" type="text"></br></br>


作者：
<input  type="text" id="author" name="AuthorName">
<script type="text/javascript">
$(function(){
$("#author").focus().autocomplete("authorlist.php", {
//author為文字框的id。資料來源為authorlist.php檔
//有許多參數可以設定，以下列出可能會用到的:
minChars:0,
//當輸入多少字元時出現建議選單，若設定為0，則當文字框被點選而尚未有文字輸入時，也會有建議選單出現
//width: 200,
//建議選單的寬度
selectFirst: true,
//自動選取建議選單的第一個值
scrollHeight: 300,
//設定建議選單產生捲軸 (scroll: true(預設))時可以設定建議選單的高度
autoFill: true
//自動在文字框欄位中填入建議值
});
});
</script>
</br></br>

書名：<input name="ColName" type="text"></br></br>

版本：<input name="ColVersion" type="text" size=5>
出版日期：
<select name="year">
<?php for ($i=1990;$i<=2015;$i++){?>
	<option value=<?php echo $i;?> ><?php echo $i ?></option>
<?php } ?>
</select>年

<select name="month">
<?php for ($i=1;$i<=12;$i++){?>
	<option value=<?php echo $i;?> ><?php echo $i ?></option>
<?php } ?>
</select>月


</br></br>


ISBN:<input name="ColISBN" type="text">
</br></br>

館藏所在地：
<select name="ColLocation">
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
</br></br>

館藏類型：<select name="CollectionTypeID">
<?php
$findType = sqlsrv_query ( $conn, "select * FROM CollectionType" );
while ( $findRec = sqlsrv_fetch_array ( $findType, SQLSRV_FETCH_ASSOC ) ) {
			?>
			<option value="<?php echo $findRec['CollectionTypeID'];?>">
			<?php
			$TypeName = $findRec['CollectionTypeName'];
			echo $TypeName;
			echo "</option>";
		}
sqlsrv_free_stmt ( $findType );
?>
</select>
</br></br>

<button type="submit" value="finish" class="button_login" style="color:white;">新增</button>

</form>

</div>

		</div>

	</div>
	    	<div id="clear"></div>
</div>


</body>
</html>