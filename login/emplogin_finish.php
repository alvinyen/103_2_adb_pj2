<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
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

		<div class="maindiv"> 
		<h1>登入</h1> <br>

		<?php include "../link.php";

		$EmpSsn = $_POST['EmpSsn'];
		$EmpID = $_POST['EmpID'];

		$login = "SELECT * FROM Employee WHERE EmpSsn = '".$EmpSsn."' AND EmpID='".$EmpID."'";
		$stmt = sqlsrv_query( $conn, $login );

		if ( sqlsrv_has_rows($stmt) )
		{
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			{
			
			$_SESSION['EmpName'] = $row['EmpName']; /*把名字寫進session*/
			$_SESSION['EmpID'] = $row['EmpID']; /*寫ID*/
			$_SESSION['EmpSsn'] = $row['EmpSsn']; /*寫Ssn*/
			
			}
      		echo $_SESSION['EmpName']."登入成功，歡迎回來！";
			echo "<meta http-equiv=REFRESH CONTENT=1;url=../empmain.php>";
		}		
		else 
		{
			echo"登入訊息有誤，請重新輸入！";
			echo "<meta http-equiv=REFRESH CONTENT=1;url=login.php>";
		}
		?>

		<?php /*<button value="back" class="button_login" style="color:white;" onclick="javascript:location.href='main.php'">回首頁</button>*/?>

		<br>
		</div>

		</div>
	</div>

	    	<div id="clear"></div>
</div>
</body>
</html>