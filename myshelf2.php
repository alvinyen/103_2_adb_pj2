<!DOCTYPE html>
<html>
	<head>
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

		<?php

			$MemId_web=8;
			//鵬倩鵬倩鵬倩鵬倩鵬倩鵬倩鵬倩鵬倩鵬倩鵬倩鵬倩鵬倩鵬倩鵬倩
			//從你的近面進入我的書庫的時要要存取現在使用者的memID
			//可以把它名為MemId_web，然後把上面那一行改成下面那一行嗎
			//$MemId_web=$_POST["MemId_web"];

			//刪除的query
			//$query_del = "DELETE FROM Employee WHERE EmpId= ('".$MemId_web."')";

			//查詢的query
			$query_findName="SELECT t1.ColID, t2.ColName, t2.ColAuthorID, t2.ColISBN, t1.BorrowDate, t1.ReturnDate from (SELECT ColID,BorrowDate,ReturnDate FROM Borrow WHERE MemId= ('".$MemId_web."') ) t1 
			left join (SELECT ColID,ColAuthorID,ColName,ColISBN FROM Collection WHERE ColID IN(SELECT ColID FROM Borrow WHERE MemId= ('".$MemId_web."')) ) t2 on
			    t1.ColID = t2.ColID";

			$query_findDate="SELECT t1.ColID, t2.ColName, t2.ColAuthorID, t2.ColISBN, t1.ArriveDate, t1.ReserveID 
			from 
			(SELECT ColID,ArriveDate,ReserveID FROM Reserve WHERE MemId= ('".$MemId_web."') AND ReserveStatus = '0') t1 
			left join 
			(SELECT ColID,ColAuthorID,ColName,ColISBN FROM Collection WHERE ColID IN(SELECT ColID FROM Reserve WHERE MemId= ('".$MemId_web."')) ) t2 
			on t1.ColID = t2.ColID";
			
			//function section
			function toUTF8($str){
							return iconv("Big5", "UTF-8", $str);
					}

			function date_normalizer($d){
					if($d instanceof  DateTime){
							return $d->getTimestamp();
						}else{
							return strtotime($d);
						}
					}

		?>

	</head>
	<body>

			<h1>我的書庫</h1>

			



			<div class="maindiv" style="color:white;">

				借書狀態
				<table border="1" width=80%  cellspacing=5 cellpadding=16>

					　<tr align=center>
					　<td>館藏編號</td><!-- 在書名之下出現預約按鈕-->
					　<td>書名</td>
					　<td>作者</td>
					　<td>ISBN</td>
					　<td>借書日期</td>
					　<td>還書日期</td>
					　</tr>

					<?php
					header ( "Content-Type:text/html; charset=utf-8" );

					//connection to DB-------------
					$serverName = "CHIH-HSIANG\SQLEXPRESS"; //serverName\instanceName
					$connectionInfo = array( "Database"=>"Library", "UID"=>"sa", "PWD"=>"1234");
					$conn = sqlsrv_connect( $serverName, $connectionInfo);

					if( $conn ) {
	     				//echo "Connection established.<br />";
					}else{
	     				echo "Connection could not be established.<br />";
	     				die( print_r( sqlsrv_errors(), true));
					}
					//connection to DB------------

/*					include "link.php";
					
					$sessionOrNot=true;

					if($sessionOrNot){
						session_start ();
						$_SESSION ['username'] = "yamapi06150@gmail.com";
						$_SESSION ['password'] = "cestlavi";
					}
*/
					

					//=====================================================================

					//$qsql="SELECT * FROM [Library].[dbo].[Collection]";
					
					$stmtOut=sqlsrv_query($conn,$query_findName);
					

					$recno=0;
					
					while($rec=sqlsrv_fetch_array($stmtOut, SQLSRV_FETCH_ASSOC)){
						echo "<tr align=center>";
						
						echo "<td>".$rec["ColID"];
						echo "<td>".$rec["ColName"];
						echo "<td>".$rec["ColAuthorID"];
						echo "<td>".$rec["ColISBN"];

						$tempDate1=date_normalizer($rec["BorrowDate"]);
						$newDate1 = date("l dS F Y",$tempDate1 );
						echo "<td>".$newDate1;

						$tempDate2=date_normalizer($rec["ReturnDate"]);
						$newDate2 = date("l dS F Y",$tempDate2 );
						echo "<td>".$newDate2;

						
					
						echo "</tr>";
						$recno++;
					}
					if($stmtOut){
						//echo "OK";
					}else{
						die( print_r( sqlsrv_errors(), true));
					}
					sqlsrv_free_stmt( $stmtOut);
					sqlsrv_close( $conn);

					?>
				</table>

				預約狀態
				<table border="1" width=80%  cellspacing=5 cellpadding=16>

					　<tr align=center>
					　<td>館藏編號</td><!-- 在書名之下出現預約按鈕-->
					　<td>書名</td>
					　<td>作者</td>
					　<td>ISBN</td>
					　<td>到館日期</td>
					  <td>取消預約</td>
					　</tr>

					<?php
					header ( "Content-Type:text/html; charset=utf-8" );

					//connection to DB-------------
					$serverName = "CHIH-HSIANG\SQLEXPRESS"; //serverName\instanceName
					$connectionInfo = array( "Database"=>"Library", "UID"=>"sa", "PWD"=>"1234");
					$conn = sqlsrv_connect( $serverName, $connectionInfo);

					if( $conn ) {
	     				//echo "Connection established.<br />";
					}else{
	     				echo "Connection could not be established.<br />";
	     				die( print_r( sqlsrv_errors(), true));
					}
					//connection to DB------------

/*					include "link.php";
					
					$sessionOrNot=true;

					if($sessionOrNot){
						session_start ();
						$_SESSION ['username'] = "yamapi06150@gmail.com";
						$_SESSION ['password'] = "cestlavi";
					}
*/
					

					//=====================================================================

					//$qsql="SELECT * FROM [Library].[dbo].[Collection]";
					
					$stmtIn=sqlsrv_query($conn,$query_findDate);
					

					$recno=0;
					$revcolID="";
					$revcolName="";
					$revcAuthName="";
					$revcolISBN="";
					$revDate="";
					$RevID="";
					
					while($rec=sqlsrv_fetch_array($stmtIn, SQLSRV_FETCH_ASSOC)){
						echo "<tr align=center>";
						
						echo "<td>".$rec["ColID"];
						$revcolID=$rec["ColID"];
						echo "<td>".$rec["ColName"];
						$revcolName=$rec["ColName"];
						//echo "<td>".$rec["ColAuthorID"];

						//authorID查姓名----------
						//global $conn,$query_findName,$params;
						
						$query_findName="SELECT AuthorName FROM Author WHERE AuthorID=('".$rec["ColAuthorID"]."')";
						//echo $query_findName;
						$stmt = sqlsrv_query( $conn, $query_findName);
						if( $stmt === false ) {
		     			die( print_r( sqlsrv_errors(), true));
		     			}
		     			//echo "1";
						while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
							echo "<td>".$row["AuthorName"];
							$revcAuthName=$row["AuthorName"];
						//echo "2";
						}
						//authorID查姓名----------

						echo "<td>".$rec["ColISBN"];
						$revcolISBN=$rec["ColISBN"];

						$tempDate1=date_normalizer($rec["ArriveDate"]);
						$newDate1 = date("l dS F Y",$tempDate1 );
						echo "<td>".$newDate1;
						$revDate=$newDate1;

						$RevID=$rec["ReserveID"]; 


						echo "<td>
						<form  action= \"cancle_rev.php\" method=\"POST\">
							<input type=\"hidden\" name=\"revNa\" value=\"".$revcolName. " \" />
							<input type=\"hidden\" name=\"revid\" value=\"".$revcolID. " \" />
							<input type=\"hidden\" name=\"Memrevid\" value=\"".$RevID. " \" />
							<input type=\"hidden\" name=\"revAuNa\" value=\"".$revcAuthName. " \" />
							<input type=\"hidden\" name=\"revISBN\" value=\"".$revcolISBN. " \" />
							<input type=\"hidden\" name=\"revDa\" value=\"".$revDate. " \" />
							<input type=\"hidden\" name=\"MemId_web\" value=\"".$MemId_web. " \" />
							<button type=\"submit\" value=\"finish\" class=\"button_login\" style=\"color:white;\">取消預約</button>
				
						</form>";


						
					
						echo "</tr>";
						$recno++;
					}
					if($stmtOut){
						//echo "OK";
					}else{
						die( print_r( sqlsrv_errors(), true));
					}
					sqlsrv_free_stmt( $stmtOut);
					sqlsrv_close( $conn);

					?>
				</table>

				
			
				<form action="employee_delete_finish.php" method="POST">
					<input type="hidden" name="sql" value="<?php echo $query_del; ?>" />
					<!--
					<input type="hidden" name="member_name" value="<?php 
						$stmt = sqlsrv_query( $conn, $query_findName, $params);
							if( $stmt === false ) {
	     						die( print_r( sqlsrv_errors(), true));
	     					}
						while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
						echo $row['EmpName'];
					?>" />
					-->
					<button type="submit" value="finish" class="button_login" style="color:white;">刪除</button>
				</form>
			</div>


	</body>
</html>