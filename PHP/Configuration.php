<html>
	<head>
    <!-- HTTP Header -->
		<meta http-equiv="Refresh" content="1200" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Other Header -->
		<meta name="robots" content="index" />
		<meta name="keywords" content="Test, Page" />
		<meta name="description" content="This page just for TEST!" />
		<meta name="author" content="Wu Tianhao, wth88888888@gmail.com" />
	<!-- Web TITLE -->
		<title>数据库配置</title>
	<!-- External LINK -->
		<link type="text/css" rel="stylesheet" href="../StyleSheet/TestCSS.css?ver=0601" />
		<link type="text/css" rel="stylesheet" href="../StyleSheet/foundation.css?ver=0601" />
		<script type="text/javascript" src="../JavaScript/TestJavaScript.js?ver=0601"></script>
	<!-- Internal Style Sheet -->
		<!--
			<STYLE type="text/css">
				
			</STYLE>
		-->
	<!-- Internal JavaScript -->
		<!--
			<Script type="text/javascript">
				<![CDATA[
					
				]]>
			</Script>
		-->
	</head>
	<body>
		<?php
			error_reporting(E_ALL);
			ini_set("display_errors", TRUE);
			session_start();
			require '../Encryption/PasswordHash.php';
			$t_hasher = new PasswordHash(8, FALSE);
			
			require_once("./connectSQL.php");
			if (@$_GET["action"] == "registerDatabase") {
				$sqlCreate = "CREATE TABLE notecontent (
					idnum int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					name nvarchar(10) NOT NULL,
					createTime nvarchar(25) NOT NULL,
					updateTime nvarchar(25) NOT NULL,
					noteThread nvarchar(20) NOT NULL,
					noteContent nvarchar(1024) NOT NULL
				) DEFAULT CHARSET=utf8";
				$mysqliCreateTable = mysqli_query($mysqli, $sqlCreate);
				if ($mysqliCreateTable) {
					printf("<br />成功创建表 [NoteContent]。<br />");
				} else {
					printf("<br />无法创建表 [NoteContent]。<br />");
				}
				$sqlCreate = "CREATE TABLE notereply (
					idnum int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					name nvarchar(10) NOT NULL,
					tid nvarchar(10) NOT NULL,
					createTime nvarchar(25) NOT NULL,
					updateTime nvarchar(25) NOT NULL,
					noteReply nvarchar(1024) NOT NULL
				) DEFAULT CHARSET=utf8";
				$mysqliCreateTable = mysqli_query($mysqli, $sqlCreate);
				if ($mysqliCreateTable) {
					printf("<br />成功创建表 [noteReply]。<br />");
				} else {
					printf("<br />无法创建表 [noteReply]。<br />");
				}
				$sqlCreate = "CREATE TABLE register (
					id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY unique,
					username nvarchar(16) NOT NULL,
					password nvarchar(60) NOT NULL,
					PERMISSION nvarchar(5) NOT NULL,
					createTime nvarchar(25) NOT NULL,
					updateTime nvarchar(25) NOT NULL,
					UID nvarchar(40) NOT NULL
				) DEFAULT CHARSET=utf8";
				$mysqliCreateTable = mysqli_query($mysqli, $sqlCreate);
		 		if ($mysqliCreateTable) {
					printf("<br />成功创建表 [Register]。<br />");
				} else {
					printf("<br />无法创建表 [Register]。<br />");
				}
				$sqlCreate = "CREATE TABLE userinfo (
					idnum int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					name nvarchar(10) NOT NULL,
					sex nvarchar(4) NOT NULL,
					localp nvarchar(4) NOT NULL,
					myChoose1 nvarchar(5) NOT NULL,
					myChoose2 nvarchar(5) NOT NULL,
					updateTime nvarchar(25) NOT NULL,
					UID nvarchar(40) NOT NULL unique
				) DEFAULT CHARSET=utf8";
				$mysqliCreateTable = mysqli_query($mysqli, $sqlCreate);
				if ($mysqliCreateTable) {
					printf("<br />成功创建表 [UserInfo]。<br />");
				} else {
					printf("<br />无法创建表 [UserInfo]。<br />");
				}
				echo "<br /><a href='../index.php'>返回首页</a><br />";
			} elseif (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
				echo "欢迎您，尊敬的 " . $_SESSION["username"] . "，<a href='../PHP/voteNote.php?page=1&display=default'>进入留言</a> | <a href='../PHP/Login.php?action=Logout'>注销账户</a>。<br />";
			} else {
				$_SESSION["admin"] = false;
				echo "您似乎没有登录请先<a href='../indexLogin.php'>登录用户</a>。";
				exit();
			}
			//
			//
			//
			//
			echo "<br />";
			if ($_GET["action"] == "changePassword") {
				$modeTest = "SELECT * FROM register WHERE username='$_SESSION[username]'";
				$modeResult = mysqli_query($mysqli, $modeTest);
				$modeCheck = mysqli_num_rows($modeResult);
				if ($modeCheck) {
					printf("<br />更新用户数据<br />");
					$tempPassword = $_POST["password"];
					$hashedPassword = $t_hasher->HashPassword($tempPassword);
					$getNowTime = date("Y-m-d H:i:s", time() + 3600 * 8);
					$sqlUpdate = "UPDATE register SET password='$hashedPassword', updateTime='$getNowTime' WHERE username='$_SESSION[username]'";
					mysqli_query($mysqli, $sqlUpdate);
					$detailInfo = mysqli_fetch_row($modeResult);
					echo "成功修改密码，原密码 Hash 为：" . $detailInfo[2] . "，现修改为：" . $_POST["password"] . "，用户信息更新时间为：" . $detailInfo[5] . "。<br /><a href='javascript: void(0);' onclick='history.back()'>返回上页</a><br />";
					unset($detailInfo);
				} else {
					echo "尚未查询到需要修改的项目。";
				}
			}
			print "<br /><hr />Print Write INFO:<br /><br />Your <b>Submit</b> String by POST is:<br />";
			print "<pre>";
			print_r($_POST);
			print "</pre><hr />";
			print "Print Write INFO:<br /><br />Your <b>Submit</b> String by REQUEST is:<br />";
			print "<pre>";
			print_r($_REQUEST);
			print "</pre>";
		?>
	</body>
</html>
