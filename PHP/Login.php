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
		<title>报名查询管理系统</title>
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
			$admin = false;
			require '../Encryption/PasswordHash.php';
			if ($_GET["action"] == "Logout") {
				if (!isset($_SESSION["admin"]) || !isset($_SESSION["username"])) {
					echo "<b>感谢您的访问，您已经成功登出，</b><a href='../index.php'>返回首页</a>";
					exit();
				}
				echo "<b>感谢您的访问，您的用户名为：[" . $_SESSION["username"] . "]！</b><br />";
				echo "用户 [" . $_SESSION["username"] . "] 已经成功登出，</b><a href='../index.php'>返回首页</a>";
				unset($_SESSION['UID']);
				unset($_SESSION['admin']);
				unset($_SESSION['username']);
				exit();
			} elseif ($_POST["username"] != "") {
				echo "<b>感谢您的访问，您的用户名为：[" . $_POST["username"] . "]！</b><br />";
			}
			else {
				print "<b>感谢您的访问，但是您的访问来源有误，<a href='../index.php'>返回首页</a>。</b><br />";
				exit();
			}
			require_once("./connectSQL.php");
			//
			//
			//
			//
			echo "<br />";
			$modeTest = "SELECT * FROM register WHERE username='$_POST[username]'";
			$resultInfo = mysqli_query($mysqli, $modeTest);
			$resultNum = mysqli_num_rows($resultInfo);
			echo "<br />表中共有 " . $resultNum . " 条记录";
			$detailInfo = mysqli_fetch_row($resultInfo);
			$getCorrect = "$_POST[password]";
			$t_hasher = new PasswordHash(8, FALSE);
			$check = $t_hasher -> CheckPassword($getCorrect, $detailInfo[2]);
			if ($_POST["username"] == "" || $_POST["password"] == "") {
				echo "<br />用户名密码不能为空<br /><a href='javascript: void(0);' onclick='history.back()'>返回上页</a><br />";
			} elseif($resultNum == 0) {
				echo "<br />无此用户<br />";
			} elseif ($check) {
				echo "<br />登录成功<br />您的输入为：" . $_POST["password"] . "，密码 Hash 值为：" . $detailInfo[2] . "，用户权限：" . $detailInfo[3] . "，检查值为：[" . $check . "]<br /><a href='../index.php'>返回首页</a><br />";
				$_SESSION["admin"] = true;
				$_SESSION["username"] = $detailInfo[1];
				$_SESSION["password"] = $detailInfo[2];
				$_SESSION["PERMISSION"] = $detailInfo[3];
				$_SESSION["UID"] = $detailInfo[6];
				unset($check);
			} else {
				echo "<br />密码错误<br />您的输入为：" . $_POST["password"] . "，密码 Hash 值为：" . $detailInfo[2] . "，检查值为：[" . $check . "]<br /><a href='javascript: void(0);' onclick='history.back()'>返回上页</a><br />";
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