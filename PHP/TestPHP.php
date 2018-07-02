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
			if ($_POST["UID"] != $_SESSION["UID"]) {
				echo "<b>感谢您的访问，您的识别码错误，</b><br /><a href='../index.php'>返回首页</a>。<br />";
				exit();
			} elseif ($_POST["UID"] != "") {
				echo "<b>感谢您的访问，您的识别码为：[" . $_POST["UID"] . "]！</b><br />";
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
			$modeTest = "SELECT * FROM userinfo WHERE UID='$_POST[UID]'";
			$modeCheck = mysqli_num_rows(mysqli_query($mysqli, $modeTest));
			$getNowTime = date("Y-m-d H:i:s", time() + 3600 * 8);
			if ($modeCheck) {
				printf("<br />更新用户数据<br />");
				$sqlUpdate = "UPDATE userinfo SET name='$_POST[name]', sex='$_POST[sex]', localp='$_POST[localp]', myChoose1='$_POST[mySelect1]', myChoose2='$_POST[mySelect2]', updateTime='$getNowTime', UID='$_POST[UID]' WHERE UID='$_POST[UID]'";
				mysqli_query($mysqli, $sqlUpdate);
			} else {
				printf("<br />创建用户记录<br />");
				$sqlXXX = "INSERT INTO userinfo (name, sex, localp, myChoose1, myChoose2, updateTime, UID) VALUES ('$_POST[name]', '$_POST[sex]', '$_POST[localp]', '$_POST[mySelect1]', '$_POST[mySelect2]', '$getNowTime', '$_POST[UID]')";
				mysqli_query($mysqli, $sqlXXX);
			}
			$mysqliResult = "select * from userinfo order by sex, name, localp, UID";
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
			echo "<table><tr><td>编号</td><td>姓名</td><td>性别</td><td>本地</td><td>第一志愿</td><td>第二志愿</td><td>最后修改</td><td>个人识别码</td></tr>";
			while ($detailInfo = mysqli_fetch_row($resultInfo)) {
				echo "<tr><td><input size='2' disabled='true' type='input' value='" . $detailInfo[0] . "' /></td><td><input size='30' disabled='true' type='input' value='" . md5(crypt($detailInfo[1])) . "' /></td><td><input size='3' disabled='true' type='input' value='" . $detailInfo[2] . "' /></td><td><input size='3' disabled='true' type='input' value='" . $detailInfo[3] . "' /></td><td><input size='5' disabled='true' type='input' value='" . $detailInfo[4] . "' /></td><td><input size='5' disabled='true' type='input' value='" . $detailInfo[5] . "' /></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[6] . "' /></td><td><input size='35' disabled='true' type='input' value='" . $detailInfo[7] . "' /></td></tr>";
			}
			echo "</table><a href='javascript: void(0);' onclick='history.back()'>返回上页</a><br />";
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