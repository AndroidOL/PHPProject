/*
 *! Variable Declare !
 */
	var schoolList = new Array();
	schoolList[schoolList.length] = "测试院校1";
	schoolList[schoolList.length] = "测试院校2";
	schoolList[schoolList.length] = "测试院校3";
	schoolList[schoolList.length] = "测试院校4";

	var schoolListSimple = new Array();
	schoolListSimple[schoolListSimple.length] = "简称1";
	schoolListSimple[schoolListSimple.length] = "简称2";
	schoolListSimple[schoolListSimple.length] = "简称3";
	schoolListSimple[schoolListSimple.length] = "简称4";
/*
 *! Main Function Declare !
 */

/*
 *! Base Function Declare !
 */

function delayJumpURL(urlLink, delayTime) {
	setTimeout("top.location.href='" + urlLink + "'", delayTime);
}

function checkCookies() {
	var UA = getUserAgent();
	var OS = getSystemInfo();
	if (UA == 'Firefox' || UA == 'Safari' || UA == 'Chrome') {
		alert("操作系统：" + '\n' + OS + '\n' + '\n' + "设备资源：" + '\n' + screen.width + " * " + screen.height + '\n' + '\n' + "平台信息：" + '\n' + navigator.platform + '\n' + '\n' + "访问方式：" + '\n' + UA + '\n' + '\n' + "用户信息：" + '\n' + navigator.userAgent + '\n' + '\n' + "Cookie 信息：" + '\n' + document.cookie + '\n' + '\n' + "联系我们：" + '\n' + "wth88888888@gmail.com");
	}
	else {
		alert("操作系统：" + '\r\n' + OS + '\r\n' + '\r\n' + "设备资源：" + '\r\n' + screen.width + " * " + screen.height + '\r\n' + '\r\n' + "平台信息：" + '\r\n' + navigator.platform + '\r\n' + '\r\n' + "访问方式：" + '\r\n' + UA + '\r\n' + '\r\n' + "用户信息：" + '\r\n' + navigator.userAgent + '\r\n' + '\r\n' + "Cookie 信息：" + '\r\n' + document.cookie + '\r\n' + '\r\n' + "联系我们：" + '\r\n' + "wth88888888@gmail.com");
	}
}

function getUserAgent() {
	var getUA = "BAKA: " + navigator.userAgent;
	if (isMSIE = (getUA.indexOf("MSIE") > -1 || getUA.indexOf("Trident") > -1)) {
		return "MSIE";
	}
	else if (isOpera = (getUA.indexOf("Opera") > -1 || getUA.indexOf("OPR") > -1)) {
		return "Opera";
	}
	else if (isChrome = getUA.indexOf("Chrome") > -1) {
		return "Chrome";
	}
	else if (isFirefox = getUA.indexOf("Firefox") > -1) {
		return "Firefox";
	}
	else if (isSafari = getUA.indexOf("Safari") > -1) {
		return "Safari";
	}
	else if (isCamino = getUA.indexOf("Camino") > -1) {
		return "Camino";
	}
	else if (isMozilla = getUA.indexOf("Gecko") > -1) {
		return "Gecko";
	}
	else {
		return "Unknown";
	}
}

function getTextCookie(name) {
	var result = "null";
	var searchName = name + "=";
	var searchLang = searchName.length;
	var myCookie = document.cookie + ";";
	var startOfCookie = myCookie.indexOf(searchName);
	var endOfCookie;
	var countOfCookie;
	if (startOfCookie != -1) {
		countOfCookie = parseInt(startOfCookie) + parseInt(searchLang);
		endOfCookie = myCookie.indexOf(";", countOfCookie);
		result = myCookie.substring(countOfCookie, endOfCookie);
	}
	return result;
}

function getSystemInfo() {
	var getNP = "BAKA: " + navigator.platform;
	var getUA = "BAKA: " + navigator.userAgent;
	var isWin = ((navigator.platform == "Win32") || (navigator.platform == "WoW64") || (navigator.platform == "Windows"));
	var isMac = ((navigator.platform == "Mac68K") || (navigator.platform == "MacPPC") || (navigator.platform == "Macintosh") || (navigator.platform == "MacIntel"));
	var isiOS = (getNP.indexOf("iOS") > -1 || getNP.indexOf("iPhone") > -1 || getNP.indexOf("IPad") > -1);
	var isUnix = (getNP.indexOf("X11") > -1 || getNP.indexOf("Linux") > -1 || getNP.indexOf("Android") > -1);
	var isMoblie = ((navigator.platform == "BlackBerry" && navigator.platform == "Symbian" && navigator.platform == "CE" && navigator.platform == "PPC" && navigator.platform == "iPod"));
	if (isWin) {
		if (getUA.indexOf("Win95") > -1 || getUA.indexOf("Windows 95") > -1) {
			return "Windows 95";
		}
		else if (getUA.indexOf("Win98") > -1 || getUA.indexOf("Windows 98") > -1) {
			return "Windows 98";
		}
		else if (getUA.indexOf("Win 9x 4.90") > -1 || getUA.indexOf("Windows ME") > -1) {
			return "Windows ME";
		}
		else if (getUA.indexOf("Windows NT 5.0") > -1 || getUA.indexOf("Windows 2000") > -1) {
			return "Windows 2000";
		}
		else if (getUA.indexOf("Windows NT 5.1") > -1 || getUA.indexOf("Windows XP") > -1) {
			return "Windows XP";
		}
		else if (getUA.indexOf("Windows NT 5.2") > -1 || getUA.indexOf("Windows 2003") > -1) {
			return "Windows 2003";
		}
		else if (getUA.indexOf("Windows NT 6.0") > -1 || getUA.indexOf("Windows Vista") > -1) {
			return "Windows Vista";
		}
		else if (getUA.indexOf("Windows NT 6.1") > -1 || getUA.indexOf("Windows 7") > -1) {
			return "Windows 7";
		}
		else if (getUA.indexOf("Windows NT 6.2") > -1 || getUA.indexOf("Windows 8") > -1) {
			return "Windows 8";
		}
		else if (getUA.indexOf("Windows NT 6.3") > -1 || getUA.indexOf("Windows 8.1") > -1) {
			return "Windows 8.1";
		}
		else {
			return "Unknown Windows Device";
		}
	}
	else if (isMac) {
		if (getUA.indexOf("Mac_68000") > -1 || getUA.indexOf("68K") > -1) {
			return "MacBook 68000";
		}
		else if (getUA.indexOf("PowerPC") > -1 || getUA.indexOf("PPC") > -1) {
			return "MacBook PowerPC";
		}
		else if (getUA.indexOf("Mac OS") > -1 || getUA.indexOf("Macintosh") > -1 || getUA.indexOf("MacIntel") > -1) {
			return "MacBook - Unknown";
		}
		else {
			return "Unknown Mac Device";
		}
	}
	else if (isUnix) {
		if (getUA.indexOf("Android 1.0") > -1){
			return "Android 1.0";
		}
		else if (getUA.indexOf("Android 1.1") > -1){
			return "Android 1.1";
		}
		else if (getUA.indexOf("Android 1.5") > -1 || getUA.indexOf("Cupcake") > -1){
			return "Android 1.5 - Cupcake";
		}
		else if (getUA.indexOf("Android 1.6") > -1 || getUA.indexOf("Donut") > -1){
			return "Android 1.6 - Donut";
		}
		else if (getUA.indexOf("Android 2.0") > -1 || getUA.indexOf("Android 2.1") > -1 || getUA.indexOf("Eclair") > -1){
			return "Android 2.0/2.1 - Eclair";
		}
		else if (getUA.indexOf("Android 2.2") > -1 || getUA.indexOf("Froyo") > -1){
			return "Android 2.2 - Froyo";
		}
		else if (getUA.indexOf("Android 2.3") > -1 || getUA.indexOf("Cupcake") > -1){
			return "Android 2.3 - Gingerbread";
		}
		else if (getUA.indexOf("Android 3.0") > -1 || getUA.indexOf("Android 3.1") > -1 || getUA.indexOf("Android 3.2") > -1 || getUA.indexOf("Honeycomb") > -1){
			return "Android 3.0/3.1/3.2 - Honeycomb";
		}
		else if (getUA.indexOf("Android 4.0") > -1 || getUA.indexOf("ICS") > -1 || getUA.indexOf("IceCreamSandwich") > -1 || getUA.indexOf("Ice Cream Sandwich") > -1){
			return "Android 4.0 - Ice Cream Sandwich";
		}
		else if (getUA.indexOf("Android 4.1") > -1 || getUA.indexOf("Android 4.2") > -1 || getUA.indexOf("JB") > -1  || getUA.indexOf("JellyBean") > -1 || getUA.indexOf("Jelly Bean") > -1){
			return "Android 4.1/4.2 - Jelly Bean";
		}
		else if (getUA.indexOf("SunOS") > -1 || getUA.indexOf("Sun_OS") > -1) {
			return "Linux Sun OS";
		}
		else if ((getUA.indexOf("Android") > -1 || getNP.indexOf("Android") > -1) && getUA.indexOf("Tablet") > -1) {
			return "Unknown Android Tablet Devices";
		}
		else if (getUA.indexOf("Android") > -1 || getNP.indexOf("Android") > -1) {
			return "Unknown Android Devices";
		}
		else if (getUA.indexOf("Tablet") > -1) {
			return "Unknown Tablet Devices";
		}
		else {
			return "Unknown Linux Devices";
		}
	}
	else if (isiOS){
		return "Unknown iOS Devices";
	}
	else if (isMoblie){
		return "Unknown Moblie Devices";
	}
	else {
		return "Unknown";
	}
}

function generateKey() {
	var genKey = new Array();
	var tempString = new String;
	for (leftVar = 0; leftVar < 5; leftVar++) {
		genKey[leftVar] = new Array();
		for (rightVar = 0; rightVar < 5; rightVar++) {
			if (leftVar != rightVar) {
				genKey[leftVar][rightVar] = String.fromCharCode(parseInt(Math.random() * (65 - 90 + 1) + 90));
			} else {
				genKey[leftVar][rightVar] = ' ';
			};
		};
	};
	for (leftVar = 0; leftVar < 5; leftVar++) {
		for (rightVar = 0; rightVar < 5; rightVar++) {
			if (leftVar == 0 && rightVar == 1 || leftVar == 1 && rightVar == 2 || leftVar == 2 && rightVar ==3 || leftVar == 3 && rightVar == 4 || leftVar == 4 && rightVar == 4) {
				tempString += "!";
			} else if (leftVar == rightVar) {
				if (leftVar != 0) {
					tempString += "!-";
				};
			} else {
				tempString += genKey[leftVar][rightVar];
			};
		};
	};
	var keyFir = tempString.substr(0, 6);
	var keySec = tempString.substr(7, 6);
	var keyThi = tempString.substr(14, 6);
	var keyFor = tempString.substr(21, 6);
	var keyFirTemp1 = String.fromCharCode(parseInt((keyFir[1].charCodeAt() + keyFir[2].charCodeAt() + keyFir[3].charCodeAt()) / 3));
	var keyFirTemp2 = String.fromCharCode(parseInt((keyFir[2].charCodeAt() + keyFir[3].charCodeAt() + keyFir[4].charCodeAt()) / 3));
	var keyFirNew = keyFirTemp1 + keyFir[1] + keyFir[2] + keyFir[3] + keyFir[4] + keyFirTemp2;
	var keySecTemp1 = String.fromCharCode(parseInt((keySec[1].charCodeAt() + keySec[2].charCodeAt() + keySec[3].charCodeAt()) / 3));
	var keySecTemp2 = String.fromCharCode(parseInt((keySec[2].charCodeAt() + keySec[3].charCodeAt() + keySec[4].charCodeAt()) / 3));
	var keySecNew = keySecTemp1 + keySec[1] + keySec[2] + keySec[3] + keySec[4] + keySecTemp2;
	var keyThiTemp1 = String.fromCharCode(parseInt((keyThi[1].charCodeAt() + keyThi[2].charCodeAt() + keyThi[3].charCodeAt()) / 3));
	var keyThiTemp2 = String.fromCharCode(parseInt((keyThi[2].charCodeAt() + keyThi[3].charCodeAt() + keyThi[4].charCodeAt()) / 3));
	var keyThiNew = keyThiTemp1 + keyThi[1] + keyThi[2] + keyThi[3] + keyThi[4] + keyThiTemp2;
	var keyForTemp1 = String.fromCharCode(parseInt((keyFor[1].charCodeAt() + keyFor[2].charCodeAt() + keyFor[3].charCodeAt()) / 3));
	var keyForTemp2 = String.fromCharCode(parseInt((keyFor[2].charCodeAt() + keyFor[3].charCodeAt() + keyFor[4].charCodeAt()) / 3));
	var keyForNew = keyForTemp1 + keyFor[1] + keyFor[2] + keyFor[3] + keyFor[4] + keyForTemp2;
	var mixString = keyFirNew.toString() + "-" + keySecNew.toString() + "-" + keyThiNew.toString() + "-" + keyForNew.toString();
	document.getElementById("UID").value = mixString.toString();
}

function validationKey(){
	var mixString = document.getElementById("UID").value;
	if (mixString.length != 27) {
		document.getElementById("tips5").innerHTML = "（<font style=\"color: Red\"><b>请勿修改</b></font> | <a href='javascript: void(0);' onclick='generateKey();'>重新生成</a>）";
		generateKey();
		return false;
	}
	var getKeyFir = mixString.substr(0, 6);
	var getKeySec = mixString.substr(7, 6);
	var getKeyThi = mixString.substr(14, 6);
	var getKeyFor = mixString.substr(21, 6);
	if (getKeyFir[0].charCodeAt() == parseInt((getKeyFir[1].charCodeAt() + getKeyFir[2].charCodeAt() + getKeyFir[3].charCodeAt()) / 3) && getKeyFir[5].charCodeAt() == parseInt((getKeyFir[2].charCodeAt() + getKeyFir[3].charCodeAt() + getKeyFir[4].charCodeAt()) / 3)) {
		var valiKeyLine1 = true;
	};
	if (getKeySec[0].charCodeAt() == parseInt((getKeySec[1].charCodeAt() + getKeySec[2].charCodeAt() + getKeySec[3].charCodeAt()) / 3) && getKeySec[5].charCodeAt() == parseInt((getKeySec[2].charCodeAt() + getKeySec[3].charCodeAt() + getKeySec[4].charCodeAt()) / 3)) {
		var valiKeyLine2 = true;
	};
	if (getKeyThi[0].charCodeAt() == parseInt((getKeyThi[1].charCodeAt() + getKeyThi[2].charCodeAt() + getKeyThi[3].charCodeAt()) / 3) && getKeyThi[5].charCodeAt() == parseInt((getKeyThi[2].charCodeAt() + getKeyThi[3].charCodeAt() + getKeyThi[4].charCodeAt()) / 3)) {
		var valiKeyLine3 = true;
	};
	if (getKeyFor[0].charCodeAt() == parseInt((getKeyFor[1].charCodeAt() + getKeyFor[2].charCodeAt() + getKeyFor[3].charCodeAt()) / 3) && getKeyFor[5].charCodeAt() == parseInt((getKeyFor[2].charCodeAt() + getKeyFor[3].charCodeAt() + getKeyFor[4].charCodeAt()) / 3)) {
		var valiKeyLine4 = true;
	};
	if (!valiKeyLine1 || !valiKeyLine2 || !valiKeyLine3 || !valiKeyLine4) {
		document.getElementById("tips5").innerHTML = "（<font style=\"color: Red\"><b>请勿修改</b></font> | <a href='javascript: void(0);' onclick='generateKey();'>重新生成</a>）";
		generateKey();
		return false;
	} else {
		return true;
	};
}

function checkForm() {
	var text = document.getElementById("name").value;
	var obj1 = document.getElementsByName("sex");
	var obj2 = document.getElementsByName("localp");
	var schoolChoose1 = document.getElementById("mySelect1");
	schoolChooseValue1 = schoolChoose1.selectedIndex;
	var schoolChoose2 = document.getElementById("mySelect2");
	schoolChooseValue2 = schoolChoose2.selectedIndex;
	var thisUID = document.getElementById("UID").value;
	var myUID = document.getElementById("UIDCheck").value;
	if ((text != "") && (obj1[0].checked || obj1[1].checked) && (obj2[0].checked || obj2[1].checked) && !schoolChoose2.disabled && (myUID == thisUID)) {
		document.getElementById("tips1").innerHTML = "";
		document.getElementById("tips2").innerHTML = "";
		document.getElementById("tips3").innerHTML = "* 必须填写";
		document.getElementById("tips4").innerHTML = "* 请勿修改";
		return true;
	} else {
		if (!obj1[0].checked && !obj1[1].checked) {
			document.getElementById("tips1").innerHTML = "<font style=\"color: Red\"><b>* 必填</b></font>";
		} else {
			document.getElementById("tips1").innerHTML = "";
		}
		if (!obj2[0].checked && !obj2[1].checked) {
			document.getElementById("tips2").innerHTML = "<font style=\"color: Red\"><b>* 必填</b></font>";
		} else {
			document.getElementById("tips2").innerHTML = "";
		}
		if (schoolChoose2.disabled) {
			document.getElementById("tips3").innerHTML = "<font style=\"color: Red\"><b>* 必须填写</b></font>";
		} else {
			document.getElementById("tips3").innerHTML = "* 必须填写";
		}
		if (myUID != thisUID) {
			document.getElementById("tips4").innerHTML = "<font style=\"color: Red\"><b>* 请勿修改</b></font>";
			document.getElementById("UID").value = document.getElementById("UIDCheck").value;
		} else {
			document.getElementById("tips4").innerHTML = "* 请勿修改";
		}
		return false;
	}
}

function checkFormLogin() {
	if (document.getElementsByTagName("input").item(0).value == "" && document.getElementsByTagName("input").item(2).value == "") {
		document.getElementById("tips1").innerHTML = "<font style=\"color: Red\"><b>* 必填</b></font>";
		document.getElementById("tips2").innerHTML = "<font style=\"color: Red\"><b>* 必填</b></font>";
		return false;
	} else if (document.getElementsByTagName("input").item(1).value == "") {
		document.getElementById("tips2").innerHTML = "<font style=\"color: Red\"><b>* 必填</b></font>";
		return false;
	} else if (document.getElementsByTagName("input").item(0).value == "") {
		document.getElementById("tips1").innerHTML = "<font style=\"color: Red\"><b>* 必填</b></font>";
		return false;
	} else {
		document.getElementById("tips1").innerHTML = "* 必填";
		document.getElementById("tips2").innerHTML = "* 必填";
	}
}

function checkFormRegister() {
	if (document.getElementsByTagName("input").item(2).value == "" && document.getElementsByTagName("input").item(3).value == "") {
		document.getElementById("tips3").innerHTML = "<font style=\"color: Red\"><b>* 必填</b></font>";
		document.getElementById("tips4").innerHTML = "<font style=\"color: Red\"><b>* 必填</b></font>";
		return false;
	} else if (document.getElementsByTagName("input").item(3).value == "") {
		document.getElementById("tips4").innerHTML = "<font style=\"color: Red\"><b>* 必填</b></font>";
		return false;
	} else if (document.getElementsByTagName("input").item(2).value == "") {
		document.getElementById("tips3").innerHTML = "<font style=\"color: Red\"><b>* 必填</b></font>";
		return false;
	} else {
		document.getElementById("tips3").innerHTML = "* 必填";
		document.getElementById("tips4").innerHTML = "* 必填";
	}
	return validationKey();
}

function checkKey() {
	var mixString = document.getElementById("UIDSearcherCheck").value;
	if (mixString.length != 27) {
		document.getElementById("UIDSearcherCheck").value = document.getElementById("UIDCheck").value;
		document.getElementById("tips6").innerHTML = "<font style=\"color: Red\"><b>* 无法识别</b></font>";
		return false;
	}
	var getKeyFir = mixString.substr(0, 6);
	var getKeySec = mixString.substr(7, 6);
	var getKeyThi = mixString.substr(14, 6);
	var getKeyFor = mixString.substr(21, 6);
	if (getKeyFir[0].charCodeAt() == parseInt((getKeyFir[1].charCodeAt() + getKeyFir[2].charCodeAt() + getKeyFir[3].charCodeAt()) / 3) && getKeyFir[5].charCodeAt() == parseInt((getKeyFir[2].charCodeAt() + getKeyFir[3].charCodeAt() + getKeyFir[4].charCodeAt()) / 3)) {
		var valiKeyLine1 = true;
	};
	if (getKeySec[0].charCodeAt() == parseInt((getKeySec[1].charCodeAt() + getKeySec[2].charCodeAt() + getKeySec[3].charCodeAt()) / 3) && getKeySec[5].charCodeAt() == parseInt((getKeySec[2].charCodeAt() + getKeySec[3].charCodeAt() + getKeySec[4].charCodeAt()) / 3)) {
		var valiKeyLine2 = true;
	};
	if (getKeyThi[0].charCodeAt() == parseInt((getKeyThi[1].charCodeAt() + getKeyThi[2].charCodeAt() + getKeyThi[3].charCodeAt()) / 3) && getKeyThi[5].charCodeAt() == parseInt((getKeyThi[2].charCodeAt() + getKeyThi[3].charCodeAt() + getKeyThi[4].charCodeAt()) / 3)) {
		var valiKeyLine3 = true;
	};
	if (getKeyFor[0].charCodeAt() == parseInt((getKeyFor[1].charCodeAt() + getKeyFor[2].charCodeAt() + getKeyFor[3].charCodeAt()) / 3) && getKeyFor[5].charCodeAt() == parseInt((getKeyFor[2].charCodeAt() + getKeyFor[3].charCodeAt() + getKeyFor[4].charCodeAt()) / 3)) {
		var valiKeyLine4 = true;
	};
	if (!valiKeyLine1 || !valiKeyLine2 || !valiKeyLine3 || !valiKeyLine4) {
		document.getElementById("tips6").innerHTML = "<font style=\"color: Red\"><b>* 无法识别</b></font>";
		generateKey();
		return false;
	} else {
		return true;
	};
}

function genOption() {
	var schoolChoose1 = document.getElementById("mySelect1");
	var schoolChooseValue1 = schoolChoose1.selectedIndex;
	var schoolChoose2 = document.getElementById("mySelect2");
	var schoolChooseValue2 = schoolChoose2.selectedIndex;
	var schoolInfo;
	schoolChoose2.disabled = true;
	document.getElementById("mySelect1").options.length = 0;
	for (loop = 0; loop <= schoolList.length - 1; loop++) {
		schoolInfo = document.createElement("option");
		schoolInfo.text = schoolList[loop];
		schoolInfo.value = schoolListSimple[loop];
		document.getElementById("mySelect1").add(schoolInfo);
	}
}

function deleteNext() {
	var schoolInfo;
	var schoolChoose1 = document.getElementById("mySelect1");
	var schoolChooseValue1 = schoolChoose1.selectedIndex;
	var schoolChoose2 = document.getElementById("mySelect2");
	var schoolChooseValue2 = schoolChoose2.selectedIndex;
	schoolChoose2.disabled = false;
	document.getElementById("mySelect2").options.length = 0;
	for (loop = 0; loop <= schoolList.length - 1; loop++) {
		if (loop != schoolChooseValue1) {
			schoolInfo = document.createElement("option");
			schoolInfo.text = schoolList[loop];
			schoolInfo.value = schoolListSimple[loop];
			document.getElementById("mySelect2").add(schoolInfo);
		}
	}
}

function searchInfo(action) {
	if (action == "getThread") {
		delayJumpURL("./searchInfo.php?action=" + action + "&keyword=" + document.getElementById("searchInfo").value + "&page=1&display=default", 0);
	} else {
		delayJumpURL("./searchInfo.php?action=" + action + "&keyword=" + document.getElementById("searchInfo").value + "&tid=" + document.getElementsByTagName("input").item(0).value + "&page=1&display=default", 0);
	}
}