<?php 
	$username = "root";
	$password = "";
	$host = "localhost:3306";
	$sqlname = "test";
	$mysqli = new mysqli($host, $username, $password, $sqlname);
	if (mysqli_connect_errno()) {
		echo "<br /><b>连接至数据库失败！</b>";
		exit();
	}
 ?>