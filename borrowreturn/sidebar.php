
			哈囉
			
			<?php 
				if ( isset($_SESSION['MemName']) )
				{
					echo $_SESSION['MemName']."，<br>歡迎使用Library<br>";
				}
				else if ( isset($_SESSION['EmpName']) )
				{
					echo $_SESSION['EmpName']."，<br>歡迎使用Library<br>";
				}
				else
				{
					echo "～您尚未登入！<br>";?>
					新會員請<a href="../register.php">點我註冊</a><br>
				<?php
				}
			?>

			<br>
			
			<form action= "borrow.php" method="POST">
				<button class="button_transport" type="submit" name="transport">運送</button>
			</form>

			<?php
			include "link.php";

			$today = date("Y-m-d");
			$DueDate = date("Y-m-d", strtotime($today."+5 day"));

   			if(isset($_POST['transport'])){
      			$sql_reserve="SELECT * FROM Reserve WHERE Status = 0";
      			$params_reserve = array(1, "some data");
					$stmt_reserve = sqlsrv_query( $conn, $sql_reserve, $params_reserve);
					if( $stmt_reserve === false ) {
    		 			die( print_r( sqlsrv_errors(), true));
					}
					while( $row_reserve  = sqlsrv_fetch_array( $stmt_reserve , SQLSRV_FETCH_ASSOC) ) 
					{
						$colid = $row_reserve ['ColID'];

						echo ":::colid:::".$colid.":::<br>";

						$sql_select_reserve_collection_location = "SELECT * FROM Reserve WHERE ColID = ".$colid;

						$params_select_reserve_collection_location = array(1, "some data");
						$stmt_select_reserve_collection_location = sqlsrv_query( $conn, $sql_select_reserve_collection_location, $params_select_reserve_collection_location);
						if( $stmt_select_reserve_collection_location === false ) {
    		 				die( print_r( sqlsrv_errors(), true));
						}
						while( $row_select_reserve_collection_location  = sqlsrv_fetch_array( $stmt_select_reserve_collection_location , SQLSRV_FETCH_ASSOC) ) 
						{
							$location = $row_select_reserve_collection_location['LibraryID'];
							if($location = 1)
							{
								$location_l = 2;
							}else{
								$location_l = 1;
							}
						}
						echo "DueDate:::".$DueDate.":::<br>";
						echo "location:::".$location.":::<br>";
						echo "location_l:::".$location_l.":::<br>";

/* false
						$sql_update_reserve="UPDATE Reserve SET Status = '1', DueDate='".$DueDate."' WHERE ColID = ".$colid;

*/
						$sql_update_reserve="UPDATE Reserve SET ArriveDate = '".$today."',DueDate='".$DueDate."' WHERE ColID = ".$colid;

						echo ":::update_reserve:::".$sql_update_reserve.":::<br>";

						$params_update_reserve = array(1, "some data");
						$stmt_update_reserve = sqlsrv_query( $conn, $sql_update_reserve, $params_update_reserve);
						if( $stmt_update_reserve === false ) {
    		 				die( print_r( sqlsrv_errors(), true));
						}

						$sql_update_collection="UPDATE Collection SET ColStatus = '2', ColLocation = '".$location."' WHERE ColID = ".$colid;

						echo ":::update_collection:::".$sql_update_collection.":::<br>";

						$params_update_collection = array(1, "some data");
						$stmt_update_collection = sqlsrv_query( $conn, $sql_update_collection, $params_update_collection);
						if( $stmt_update_collection === false ) {
    		 				die( print_r( sqlsrv_errors(), true));
						}

						echo"有一本書悄悄的被搬運了...<br>";

					}

    		}

		?>
<br>
			<img src="book.png" width="150">
