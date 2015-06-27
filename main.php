<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	

<script language="JavaScript">
	function setStatus(){
		// リダイレクト
		//location.href="http://ec2-52-10-225-227.us-west-2.compute.amazonaws.com/main//
		document.member.submit();
	}
</script>


<?php

require "dao.php"; 
require "const.php"; 

session_start();

print_r($_POST);
if ($_POST['btn'] != "") {
	echo "ddddddd";
}


$dao = new dao();

//$ret = $dao->inputRecords("insert into tbl_team (name) values('aaa');");
/*
$ret = $dao->getRecords('SELECT * FROM tbl_team');

if ($ret == null) {
    die('NG');
} else {
	while($row = mysql_fetch_assoc($ret)){
		print($row['id']);
		print($row['name']);
	}
}
*/
// チーム情報を取得
$member = $dao->getRecords('SELECT * FROM tbl_member where ID = 1 orer by ID');

?>

<body>

<form name="member" method="POST" action="main.php">
<table id="member">
	<tr>
		<th>名前</th>
		<th>技術力</th>
		<th>コミュ力</th>
		<th>ミラクル</th>
		<th>プラス</th>
		<th>マイナス</th>
		<td class="sento">戦闘力</th>
		<td class="sentoclass">クラス</th>
	</tr>
<?php
	while($row = mysql_fetch_assoc($member)){
		
		$str = "checked";
		$item1_1 = "";
		$item1_2 = "";
		$item1_3 = "";
		$item2_1 = "";
		$item2_2 = "";
		$item2_3 = "";
		$item3_1 = "";
		$item3_2 = "";
		$item3_3 = "";
		$item4_1 = "";
		$item4_2 = "";
		$item4_3 = "";
		$item4_4 = "";
		$item5_1 = "";
		$item5_2 = "";
		$item5_3 = "";
		$item5_4 = "";
		
		// 技術力
		switch ($row['name']) {
			case 1:$item1_1 = $str; break;
			case 2:$item1_2 = $str; break;
			case 3:$item1_3 = $str; break;
			default:$item1_2 = $str;
		}
		// コミュ力
		switch ($row['name']) {
			case 1:$item2_1 = $str; break;
			case 2:$item2_2 = $str; break;
			case 3:$item2_3 = $str; break;
			default:$item2_2 = $str;
		}
		// ミラクル
		switch ($row['name']) {
			case 1:$item3_1 = $str; break;
			case 2:$item3_2 = $str; break;
			case 3:$item3_3 = $str; break;
			default:$item3_2 = $str;
		}
		// プラス
		switch ($row['name']) {
			case 1:$item4_1 = $str; break;
			case 2:$item4_2 = $str; break;
			case 3:$item4_3 = $str; break;
			case 4:$item4_4 = $str; break;
			default:$item5_4 = $str;
		}
		// マイナス
		switch ($row['name']) {
			case 1:$item5_1 = $str; break;
			case 2:$item5_2 = $str; break;
			case 3:$item5_3 = $str; break;
			case 4:$item5_4 = $str; break;
			default:$item5_4 = $str;
		}
		
		print "<tr>";
		
		// 名前
		print "	<td>";
		print $row['name'];
		print "	</td>";
		// 技術力
		print "	<td>";
		print "<input type='radio' value='1' name='item1' " .$item1_1. ">" .ITEM1_1;
		print "<input type='radio' value='2' name='item1' " .$item1_2. ">" .ITEM1_2;
		print "<input type='radio' value='3' name='item1' " .$item1_3. ">" .ITEM1_3;
		print "	</td>";
		// コミュ力
		print "	<td>";
		print "<input type='radio' value='1' name='item2' " .$item1_1. ">" .ITEM2_1;
		print "<input type='radio' value='2' name='item2' " .$item1_2. ">" .ITEM2_2;
		print "<input type='radio' value='3' name='item2' " .$item1_3. ">" .ITEM2_3;
		print "	</td>";
		// ミラクル
		print "	<td>";
		print "<input type='radio' value='1' name='item3' " .$item1_1. ">" .ITEM3_1;
		print "<input type='radio' value='2' name='item3' " .$item1_2. ">" .ITEM3_2;
		print "<input type='radio' value='3' name='item3' " .$item1_3. ">" .ITEM3_3;
		print "	</td>";
		// プラス
		print "	<td>";
		print "<input type='radio' value='1' name='item4' " .$item1_1. ">" .ITEM4_1;
		print "<input type='radio' value='2' name='item4' " .$item1_2. ">" .ITEM4_2;
		print "<input type='radio' value='3' name='item4' " .$item1_3. ">" .ITEM4_3;
		print "<input type='radio' value='4' name='item4' " .$item1_3. ">" .ITEM4_4;
		print "	</td>";
		// マイナス
		print "	<td>";
		print "<input type='radio' value='1' name='item5' " .$item1_1. ">" .ITEM5_1;
		print "<input type='radio' value='2' name='item5' " .$item1_2. ">" .ITEM5_2;
		print "<input type='radio' value='3' name='item5' " .$item1_3. ">" .ITEM5_3;
		print "<input type='radio' value='4' name='item5' " .$item1_4. ">" .ITEM5_4;
		print "	</td>";
		// 合計値
		print "	<td>";
		print "	</td>";
		// クラス
		print "	<td>";
		print "	</td>";
		
		print "</tr>";
	}
?>
	<tr>
		<td class="sum">合計</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	
</table>

<div style="height:50px;"></div>
<input type="button" name="btn" value="設定" onclick="setStatus();">
</form>
		
</body>
</html>
