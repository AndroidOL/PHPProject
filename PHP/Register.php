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
			require '../Encryption/PasswordHash.php';
			$t_hasher = new PasswordHash(8, FALSE);
			if ($_POST["username"] != "" || $_POST["password"] != "") {
				echo "<b>感谢您的访问，您的识别码为：[" . $_POST["username"] . "]！</b><br />";
			} else {
				echo "<b>感谢您的访问，但是您的访问来源有误，<a href='javascript: void(0);' onclick='history.back()'>返回上页</a>。</b><br />";
				exit();
			}
			require_once("./connectSQL.php");
			//
			//
			//
			//
			echo "<br />";
			$uidTest = "SELECT * FROM register WHERE UID='$_POST[UID]'";
			$uidCheck = mysqli_num_rows(mysqli_query($mysqli, $uidTest));
			$modeTest = "SELECT * FROM register WHERE username='$_POST[username]'";
			$modeCheck = mysqli_num_rows(mysqli_query($mysqli, $modeTest));
			if ($modeCheck) {
				printf("<br />用户已存在<b>（用户名相同）</b><br />");
			} elseif($uidCheck) {
				printf("<br />用户已存在<b>（UID 相同）</b><br />");
			} else {
				printf("<br />添加用户记录<br />");
				$tempPassword = $_POST["password"];
				$hashedPassword = $t_hasher -> HashPassword($tempPassword);
				$getNowTime = date("Y-m-d H:i:s", time() + 3600 * 8);
				$sqlXXX = "INSERT INTO register (username, password, PERMISSION, createTime, updateTime, UID) VALUES ('$_POST[username]', '$hashedPassword', '用户', '$getNowTime', '$getNowTime', '$_POST[UID]')";
				mysqli_query($mysqli, $sqlXXX);
			}
			$mysqliResult = "select * from register order by username, PERMISSION";
			$resultInfo = mysqli_query($mysqli, $mysqliResult);
			$resultNum = mysqli_num_rows($resultInfo);
			if ($resultNum > 10) {
				echo "<br />表中共有 " . $resultNum . " 条记录，显示最新 10 条。";
				$mysqliResult = "select * from userinfo order by sex, name, localp, UID limit " . ($resultNum - 10) . ", 10";
				$resultInfo = mysqli_query($mysqli, $mysqliResult);
				$resultNum = mysqli_num_rows($resultInfo);
			} else {
				echo "<br />表中共有 " . $resultNum . " 条记录";
			}
			echo "<table><tr><td>编号</td><td>姓名</td><td>密码</td><td>权限</td><td>时间</td><td>标识</td></tr>";
			while ($detailInfo = mysqli_fetch_row($resultInfo)) {
				echo "<tr><td><input size='2' disabled='true' type='input' value='" . $detailInfo[0] . "' /></td><td><input size='30' disabled='true' type='input' value='" . md5(crypt($detailInfo[1])) . "' /></td><td><input size='40' disabled='true' type='input' value='" . $detailInfo[2] . "' /></td><td><input size='2' disabled='true' type='input' value='" . $detailInfo[3] . "' /></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[4] . "' /></td><td><input size='35' disabled='true' type='input' value='" . $detailInfo[6] . "' /></td></tr>";
			}
			echo "</table><a href='javascript: void(0);' onclick='history.back()'>返回上页</a> | <a href='../indexLogin.php?action=Login'>立即登录</a><br />";
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