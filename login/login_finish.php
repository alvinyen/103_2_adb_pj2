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

		$ssn = $_POST['ssn'];
		$email = $_POST['email'];

		$login = "SELECT * FROM Member WHERE MemSsn = '".$ssn."' AND MemEmail='".$email."'";
		$stmt = sqlsrv_query( $conn, $login );

		if ( sqlsrv_has_rows($stmt) )
		{
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			{
			
			$_SESSION['MemName'] = $row['MemName']; /*把名字寫進session*/
			$_SESSION['MemID'] = $row['MemID']; /*寫ID*/
			$_SESSION['MemEmail'] = $row['MemEmail']; /*寫Ssn*/
			
			}
      		echo $_SESSION['MemName']."登入成功！";
      		echo "<meta http-equiv=REFRESH CONTENT=1;url=../main.php>";	
      		?>
      		
<?php		}		
		else 
		{
			echo"登入訊息有誤，請重新輸入！";
			echo "<meta http-equiv=REFRESH CONTENT=1;url=login.php>";
		}
		

		/*<button value="back" class="button_login" style="color:white;" onclick="javascript:location.href='main.php'">回首頁</button>*/
?>
		<br>
		</div>

		</div>
	</div>

	    	<div id="clear"></div>
</div>



		





</body>
</html>