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
		<link type="text/css" rel="stylesheet" href="./StyleSheet/TestCSS.css" />
		<link type="text/css" rel="stylesheet" href="./StyleSheet/normalize.css" />
		<link type="text/css" rel="stylesheet prefetch" href="./StyleSheet/foundation.css" />
		<script type="text/javascript" src="./JavaScript/jquery.js"></script>
		<script type="text/javascript" src="./JavaScript/foundation.js"></script>
		<script type="text/javascript" src="./JavaScript/TestJavaScript.js"></script>
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
	<body onload="genOption();">
	<?php
		error_reporting(E_ALL);
		ini_set("display_errors", TRUE);
		session_start();
		$admin = false;
		if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
			$_SESSION["showInfo"] = "欢迎您，尊敬的 " . $_SESSION["username"];
			if ($_SESSION["PERMISSION"] == "管理") {
				unset($checkByADMIN);
			} else {
				$checkByADMIN = "hidden='hidden'";
			}
		} else { 
			$_SESSION["admin"] = false; 
			echo "您似乎尚未登录请先<a href='indexLogin.php?action=Login'>登录账户</a>或<a href='indexLogin.php?action=register'>注册账户</a>以继续操作。";
			$username = "root";
			$password = "";
			$host = "localhost";
			$sqlname = "test";
			$mysqli = new mysqli($host, $username, $password, $sqlname);
			if (mysqli_connect_errno()) {
				echo "<br />连接至数据库失败！";
				exit();
			}
			$modeTest = "SHOW TABLES FROM $sqlname";
			$resultInfo = mysqli_query($mysqli, $modeTest);
			$resultNum = mysqli_num_rows($resultInfo);
			$i = 0;
			while ($detailInfo = mysqli_fetch_row($resultInfo)) {
				$databaseName[$i++] = $detailInfo[0];
			}
			if (empty($databaseName)) {
				echo "<br /><br />提示：当前您的数据库中不存在任何表，推测您可能是首次运行本脚本。<br />若您需要初始化创建数据表请<a href='./PHP/Configuration.php?action=registerDatabase'>单击此处</a>，若遇到问题请随时向<a href='mailto: wth88888888@gmail.com'>本人反馈</a>。";
			} else {
				if (!in_array("notecontent", $databaseName)) {
					$errorReport[$i++] = "notecontent";
				}
				if (!in_array("notereply", $databaseName)) {
					$errorReport[$i++] = "notereply";
				}
				if (!in_array("register", $databaseName)) {
					$errorReport[$i++] = "register";
				}
				if (!in_array("userinfo", $databaseName)) {
					$errorReport[$i++] = "userinfo";
				}
				if (isset($errorReport)) {
					echo "<br /><br />检测得到您缺少的表为：" . implode(", ",$errorReport) . "。";
				}
				if ($resultNum != 4) {
					echo "<br /><br />提示：当前您数据库中表数目少于标准，推测您可能是首次运行本脚本。<br />若您需要初始化创建数据表请<a href='./PHP/Configuration.php?action=registerDatabase'>单击此处</a>，若遇到问题请随时向<a href='mailto: wth88888888@gmail.com'>本人反馈</a>。";
				}
			}
			exit();
		}
	?>
	<div class="fixed">
		<nav class="top-bar" data-top-bar>
			<ul class="title-area">
				<li class="name">
					<h1><a href="#">报名查询管理系统</a></h1>
				</li>
			</ul>
			<section class="top-bar-section">
				<!-- Left Nav Section -->
				<ul class="left">
					<li class="active"><a href="./index.php">模拟报名</a></li>
					<li><a href="javascript: void(0);" onclick="checkCookies();">问题检测</a></li>
					<li><a href="./PHP/voteNote.php?page=1&display=default">查阅留言</a></li>
				</ul>
				<!-- Right Nav Section -->
				<ul class="right">
					<li><a href="#"><?=$_SESSION["showInfo"]?></a></li>
					<li><a href="#top">返回顶部</a></li>
					<li class="has-dropdown">
						<a href="./index.php">返回首页</a>
						<ul class="dropdown">
							<li><a href="./PHP/voteNote.php?page=1&display=default">查阅留言</a></li>
							<li><a href="./PHP/Login.php?action=Logout">注销账户</a></li>
						</ul>
					</li>
				</ul>
			</section>
		</nav>
	</div>
	<br />
	<div class="small-block-grid-1">
		<div class="large-6 columns">
			<h1>报名查询管理系统</h1>
		</div>
	</div>
	<div class="small-block-grid-3">
		<div class="large-6 columns">
			<form id="frmPHPSearch" action="./PHP/TestPHP.php" onsubmit="return checkForm();" method="POST">
				<table width="90%" align="center">
					<tr>
						<td colspan="4">
							<h4 id="Prj1">信息提交</h4>
						</td>
					</tr>
					<tr>
						<td width="20%">
							姓名：
						</td>
						<td colspan="3">
							<input id="name" name="name" type="text" value='<?=$_SESSION["username"]?>' />
						</td>
					</tr>
					<tr>
						<td>
							性别：
						</td>
						<td width="20%">
							<label><input name="sex" type="radio" value="boy" />男</label>
						</td>
						<td width="20%">
							<label><input name="sex" type="radio" value="gril" />女</label>
						</td>
						<td>
							<span id="tips1" />
						</td>
					</tr>
					<tr>
						<td>
							本地：
						</td>
						<td>
							<label><input name="localp" type="radio" value="yes" />是</label>
						</td>
						<td>
							<label><input name="localp" type="radio" value="no" />否</label>
						</td>
						<td>
							<span id="tips2" />
						</td>
					</tr>
					<tr>
						<td>
							学院：
						</td>
						<td colspan="3">
							<select id="mySelect1" name="mySelect1" onclick="deleteNext();">
								<option value="null" name="null">您的浏览器可能不支持 JavaScript</option>
							</select>
							<select id="mySelect2" name="mySelect2">
								<option value="null" name="null">请先选择第一志愿</option>
							</select>
							<span id="tips3">* 必须填写<span/>
						</td>
					</tr>
					<tr>
						<td>
							识别码：
						</td>
						<td colspan="3">
							<input size="35" id="UID" name="UID" type="text" value='<?=$_SESSION["UID"]?>' />
							<input id="UIDCheck" name="UIDCheck" type="hidden" value='<?=$_SESSION["UID"]?>' />
							<span id="tips4">* 请勿修改<span/>
						</td>
					</tr>
					<tr>
						<td colspan="4" align="center">
							<button id="subPHP" name="subPHP" type="submit" value="Submit">提交</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div class="large-6 columns" <?php if(isset($checkByADMIN)){echo $checkByADMIN;}else{}?>>
			<form id="frmPHPSearch" action="./PHP/CheckPHPSort.php?page=1" method="POST">
				<table width="90%" align="center">
					<tr>
						<td colspan="2">
							<h4 id="Prj4">信息查询（管理员）</h4>
						</td>
					</tr>
					<tr>
						<td width="20%">
							姓名：
						</td>
						<td>
							<input size="30" id="name" name="name" type="text" />
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button id="subPHP" name="subPHP" type="submit" value="Submit">提交</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div class="large-6 columns">
			<form id="frmPHPSearch" action="./PHP/CheckPHP.php" method="POST" onsubmit="return checkKey();">
				<table width="90%" align="center">
					<tr>
						<td colspan="2">
							<h4 id="Prj2">信息查询</h4>
						</td>
					</tr>
					<tr>
						<td width="20%">
							识别码：
						</td>
						<td>
							<input size="35" id="UIDSearcherCheck" name="UIDSearcherCheck" type="text" value='<?=$_SESSION["UID"]?>' />
							<span id="tips6">* 输入查询<span/>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button id="subPHP" name="subPHP" type="submit" value="Submit">提交</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div class="large-6 columns">
			<form id="frmPHPSearch" action="./PHP/Configuration.php?action=changePassword" method="POST">
				<table width="90%" align="center">
					<tr>
						<td colspan="2">
							<h4 id="Prj3">密码修改</h4>
						</td>
					</tr>
					<tr>
						<td width="20%">
							姓名：
						</td>
						<td>
							<input size="35' id="username" name="username" type="text" value='<?=$_SESSION["username"]?>' disabled="true" />
						</td>
					</tr>
					<tr>
						<td>
							新密码：
						</td>
						<td>
							<input size="35" id="password" name="password" type="password" />
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button id="subPHP" name="subPHP" type="submit" value="Submit">提交</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="./JavaScript/index.js"></script>
	</body>
</html>