<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
	<?php include"../header.php";?>

		<script type="text/javascript">

			/*function check(){
				if (regi.name.value==""){
					alert("請輸入姓名");
				}
			};*/

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

			
					<h1>人員管理</h1>

			<?php include"../link.php";?>

			<?php if( isset($_SESSION['EmpID'])) # 檢查此員工是否為主管(LibraryChief)
			{
				$isChief = 0;

				$findChief= "SELECT LibraryChief FROM Library";
				$findChiefResult = sqlsrv_query( $conn, $findChief );
				while( $row = sqlsrv_fetch_array( $findChiefResult, SQLSRV_FETCH_ASSOC) ) 
				{
					$LibraryChief = $row["LibraryChief"];
					if ( $_SESSION['EmpID'] === $LibraryChief )
					{
						$isChief = 1;
					}
					
				}

				if ( $isChief !== 1 )
				{
					echo "<script>alert('您無權使用此功能！');</script>";
					echo "<meta http-equiv=REFRESH CONTENT=1;url=../empmain.php>";
				}
			} # 檢查完畢
			else { echo"請先登入";}

		
			?>


			<div class="maindiv" style="color:white;">

				<form class="cmxform" id="commentForm" action= "employee_confirm.php" method="POST">
					<h3>新增員工</h3>
					<label for="cname">姓名：</label>
					<input id="cname" type="text" name="name" required>
					<br><br>
					<label for="cssd">身分證字號：</label>
					<input id="cssd" class="digits" type="text" name="ssd" required maxlength="10">
					<br><br>
					<label for="cphone">員工所在分館：</label>
					<!--<input id="cphone" type="text" name="type" required maxlength="11">-->

					<select id="cphone" type="text" name="type" style="width: 227px; height: 20px" required>
					<option></option>
					<?php

						$LibraryName="";
						$query_findName="SELECT LibraryID,LibraryName FROM Library ";
						//echo $query_findName;
						$stmt = sqlsrv_query( $conn, $query_findName);
						if( $stmt === false ) {
		     			die( print_r( sqlsrv_errors(), true));
		     			}
		     			//echo "1";
						while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
							$LibraryName=$row["LibraryName"];
							echo "<option value=\"".$row["LibraryID"]."\">".$LibraryName."</option>";
						//echo "2";
						}

					?>
<!--
					<option value="1">第一分館</option>
					<option value="2">第二分館</option>
					<option value="3">第三分館</option>
				-->
					</select>


					<br><br>
					<label for="caddress">薪資等級：</label>
					<input id="caddress" type="text" name="salary" required>
					<button type="submit" value="finish" class="button_login" style="color:white;">新增</button>
				
				</form>

				<br><br>

				<form class="cmxform" id="commentForm" action= "employee_delete.php" method="POST">
					<h3>刪除員工</h3>
					<label for="cname">員工代號：</label>
					<input id="cname" type="text" name="empId" required>
					

					<button type="submit" value="finish" class="button_login" style="color:white;">刪除</button>
				
				</form>

			</div>





		</div>

	</div>
	    	<div id="clear"></div>
</div>


<br>
<br>
<br>
<br>
<br>
<br><br>
<br>
<br>




	</body>
</html>