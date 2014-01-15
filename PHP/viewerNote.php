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
		<link type="text/css" rel="stylesheet" href="../StyleSheet/TestCSS.css" />
		<link type="text/css" rel="stylesheet prefetch" href="../StyleSheet/foundation.css" />
		<script type="text/javascript" src="../JavaScript/TestJavaScript.js"></script>
		<script type="text/javascript" src="../JavaScript/jquery.js"></script>
		<script type="text/javascript" src="../JavaScript/foundation.js"></script>
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
			if (@$_SESSION["UID"] == "") {
				echo "您没有权限访问本页面，<a href='../index.php'>返回首页</a>。<br />";
				exit();
			} elseif (@$_SESSION["username"] != "") {
				$getNowTime = date("Y-m-d H:i:s", time() + 3600 * 8);
				$getName = $_SESSION["username"];
			} else {
				print "<b>感谢您的访问，但是您的访问来源有误，<a href='./voteNote.php?page=1&display=default'>返回上级</a></b>。";
				exit();
			}
			require_once("./connectSQL.php");
			//
			//
			//
			//
			echo "<br /><div style='margin-left: 5%;margin-right: 5%;'>";
			$pageShow = 10;
			$modeTest = "SELECT * FROM notereply WHERE tid=" . $_GET["tid"];
			$resultInfo = mysqli_query($mysqli, $modeTest);
			$resultNum = mysqli_num_rows($resultInfo);
			$pageNum = ceil($resultNum / $pageShow);
			$nowPage = $_GET["page"];
			$prevPage = $nowPage - 1;
			$nextPage = $nowPage + 1;
			$showPage = ($_GET["page"] - 1) * 10;
			$modeTest = "SELECT * FROM notecontent WHERE idnum=" . $_GET["tid"];
			$resultInfo = mysqli_query($mysqli, $modeTest);
			$resultNum = mysqli_num_rows($resultInfo);
			echo "<div class='centMain'><table width='100%'><tr><td width='9%'>序列编号</td><td width='41%'>留言主题</td><td width='10%'>留言用户</td><td width='20%'>发表时间</td><td width='20%'>最后更新</td></tr>";
			$detailInfo = mysqli_fetch_row($resultInfo);
			echo "<tr><td><input size='3' disabled='true' type='input' value='" . $detailInfo[0] . "' /></td><td><input size='80' disabled='true' type='input' value='" . $detailInfo[4] . "' /></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[1] . "' /></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[2] . "' /></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[3] . "' /></td></tr><tr><td colspan='6'><textarea disabled='true'>" . $detailInfo[5] . "</textarea></td></tr></table>";
			if (isset($_GET["display"])) {
				if ($_GET["display"] == "update") {
					$modeTest = "SELECT * FROM notereply WHERE tid=" . $_GET["tid"] . " ORDER by updateTime desc LIMIT " . $showPage . ", 10";
				} elseif ($_GET["display"] == "create") {
					$modeTest = "SELECT * FROM notereply WHERE tid=" . $_GET["tid"] . " ORDER by createTime desc LIMIT " . $showPage . ", 10";
				} elseif ($_GET["display"] == "my") {
					$modeTest = "SELECT * FROM notereply WHERE name='$_SESSION[username]' ORDER by idnum LIMIT " . $showPage . ", 10";
				} else {
					$modeTest = "SELECT * FROM notereply WHERE tid=" . $_GET["tid"] . " ORDER by idnum LIMIT " . $showPage . ", 10";
				}
			} else {
				$modeTest = "SELECT * FROM notereply WHERE tid=" . $_GET["tid"] . " ORDER by idnum LIMIT " . $showPage . ", 10";
			}
			$resultInfo = mysqli_query($mysqli, $modeTest);
			$resultNum = mysqli_num_rows($resultInfo);
			$modeTest = "SELECT * FROM notereply WHERE tid=" . $_GET["tid"];
			$getReply = mysqli_query($mysqli, $modeTest);
			$getReplyNum = mysqli_num_rows($getReply);
			if ($getReplyNum != "") {
				echo "</table><br />本主题共有 " . $getReplyNum . " 条回复：<div class='centMain'><br /><table><tr><td width='7%'>回帖编号</td><td width='10%'>留言用户</td><td width='23%'>选择操作</td><td width='20%'>发表时间</td><td width='20%'>最后更新</td><td width='7%'>回复主题</td></tr>";
				$getRowNum = 1;
				while ($detailInfo = mysqli_fetch_row($resultInfo)) {
					$modifyInfoLink = "document.getElementById('frmPHPNote').action='./createNote.php?action=modifyReply&tid=" . $_GET["tid"] . "&idnum=" . $detailInfo[0] . "&display=" . $_GET["display"] . "';document.getElementById('operateTips').innerHTML='&lt;b&gt;编辑回复&lt;/b&gt;';document.getElementById('noteReply').value=document.getElementsByTagName('textarea').item(" . $getRowNum++ . ").value;top.location.href='#frmPHPNote';";
					$deleteInfoLink = "if(confirm('此操作无法撤消！')){top.location.href='./createNote.php?action=deleteReply&tid=" . $_GET["tid"] . "&idnum=" . $detailInfo[0] . "&display=" . $_GET["display"] . "'}";
					$createInfoLink = "document.getElementById('frmPHPNote').action='./createNote.php?action=create&display=" . $_GET["display"] . "';document.getElementById('operateTips').innerHTML='&lt;b&gt;发布回复&lt;/b&gt;';document.getElementById('noteReply').value='';";
					echo "<tr><td><input size='3' disabled='true' type='input' value='" . $detailInfo[0] . "' /></td><td><input size='20' disabled='true' type='input' value='" . $detailInfo[1] . "' /></td><td width='13%'><a href='javascript: void(0);' onclick=$modifyInfoLink>编辑</a> | <a href='javascript: void(0);' onclick=$deleteInfoLink>删除</a> | <a href='javascript: void(0);' onclick=$createInfoLink>取消</a></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[3] . "' /></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[4] . "' /></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[2] . "' /></td></tr><tr><td colspan='6'><textarea disabled='true'>" . $detailInfo[5] . "</textarea></td></tr>";
				}
				echo "</table></div>";
				echo "当前第 " . $nowPage ." 页，共 " . $pageNum . " 页：";
				if ($pageNum > 1) {
					if ($nowPage == 1) {
						echo "第一页 |";
					} else {
						if (isset($_GET["display"])) {
							echo "<a href='./viewerNote.php?page=1&tid=" . $_GET["tid"] . "&display='" . $_GET["display"] . ">第一页</a> |";
						} else {
							echo "<a href='./viewerNote.php?page=1&tid=" . $_GET["tid"] . "&display=default'>第一页</a> |";
						}
					}
					if ($prevPage < 1) {
						echo "上一页 |";
					} else {
						if (isset($_GET["display"])) {
							echo "<a href='./viewerNote.php?page=" . $prevPage . "&tid=" . $_GET["tid"] . "&display='" . $_GET["display"] . ">上一页</a> |";
						} else {
							echo "<a href='./viewerNote.php?page=" . $prevPage . "&tid=" . $_GET["tid"] . "&display=default'>上一页</a> |";
						}
					}
					if ($nextPage > $pageNum) {
						echo "下一页 |";
					} else {
						if (isset($_GET["display"])) {
							echo "<a href='./viewerNote.php?page=" . $nextPage . "&tid=" . $_GET["tid"] . "&display='" . $_GET["display"] . ">下一页</a> |";
						} else {
							echo "<a href='./viewerNote.php?page=" . $nextPage . "&tid=" . $_GET["tid"] . "&display=default'>下一页</a> |";
						}
					}
					if ($nowPage >= $pageNum) {
						echo "最末页 |";
					} else {
						if (isset($_GET["display"])) {
							echo "<a href='./viewerNote.php?page=" . $pageNum . "&tid=" . $_GET["tid"] . "&display='" . $_GET["display"] . ">最末页</a> |";
						} else {
							echo "<a href='./viewerNote.php?page=" . $pageNum . "&tid=" . $_GET["tid"] . "&display=default'>最末页</a> |";
						}
					}
					echo " <a href='./voteNote.php?page=1&display=default'>返回上级</a></div><br /><br />";
				} else {
					echo "第一页 | 上一页 | 下一页 | 最末页 | <a href='./voteNote.php?page=1&display=default'>返回首页</a></div><br /><br />";
				}
			} else {
					echo "暂无回复，<a href='./voteNote.php?page=1&display=default'>返回上级</a><br /><br />";
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
						<li class="active"><a href="../index.php">模拟报名</a></li>
						<li><a href="javascript: void(0);" onclick="checkCookies();">问题检测</a></li>
						<li><a href="../index.php">返回首页</a></li>
						<li class="has-dropdown">
							<a href="javascript: void(0);" onclick="history.go(0);">列表排序</a>
							<ul class="dropdown">
								<li><a href="./viewerNote.php?page=1&tid=<?=$_GET["tid"]?>&display=default">默认序列</a></li>
								<li><a href="./viewerNote.php?page=1&tid=<?=$_GET["tid"]?>&display=update">最新发布</a></li>
								<li><a href="./viewerNote.php?page=1&tid=<?=$_GET["tid"]?>&display=create">最后修改</a></li>
								<li><a href="./viewerNote.php?page=1&tid=<?=$_GET["tid"]?>&display=my">我的主题</a></li>
							</ul>
						</li>
						<li><a href="./voteNote.php?page=1&display=default">返回上级</a></li>
					</ul>
					<!-- Right Nav Section -->
					<ul class="right">
						<li>
							<input id="searchInfo" name="searchInfo" type="text" placeholder="搜索回复" />
						</li>
						<li>
							<a href="#" class="button [tiny small large]" onclick="searchInfo('getReply');">Default Button</a>
						</li>
						<li><a href="#"><?=$_SESSION["showInfo"]?></a></li>
						<li><a href="#top">返回顶部</a></li>
						<li class="has-dropdown">
							<a href="../index.php">返回首页</a>
							<ul class="dropdown">
								<li><a href="./voteNote.php?page=1&display=default">查阅留言</a></li>
								<li><a href="./Login.php?action=Logout">注销账户</a></li>
							</ul>
						</li>
					</ul>
				</section>
			</nav>
		</div>
		<div class="cent">
			<form id="frmPHPNote" action="./createNote.php?action=reply&tid=<?=$_GET["tid"]?>&display=<?=$_GET["display"]?>" method="POST">
				<table width="80%" class="cent">
					<tr>
						<td width="20%">
							当前操作：
						</td>
						<td>
							<span id="operateTips" class="operateTips"><b>发布回复</b></span>
						</td>
					</tr>
					<tr>
						<td>
							回复内容：
						</td>
						<td>
							<textarea id="noteReply" name="noteReply" width="40%"></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<button id="subPHP" name="subPHP" type="submit" value="Submit">提交</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<?php
			echo "</div>";
			print "<br /><hr />Print Write INFO:<br /><br />Your <b>Submit</b> String by POST is:<br />";
			print "<pre>";
			print_r($_POST);
			print "</pre><hr />";
			print "Print Write INFO:<br /><br />Your <b>Submit</b> String by REQUEST is:<br />";
			print "<pre>";
			print_r($_REQUEST);
			print "</pre>";
		?>
	<script type="text/javascript" src="../JavaScript/index.js"></script>
	</body>
</html>