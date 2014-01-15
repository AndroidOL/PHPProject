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
			} elseif (@$_SESSION["username"] != "" && isset($_GET["keyword"]) && $_GET["keyword"] != "") {
				$getNowTime = date("Y-m-d H:i:s", time() + 3600 * 8);
				if ($_GET["action"] == "getThread") {
					$modeTest = "SELECT * FROM notecontent WHERE noteThread like '%$_GET[keyword]%' or noteContent like '%$_GET[keyword]%'";
				} elseif ($_GET["action"] == "getReply") {
					$modeTest = "SELECT * FROM notereply WHERE noteReply like '%$_GET[keyword]%'";
				} else {
					echo "<br />未指定操作方式，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
					exit();
				}
			} else {
				print "<b>感谢您的访问，但关键词不能为空，<a href='./voteNote.php?page=1&display=default'>返回上级</a></b>。";
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
			//
			//
			//
			//
			echo "<br /><div style='margin-left: 5%;margin-right: 5%;'>";
			$pageShow = 10;
			$resultInfo = mysqli_query($mysqli, $modeTest);
			$resultNumSaver = mysqli_num_rows($resultInfo);
			$pageNum = ceil($resultNumSaver / $pageShow);
			$nowPage = $_GET["page"];
			$prevPage = $nowPage - 1;
			$nextPage = $nowPage + 1;
			$showPage = ($_GET["page"] - 1) * 10;
			if (isset($_GET["display"])) {
				if ($_GET["display"] == "update") {
					$modeTest = $modeTest . " ORDER by updateTime desc LIMIT " . $showPage . ", 10";
				} elseif ($_GET["display"] == "create") {
					$modeTest = $modeTest . " ORDER by createTime desc LIMIT " . $showPage . ", 10";
				} elseif ($_GET["display"] == "my") {
					$modeTest = $modeTest . " and name='$_SESSION[username]' ORDER by idnum desc LIMIT " . $showPage . ", 10";
				} else {
					$modeTest = $modeTest . " ORDER by idnum desc LIMIT " . $showPage . ", 10";
				}
			} else {
				$modeTest = $modeTest . " ORDER by idnum desc LIMIT " . $showPage . ", 10";
			}
			$resultInfo = mysqli_query($mysqli, $modeTest);
			$resultNum = mysqli_num_rows($resultInfo);
			if ($resultNum != 0) {
				if ($_GET["action"] == "getThread") {
					echo "<br />共搜索到 " . $resultNumSaver . " 条留言：<div class='centMain'><table width='100%'><tr><td width='7%'>序列编号</td><td width='20%'>留言主题</td><td width='23'>选择操作</td><td width='10%'>留言用户</td><td width='20%'>发表时间</td><td width='20%'>最后更新</td></tr>";
					$getRowNum = 0;
					$getRowThread = 1;
					while ($detailInfo = mysqli_fetch_row($resultInfo)) {
						$getRowThread += 5;
						$deleteInfoLink = "if(confirm('此操作无法撤消！')){top.location.href='./createNote.php?action=delete&tid=" . $detailInfo[0]. "&display=" . $_GET["display"] . "'}";
						echo "<tr><td><input size='3' disabled='true' type='input' value='" . $detailInfo[0] . "' /></td><td><input size='30' disabled='true' type='input' value='" . $detailInfo[4] . "' /></td><td><a href='javascript: void(0);' onclick=top.location.href='./viewerNote.php?page=1&tid=" . $detailInfo[0]. "&display=" . $_GET["display"] . "'>查看</a> | <a href='javascript: void(0);' onclick=$deleteInfoLink>删除</a></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[1] . "' /></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[2] . "' /></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[3] . "' /></td></tr><tr><td colspan='6'><textarea disabled='true'>" . $detailInfo[5] . "</textarea></td></tr>";
					}
				} else {
					echo "<br />共搜索到 " . $resultNumSaver . " 条回复：<div class='centMain'><br /><table><tr><td width='7%'>回帖编号</td><td width='10%'>留言用户</td><td width='23%'>选择操作</td><td width='20%'>发表时间</td><td width='20%'>最后更新</td><td width='7%'>回复主题</td></tr>";
					$getRowNum = 1;
					while ($detailInfo = mysqli_fetch_row($resultInfo)) {
						$deleteInfoLink = "if(confirm('此操作无法撤消！')){top.location.href='./createNote.php?action=deleteReply&tid=" . $_GET["tid"] . "&idnum=" . $detailInfo[0] . "&display=" . $_GET["display"] . "'}";
						echo "<tr><td><input size='3' disabled='true' type='input' value='" . $detailInfo[0] . "' /></td><td><input size='20' disabled='true' type='input' value='" . $detailInfo[1] . "' /></td><td width='13%'><a href='javascript: void(0);' onclick=top.location.href='./viewerNote.php?page=1&tid=" . $detailInfo[2]. "&display=" . $_GET["display"] . "'>查看</a> | <a href='javascript: void(0);' onclick=$deleteInfoLink>删除</a></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[3] . "' /></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[4] . "' /></td><td><input size='16' disabled='true' type='input' value='" . $detailInfo[2] . "' /></td></tr><tr><td colspan='6'><textarea disabled='true'>" . $detailInfo[5] . "</textarea></td></tr>";
					}
				}
				echo "</table><br />当前第 " . $nowPage ." 页，共 " . $pageNum . " 页[共 " . $resultNumSaver . " 条记录]：";
				if ($pageNum > 1) {
					if ($nowPage == 1) {
						echo "第一页 |";
					} else {
						if (isset($_GET["tid"])) {
							echo "<a href='searchInfo.php?action=" . $_GET["action"] . "&keyword=" . $_GET["keyword"] . "&tid=" . $_GET["tid"] . "&page=1&display=" . $_GET["display"] . "'>第一页</a> |";
						} else {
							echo "<a href='searchInfo.php?action=" . $_GET["action"] . "&keyword=" . $_GET["keyword"] . "&page=1&display=" . $_GET["display"] . "'>第一页</a> |";
						}
					}
					if ($prevPage < 1) {
						echo "上一页 |";
					} else {
						if (isset($_GET["tid"])) {
							echo "<a href='searchInfo.php?action=" . $_GET["action"] . "&keyword=" . $_GET["keyword"] . "&tid=" . $_GET["tid"] . "&page=" . $prevPage . "&display=" . $_GET["display"] . "'>上一页</a> |";
						} else {
							echo "<a href='searchInfo.php?action=" . $_GET["action"] . "&keyword=" . $_GET["keyword"] . "&page=" . $prevPage . "&display=" . $_GET["display"] . "'>上一页</a> |";
						}
					}
					if ($nextPage > $pageNum) {
						echo "下一页 |";
					} else {
						if (isset($_GET["tid"])) {
							echo "<a href='searchInfo.php?action=" . $_GET["action"] . "&keyword=" . $_GET["keyword"] . "&tid=" . $_GET["tid"] . "&page=" . $nextPage . "&display=" . $_GET["display"] . "'>下一页</a> |";
						} else {
							echo "<a href='searchInfo.php?action=" . $_GET["action"] . "&keyword=" . $_GET["keyword"] . "&page=" . $nextPage . "&display=" . $_GET["display"] . "'>下一页</a> |";
						}
					}
					if ($nowPage >= $pageNum) {
						echo "最末页 |";
					} else {
						if (isset($_GET["tid"])) {
							echo "<a href='searchInfo.php?action=" . $_GET["action"] . "&keyword=" . $_GET["keyword"] . "&tid=" . $_GET["tid"] . "&page=" . $pageNum . "&display=" . $_GET["display"] . "'>最末页</a> |";
						} else {
							echo "<a href='searchInfo.php?action=" . $_GET["action"] . "&keyword=" . $_GET["keyword"] . "&page=" . $pageNum . "&display=" . $_GET["display"] . "'>最末页</a> |";
						}
					}
					if (isset($_GET["tid"])) {
						echo " <a href='./viewerNote.php?page=1&tid=" . $_GET["tid"] . "&display=" . $_GET["display"] . "'>返回上级</a></div><br />";
					} else {
						echo " <a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a></div><br />";
					}
				} else {
					if (isset($_GET["tid"])) {
						echo "第一页 | 上一页 | 下一页 | 最末页 | <a href='./viewerNote.php?page=1&tid=" . $_GET["tid"] . "&display=" . $_GET["display"] . "'>返回上级</a></div><br />";
					} else {
						echo "第一页 | 上一页 | 下一页 | 最末页 | <a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a></div><br />";
					}
				}
			} else {
				echo "<br />暂无记录";
				if (isset($_GET["tid"])) {
					echo "，<a href='./viewerNote.php?page=1&tid=" . $_GET["tid"] . "&display=" . $_GET["display"] . "'>返回上级</a></div><br />";
				} else {
					echo "，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a></div><br />";
				}
			}
			if (isset($_GET["tid"])) {
				$tempLink = "./viewerNote.php?page=1&tid=" . $_GET["tid"] . "&display=" . $_GET["display"];
				$tempCheck = "&tid=" . $_GET["tid"];
			} else {
				$tempLink = "./voteNote.php?page=1&display=" . $_GET["display"];
				$tempCheck = "";
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
								<li><a href="./searchInfo.php?action=<?=$_GET["action"]?>&keyword=<?=$_GET["keyword"]?><?=$tempCheck?>&page=1&display=default">默认序列</a></li>
								<li><a href="./searchInfo.php?action=<?=$_GET["action"]?>&keyword=<?=$_GET["keyword"]?><?=$tempCheck?>&page=1&display=update">最新发布</a></li>
								<li><a href="./searchInfo.php?action=<?=$_GET["action"]?>&keyword=<?=$_GET["keyword"]?><?=$tempCheck?>&page=1&display=create">最后修改</a></li>
								<li><a href="./searchInfo.php?action=<?=$_GET["action"]?>&keyword=<?=$_GET["keyword"]?><?=$tempCheck?>&page=1&display=my">我的主题</a></li>
							</ul>
						</li>
						<li><a href="<?=$tempLink?>">返回上级</a></li>
					</ul>
					<!-- Right Nav Section -->
					<ul class="right">
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