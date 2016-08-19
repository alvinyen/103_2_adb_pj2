<?php
	$serverName = "BLUEFLAME\DBYEN"; //serverName\instanceName
	$connectionInfo = array( "Database"=>"Library", "UID"=>"sa", "PWD"=>"1234",	"CharacterSet"=>"UTF-8");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
	if( $conn ) 
	{
     	/*echo "Connection established.<br />";*/
		}
		else
		{
     		/*echo "Connection could not be established.<br />";*/
     		die( print_r( sqlsrv_errors(), true));
     	}
?>	
