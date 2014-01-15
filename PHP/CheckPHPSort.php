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
			if (@$_SESSION["PERMISSION"] != "管理") {
				echo "您没有权限访问本页面，<a href='../index.php'>返回首页</a>。<br />";
				exit();
			} elseif (@$_POST["name"] != "") {
				echo "<b>感谢您的访问，您的输入为：[" . $_POST["name"] . "（通过 POST）]！</b><br />";
				$getName = $_POST["name"];
			} elseif(@$_GET["name"] != "") {
				echo "<b>感谢您的访问，您的输入为：[" . $_GET["name"] . "（通过 GET）]！</b><br />";
				$getName = $_GET["name"];
			} else {
				print "<b>感谢您的访问，但是您的访问来源有误，<a href='../index.php'>返回首页</a>。</b><br />";
				exit();
			}
			$username = "root";
			$password = "";
			$host = "localhost";
			$sqlname = "test";
			$mysqli = new mysqli($host, $username, $password, $sqlname);
			if (mysqli_connect_errno()) {
				echo "<br />连接至数据库失败！";
				exit();
			}
			$pageShow = 10;
			$modeTest = "SELECT * FROM userinfo WHERE name='$getName'";
			$resultInfo = mysqli_query($mysqli, $modeTest);
			$resultNum = mysqli_num_rows($resultInfo);
			$pageNum = ceil($resultNum / $pageShow);
			$nowPage = $_GET["page"];
			$prevPage = $nowPage - 1;
			$nextPage = $nowPage + 1;
			if ($resultNum >= 1) {
				echo "<br />表中共有 " . $resultNum . " 条记录，共分 " . $pageNum . " 页显示。";
			} else {
			}
			$showPage = ($_GET["page"] - 1) * 10;
			$modeTest = "SELECT * FROM userinfo WHERE name='$getName' order by sex, name, localp, UID LIMIT " . $showPage . ", 10";
			$resultInfo = mysqli_query($mysqli, $modeTest);
			$resultNum = mysqli_num_rows($resultInfo);
			if ($resultNum != 0) {
				echo "<table><tr><td>编号</td><td>姓名</td><td>性别</td><td>本地</td><td>第一志愿</td><td>第二志愿</td><td>最后修改</td><td>个人识别码</td></tr>";
				while ($detailInfo = mysqli_fetch_row($resultInfo)) {
					echo "<tr><td><input size='2' disabled='true' type='input' value='" . $detailInfo[0] . "' /></td><td><input size='30' disabled='true' type='input' value='" . md5(crypt($detailInfo[1])) . "' /></td><td><input size='3' disabled='true' type='input' value='" . $detailInfo[2] . "' /></td><td><input size='3' disabled='true' type='input' value='" . $detailInfo[3] . "' /></td><td><input size='3' disabled='true' type='input' value='" . $detailInfo[4] . "' /></td><td><input size='3' disabled='true' type='input' value='" . $detailInfo[5] . "' /></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[6] . "' /></td><td><input size='35' disabled='true' type='input' value='" . $detailInfo[7] . "' /></td></tr>";
				}
				echo "</table><br />当前第 " . $nowPage ." 页，共 " . $pageNum . " 页：";
				if ($pageNum > 1) {
					if ($nowPage == 1) {
						echo "第一页 |";
					} else {
						echo "<a href='./CheckPHPSort.php?page=1&name=" . $getName . "'>第一页</a> |";
					}
					if ($prevPage < 1) {
						echo "上一页 |";
					} else {
						echo "<a href='./CheckPHPSort.php?page=" . $prevPage . "&name=" . $getName . "'>上一页</a> |";
					}
					if ($nextPage > $pageNum) {
						echo "下一页 |";
					} else {
						echo "<a href='./CheckPHPSort.php?page=" . $nextPage . "&name=" . $getName . "'>下一页</a> |";
					}
					if ($nowPage >= $pageNum) {
						echo "最末页 |";
					} else {
						echo "<a href='./CheckPHPSort.php?page=" . $pageNum . "&name=" . $getName . "'>最末页</a> |";
					}
					echo " <a href='../index.php'>返回首页</a><br />";
				} else {
					echo "第一页 | 上一页 | 下一页 | 最末页 | <a href='../index.php'>返回首页</a><br />";
				}
			} else {
				echo "<br />暂无记录，<a href='../index.php'>返回首页</a><br />";
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