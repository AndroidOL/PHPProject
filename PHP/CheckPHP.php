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
			if ($_POST["UIDSearcherCheck"] != "") {
				echo "<b>感谢您的访问，您查询的识别码为：[" . $_POST["UIDSearcherCheck"] . "]！</b><br />";
			}
			else {
				print "<b>感谢您的访问，但是您的访问来源有误，<a href='../index.php'>返回首页</a>。</b><br />";
				exit();
			}
			$username = "root";
			$password = "";
			$host = "localhost";
			$sqlname = "test";
			$mysqli = new mysqli($host, $username, $password, $sqlname);
			if (mysqli_connect_errno()) {
				echo "<br /><b>连接至数据库失败！</b>";
				exit();
			}
			$modeTest = "SELECT * FROM userinfo WHERE UID='$_POST[UIDSearcherCheck]'";
			$resultInfo = mysqli_query($mysqli, $modeTest);
			$resultNum = mysqli_num_rows($resultInfo);
			echo "<br />表中共有 " . $resultNum . " 条记录";
			if ($resultNum != 0) {
				echo "<table><tr><td>编号</td><td>姓名</td><td>性别</td><td>本地</td><td>第一志愿</td><td>第二志愿</td><td>最后修改</td><td>个人识别码</td></tr>";
				while ($detailInfo = mysqli_fetch_row($resultInfo)) {
					echo "<tr><td><input size='2' disabled='true' type='input' value='" . $detailInfo[0] . "' /></td><td><input size='30' disabled='true' type='input' value='" . md5(crypt($detailInfo[1])) . "' /></td><td><input size='3' disabled='true' type='input' value='" . $detailInfo[2] . "' /></td><td><input size='3' disabled='true' type='input' value='" . $detailInfo[3] . "' /></td><td><input size='3' disabled='true' type='input' value='" . $detailInfo[4] . "' /></td><td><input size='3' disabled='true' type='input' value='" . $detailInfo[5] . "' /></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[6] . "' /></td><td><input size='35' disabled='true' type='input' value='" . $detailInfo[7] . "' /></td></tr>";
				}
				echo "</table><a href='javascript: void(0);' onclick='history.back()'>返回上页</a><br />";
			} else {
				echo "<br /><a href='javascript: void(0);' onclick='history.back()'>返回上页</a><br />";
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