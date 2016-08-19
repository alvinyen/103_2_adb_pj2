<!DOCTYPE html>
<html>
	<head>
		<link rel=stylesheet type="text/css" href="CSS.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
   		<link rel="stylesheet" href="banner.css">
   		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   		<script src="banner_script.js"></script>
	</head>
	<body>
		<div id='cssmenu' style="font-family:Microsoft JhengHei;font-size:250px;">
			<ul>
   				<li><a href='main.php'>Home</a></li>
   				<li><a href=''>館藏搜尋</a></li>
   				<li><a href='#'>個人書房</a></li>
   				<li><a href='login.php'>登入</a></li>
			</ul>

		</div>
		<div class="maindiv">
			<form action= "transport.php" method="POST">
				<button class="button_transport" type="submit" name="transport">運送</button>
			</form>
		</div>

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


						$sql_update_reserve="UPDATE Reserve SET Status = '1', DueDate='".$DueDate."' WHERE ColID = ".$colid;

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



					}

    		}

		?>

	</body>
</html>