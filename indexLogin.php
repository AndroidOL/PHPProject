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
		<link type="text/css" rel="stylesheet prefetch" href="./StyleSheet/foundation.css" />
		<script type="text/javascript" src="./JavaScript/TestJavaScript.js"></script>
		<script type="text/javascript" src="./JavaScript/jquery.js"></script>
		<script type="text/javascript" src="./JavaScript/foundation.js"></script>
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
	<body onload="generateKey();">
		<?php
			error_reporting(E_ALL);
			ini_set("display_errors", TRUE);
			session_start();
			$admin = false;
			if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
				echo "您可能已经登录，您可以<a href='index.php'>返回首页</a>、<a href='./PHP/voteNote.php?page=1&display=default'>进入留言</a>或<a href='./PHP/Login.php?action=Logout>注销账户</a>。";
				exit();
			} else {
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
						<li class="active"><a href="../index.php">模拟报名</a></li>
						<li><a href="javascript: void(0);" onclick="checkCookies();">问题检测</a></li>
					</ul>
					<!-- Right Nav Section -->
					<ul class="right">
						<li><a href="#top">返回顶部</a></li>
						<li class="has-dropdown">
							<a href="./index.php">返回首页</a>
							<ul class="dropdown">
								<li><a href="./PHP/voteNote.php?page=1&display=default">查阅留言</a></li>
								<li><a href="./PHP/Login.php?action=Logout'">注销账户</a></li>
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
		<div class="small-block-grid-2">
			<div class="large-6 columns">
				<form id="Log" action="./PHP/Login.php?action=Login" method="POST">
					<table width="90%" align="center">
						<tr>
							<td colspan="3">
								<h4 align="center" id="Prj1">登录用户</h4>
							</td>
						</tr>
						<tr>
							<td>
								用户：
							</td>
							<td>
								<input size="30" id="username" name="username" type="text" />
							</td>
							<td>
								<span id="tips1">* 必填<span/>
							</td>
						</tr>
						<tr>
							<td>
								密码：
							</td>
							<td>
								<input size="30" id="password" name="password" type="password" />
							</td>
							<td>
								<span id="tips2">* 必填<span/>
							</td>
						</tr>
						<tr>
							<td colspan="3" align="center">
								<button id="subPHP" name="subPHP" type="submit" value="Submit" onclick="return checkFormLogin();">用户登录</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="large-6 columns">
				<form id="Reg" action="./PHP/Register.php" method="POST">
					<table width="90%" align="center">
						<tr>
							<td colspan="3">
								<h4 align="center" id="Prj2">注册用户</h4>
							</td>
						</tr>
						<tr>
							<td>
								用户：
							</td>
							<td>
								<input size="30" id="username" name="username" type="text" />
							</td>
							<td>
								<span id="tips3">* 必填<span/>
							</td>
						</tr>
						<tr>
							<td>
								密码：
							</td>
							<td>
								<input size="30" id="password" name="password" type="password" />
							</td>
							<td>
								<span id="tips4">* 必填<span/>
							</td>
						</tr>
						<tr>
							<td>
								权限：
							</td>
							<td colspan="2">
								<input size="30" id="PERMISSION" name="PERMISSION" type="text" value="无需填写" disabled="disable"/>
							</td>
						</tr>
						<tr>
							<td>
								标识：
							</td>
							<td colspan="2">
								<input size="30" id="UID" name="UID" type="text" /><br /><span id="tips5">（请勿修改 | <a href="javascript: void(0);" onclick="generateKey();">重新生成</a>）<span/>
							</td>
						</tr>
						<tr>
							<td colspan="3" align="center">
								<button id="subPHP" name="subPHP" type="submit" onmousemove="validationKey();" onmouseover="validationKey();" onmouseout="validationKey();" onclick="return checkFormRegister();">注册用户</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<script type="text/javascript" src="./JavaScript/index.js"></script>
		<?php
			}
		?>
	</body>
</html>