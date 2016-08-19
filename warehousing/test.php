
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
</head>
<body>
<?php
header ( "Content-Type:text/html; charset=utf-8" );

/*
session_start ();
$_SESSION ['username'] = "Ken";
$_SESSION ['password'] = "cestlavi";
*/
$searchText="HTML";
echo "SELECT * FROM [Library].[dbo].[Collection] where [ColName] LIKE '%".$searchText."%'";


/*
if (isset ( $_SESSION ['username'] )) {
	echo $_SESSION ['username'] . "<br/>";
	echo $_SESSION ['password'];
} else {
	echo "未設定成功";
}
*/

?>

</br>
<input type="submit" value="submit" onclick="location.href='table.php'">


</body>


</html>