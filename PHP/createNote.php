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
			if (@$_SESSION["UID"] == "") {
				echo "您没有权限访问本页面，<a href='../index.php'>返回首页</a>。<br />";
				exit();
			} elseif (@$_SESSION["username"] != "") {
				$getNowTime = date("Y-m-d H:i:s", time() + 3600 * 8);
				echo "欢迎您，尊敬的 " . $_SESSION["username"] . "，<a href='../index.php'>返回首页</a> | <a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a> | <a href='../PHP/Login.php?action=Logout'>注销账户</a>。<br />";
			}  elseif (isset($_GET["tid"]) && $_GET["tid"] != "") {
				echo "<br />未指定操作方式，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
			} else {
				print "<b>感谢您的访问，但是您的访问来源有误，<a href='../index.php'>返回首页</a>。</b><br />";
				exit();
			}
			if ($_GET["action"] == "create") {
				$todo = "INSERT";
			} elseif ($_GET["action"] == "modify") {
				$todo = "UPDATE";
			} elseif ($_GET["action"] == "delete") {
				$todo = "DELETE";
			} elseif ($_GET["action"] == "viewer") {
				$todo = "VIEWER";
			} elseif ($_GET["action"] == "reply") {
				$todo = "REPLY";
			} elseif ($_GET["action"] == "modifyReply") {
				$todo = "REPLYUpdate";
			} elseif ($_GET["action"] == "deleteReply") {
				$todo = "REPLYDelete";
			} else {
				echo "<br />未指定操作方式，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
				exit();
			}
			require_once("./connectSQL.php");
			//
			//
			//
			//
			echo "<br />";
			if ($todo == "INSERT") {
				$sqlXXX = "INSERT INTO notecontent (name, createTime, updateTime, noteThread, noteContent) VALUES ('$_SESSION[username]', '$getNowTime', '$getNowTime', '$_POST[noteThread]', '$_POST[noteContent]')";
				mysqli_query($mysqli, $sqlXXX);
				echo "<br />操作成功，发布主题，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
			} elseif ($_GET["tid"] != "") {
				$modeTest = "SELECT name FROM notecontent WHERE idnum='" . $_GET["tid"] . "'";
				$resultInfo = mysqli_query($mysqli, $modeTest);
				$getThreadSataus = mysqli_num_rows($resultInfo);
				if ($getThreadSataus) {
					$getUserName = mysqli_fetch_array($resultInfo);
					if ($todo == "VIEWER" || $todo == "REPLY") {
						$sqlSelect = "SELECT * from notereply WHERE tid=" . $_GET["tid"];
						$getResult = mysqli_query($mysqli, $sqlSelect);
						$getThreadNum = mysqli_num_rows($getResult);
						if ($todo == "REPLY") {
							$sqlXXX = "INSERT INTO notereply (name, tid, createTime, updateTime, noteReply) VALUES ('$_SESSION[username]', '$_GET[tid]', '$getNowTime', '$getNowTime', '$_POST[noteReply]')";
							mysqli_query($mysqli, $sqlXXX);
							echo "<br />操作成功，回复序号 " . $_GET["tid"] . " 的主题，<a href='javascript: void(0);' onclick='history.back()'>返回上页</a>。";
						}
					} elseif ($getUserName[0] == $_SESSION["username"]) {
						if ($todo == "UPDATE") {
							$sqlUpdate = "UPDATE notecontent SET noteThread='$_POST[noteThread]', noteContent = '$_POST[noteContent]', updateTime='$getNowTime' WHERE idnum='$_GET[tid]'";
							$getResult = mysqli_query($mysqli, $sqlUpdate);
							if ($getResult) {
								echo "<br />操作成功，更新序号 " . $_GET["tid"] . " 的主题，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
							} else {
								echo "<br />操作失败，更新序号 " . $_GET["tid"] . " 的主题，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
							}
						} elseif ($todo == "REPLYUpdate") {
							$sqlUpdate = "UPDATE notereply SET noteReply='$_POST[noteReply]', updateTime='$getNowTime' WHERE idnum='$_GET[idnum]'";
							$getResult = mysqli_query($mysqli, $sqlUpdate);
							if ($getResult) {
								echo "<br />操作成功，更新序号 " . $_GET["tid"] . " 的回复，<a href='./viewerNote.php?page=1&tid=" . $_GET["tid"] . "&display=" . $_GET["display"] . "'>返回上级</a>。";
							} else {
								echo "<br />操作失败，更新序号 " . $_GET["tid"] . " 的回复，<a href='./viewerNote.php?page=1&tid=" . $_GET["tid"] . "&display=" . $_GET["display"] . "'>返回上级</a>。";
							}
						} elseif ($todo == "DELETE") {
							$sqlDeleteReply = "DELETE from notereply WHERE tid='$_GET[tid]'";
							$getResultReply = mysqli_query($mysqli, $sqlDeleteReply);
							$sqlDeleteThread = "DELETE from notecontent WHERE idnum='$_GET[tid]'";
							$getResultThread = mysqli_query($mysqli, $sqlDeleteThread);
							if ($getResultReply && $getResultThread) {
								echo "<br />操作成功，删除序号 " . $_GET["tid"] . " 的主题以及回复，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
							} else {
								if ($getResultThread && !$getResultReply) {
									echo "<br />操作失败，删除序号" . $_GET["tid"] . " 的主题，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
								} elseif ($getResultReply && !$getResultThread) {
									echo "<br />操作失败，删除序号" . $_GET["tid"] . " 的回复，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
								} else {
									echo "<br />操作失败，删除序号" . $_GET["tid"] . " 的主题以及回复，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
								}
							}
						} elseif ($todo == "REPLYDelete") {
							$sqlSelect = "SELECT * from notereply WHERE idnum='$_GET[idnum]'";
							$sqlSelectReply = mysqli_query($mysqli, $sqlSelect);
							$getReplyNum = mysqli_num_rows($sqlSelectReply);
							if (!$getReplyNum) {
								echo "<br />您所访问的帖子可能不存在或已被删除，<a href='./viewerNote.php?page=1&tid=" . $_GET["tid"] . "&display=" . $_GET["display"] . "'>返回上级</a>。";
								exit();
							} else {
								$sqlDeleteReply = "DELETE from notereply WHERE idnum='$_GET[idnum]'";
								$getResultReply = mysqli_query($mysqli, $sqlDeleteReply);
								if ($getResultReply) {
									echo "<br />操作成功，删除编号 " . $_GET["idnum"] . " 的回复，共删除 " . mysqli_affected_rows($mysqli) . " 条，<a href='./viewerNote.php?page=1&tid=" . $_GET["tid"] . "&display=" . $_GET["display"] . "'>返回上级</a>。";
								} else {
									echo "<br />操作失败，删除编号 " . $_GET["idnum"] . " 的回复，共删除 " . mysqli_affected_rows($mysqli) . " 条，<a href='./viewerNote.php?page=1&tid=" . $_GET["tid"] . "&display=" . $_GET["display"] . "'>返回上级</a>。";
								}
							}
						} else {
							echo "<br />未指定操作方式，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
							exit();
						}
					} else {
						echo "<br />您无权编辑该主题，用户为：" . $getUserName[0] . "，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
						exit();
					}
				} else {
					echo "<br />您所访问的帖子可能不存在或已被删除，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
					exit();
				}
			} else {
				echo "<br />未指定主题序号，<a href='./voteNote.php?page=1&display=" . $_GET["display"] . "'>返回上级</a>。";
				exit();
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