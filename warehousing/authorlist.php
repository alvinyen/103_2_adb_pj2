<?php
$param=$_GET['q'];

include"link.php";
$query_author = "SELECT * FROM AUTHOR where AuthorName like '$param%'";
$find_author = sqlsrv_query ( $conn, $query_author );
while ( $findRec = sqlsrv_fetch_array ( $find_author , SQLSRV_FETCH_ASSOC ) ) 
{
	echo $findRec['AuthorName']."\n";
}?>