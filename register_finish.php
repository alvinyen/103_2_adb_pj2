<?php session_start();?>
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

	</head>



	<body>

			<div id="container">
		<?php include"banner.php";   /*這一個是最上方的banner*/?>
		<br>
	<div id="centermain">
		<div id="sidebar">

			<?php include"sidebar.php";?>

		</div>
		<div id="sidebody">

			<h1>REGISTER</h1>


			<?php include "link.php";

			$sql = $_POST["sql"];
			$name = $_POST["member_name"];

			$params = array(1, "some data");


			$stmt = sqlsrv_query( $conn, $sql, $params);
			if( $stmt === false ) {
     			die( print_r( sqlsrv_errors(), true));
			}

			//echo $sql;
			//echo $name;


			?>

			<div class="maindiv" style="color:white;">

				恭喜 ! <?php echo $_POST["member_name"]; ?> 先生/女士<br><br>完成了註冊！

			<?php 

			$findNumber = "SELECT MemId FROM Member WHERE MemName = '".$_POST["member_name"]."'";
			$findResult = sqlsrv_query( $conn, $findNumber, $params);
			if( $findResult === false ) {
     			die( print_r( sqlsrv_errors(), true));
     		}
     		else
     		{
     			while( $row = sqlsrv_fetch_array( $findResult, SQLSRV_FETCH_ASSOC) ) 
				{
					echo "您是我們第 ".$row['MemId']." 號 會員，請務必牢記您的信箱，會作為密碼使用！<br>";
					$_SESSION['MemID'] = $row['MemId']; /*寫ID*/
				}
     		}

			
			/*註冊完畢就是登入狀態*/
			$_SESSION['MemName'] = $_SESSION["tempName"]; /*把名字寫進session*/
			$_SESSION['MemSsn'] = $_SESSION['tempSsn']; /*寫Ssn*/
			
			/*清掉帶過來的暫時資訊*/
			unset($_SESSION['tempName'] );
			unset($_SESSION['tempSsn'] );
			?>
				<button value="back" class="button_login" style="color:white;" onclick="javascript:location.href='main.php'">回首頁，開始使用Library</button>

			</div>

		</div>

	</div>
	    	<div id="clear"></div>
</div>

			


	</body>
</html>