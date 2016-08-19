<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include"header.php";?>

		<script type="text/javascript">
			$(function(){
				//須與form表單ID名稱相同
				$("#commentForm").validate();
			});
		</script>

		<?php
			include "link.php";
			//刪除的query
			//$query_del = "DELETE FROM Employee WHERE EmpId= ('".$MemId_web."')";
			
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

			<?php
			if( !isset($_SESSION['MemID'])) # 找session中會員號碼 沒找到
			{
				echo "<script>alert('您可能尚未登入，或閒置過久已自動登出。請登入以使用個人書房功能！');</script>";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=login/login.php>";
			}
			else{	

			$MemId_web = $_SESSION['MemID']; 
			//查詢的query
			$query_findName="SELECT t1.ColID, t2.ColName, t2.ColAuthorID, t2.ColISBN, t1.BorrowDate, t1.ReturnDate from (SELECT ColID,BorrowDate,ReturnDate FROM Borrow WHERE MemId= ('".$MemId_web."') ) t1 
			left join (SELECT ColID,ColAuthorID,ColName,ColISBN FROM Collection WHERE ColID IN(SELECT ColID FROM Borrow WHERE MemId= ".$MemId_web.") ) t2 on
			    t1.ColID = t2.ColID";

			$query_findDate="SELECT t1.ColID, t2.ColName, t2.ColAuthorID, t2.ColISBN, t1.ArriveDate, t1.ReserveID 
			from 
			(SELECT ColID,ArriveDate,ReserveID FROM Reserve WHERE MemId= ('".$MemId_web."') AND Status = '0') t1 
			left join 
			(SELECT ColID,ColAuthorID,ColName,ColISBN FROM Collection WHERE ColID IN(SELECT ColID FROM Reserve WHERE MemId= ".$MemId_web.") ) t2 
			on t1.ColID = t2.ColID";
			?>

<div id="container">

		<?php include"banner.php";?>
		<br>
	<div id="centermain">
		<div id="sidebar">
			<?php include"sidebar.php";?>
		</div>
		<div id="sidebody">

			<h1>我的書庫</h1>
			<div class="maindiv" style="color:white;">
				<h3>目前預約中清單</h3>		


					<?php
					$stmtIn = sqlsrv_query($conn,$query_findDate);
					$revcolID="";
					$revcolName="";
					$revcAuthName="";
					$revcolISBN="";
					$revDate="";
					$RevID="";

					if ( !sqlsrv_has_rows( $stmtIn ) )
					{
						echo "您目前沒有預約紀錄！<br>";
					}
					else
					{
					?>

				<table border="1" width=80%  cellspacing=5 cellpadding=16>

					　<tr align=center>
					　<td>書名</td>
					　<td>作者</td>
					　<td>ISBN</td>
					　<td>到館日期</td>
					  <td>預約狀態</td>
					　</tr>

					<?php
					while( $rec = sqlsrv_fetch_array( $stmtIn, SQLSRV_FETCH_ASSOC ) )
					{
						echo "<tr align=center>";
						// 不需要印館藏編號 
						// echo "<td>".$rec["ColID"];
						$revcolID=$rec["ColID"];
						//館藏名稱
						echo "<td>".$rec["ColName"]."</td>";
						$revcolName=$rec["ColName"];
						
						//query指令 著者名稱
						$findName2="SELECT * FROM Author WHERE AuthorID=".$rec["ColAuthorID"];

						$stmt = sqlsrv_query( $conn, $findName2);
						if( $stmt === false ) 
							{echo"找不到";die( print_r( sqlsrv_errors(), true));}

						while( $name = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
						{
						//印作者
						echo "<td>".$name["AuthorName"]."</td>";
						$revcAuthName=$name["AuthorName"];
						}

						//印ISBN
						echo "<td>".$rec["ColISBN"]."</td>";
						$revcolISBN=$rec["ColISBN"];
						//印到館日
						if ( is_null($rec["ArriveDate"]))
						{
							$RevID=$rec["ReserveID"];
							$newDate1 = "尚未到館";	
							$revDate=$newDate1;
						}
						else
						{
							$tempDate1=date_normalizer($rec["ArriveDate"]);
							$newDate1 = date("l dS F Y",$tempDate1 );
							$revDate=$newDate1;
						}
						echo "<td>".$newDate1;

if ( !is_null($rec['ArriveDate']))
{
	echo"<td>請盡速取書!";
}
else
{
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
						</form></td>";
						echo "</tr>";				
}
				}
					/*sqlsrv_free_stmt( $stmtIn);*/
					/*sqlsrv_close( $conn);*/
					echo"</table>";
				}
					?>
				

				<br>
				<h3>歷史借閱紀錄</h3>
				<table border="1" width=80%  cellspacing=5 cellpadding=16>
					　<tr align=center>
					　
					  <?php /*不需要印<td>館藏編號</td>*/?>

				<?php
					$stmtOut=sqlsrv_query($conn,$query_findName);
					$recno=0;

					if ( !sqlsrv_has_rows( $stmtOut ) )
					{
						echo "開始借閱您的第一本書吧...<br>";
					}
					else
					{
					 ?>
					 <td>書名</td>
					　<td>作者</td>
					　<td>ISBN</td>
					　<td>借書日期</td>
					　<td>還書日期</td>
					　</tr>	
					<?php
					while($rec=sqlsrv_fetch_array($stmtOut, SQLSRV_FETCH_ASSOC))
					{
						echo "<tr align=center>";
						
						//不需要館藏編號
						//echo "<td>".$rec["ColID"];

						//館藏名稱
						echo "<td>".$rec["ColName"];

						//館藏作者 額....編號
						//echo "<td>".$rec["ColAuthorID"];

						$findName2="SELECT AuthorName FROM Author WHERE AuthorID=".$rec["ColAuthorID"];

						$stmt = sqlsrv_query( $conn, $findName2);
						if( $stmt === false ) 
							{die( print_r( sqlsrv_errors(), true));}
						while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
						{
						//印作者
						echo "<td>".$row["AuthorName"];
						}

						//館藏ISBN
						echo "<td>".$rec["ColISBN"];

						//借書日期
						$tempDate1=date_normalizer($rec["BorrowDate"]);
						$newDate1 = date("l dS F Y",$tempDate1 );
						echo "<td>".$newDate1;


						//還書日期
						//若為null則顯示尚未歸還
						if( is_null($rec["ReturnDate"]) )
						{
							$newDate2 = "尚未歸還";
						}
						else
						{
							$tempDate2=date_normalizer($rec["ReturnDate"]);
							$newDate2 = date("l dS F Y",$tempDate2 );
						
						}
						echo "<td>".$newDate2;

						echo "</tr>";
						$recno++;
					}
					echo "</table>";
					if($stmtOut)
					{
						//echo "OK";
					}else{
						die( print_r( sqlsrv_errors(), true));
					}
					sqlsrv_free_stmt( $stmtOut);
					?>
				
				<?php	}} /*最外面else的框框 不要刪掉*/?>			

			</div>

	</div>
	    	<div id="clear"></div>
</div>


	</body>
</html>


<?php /*
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
				*/?>