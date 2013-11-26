<?php
session_start();

	$adcount=0;
	if($_POST["id"]==$_POST["nota"])
		$adcount=1;
	else
		$adcount=0;
	
	$_SESSION["adcount"]=$adcount;
	
	header("location: jogo.php");
?>