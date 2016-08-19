<?php
	session_start();
	$_SESSION['ColID']=$_POST['ColID'];
	echo $_SESSION['ColID'];
?>