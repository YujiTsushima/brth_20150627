<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	

<script language="JavaScript">
	function setStatus(){
		// リダイレクト
		//location.href="http://ec2-52-10-225-227.us-west-2.compute.amazonaws.com/main/"
		document.member.submit();
	}
	
	function detail(id){
		document.detail.detailid.value = id;
		document.detail.submit();
	}
</script>


<?php

require "dao.php"; 
require "const.php"; 

session_start();

$dao = new dao();

// [掛ける]ボタンが押されたあと
if (isset($_POST['kakeru']) && $_POST['kakeru'] != "") {
	$teamids = $_POST['teamid'];

	foreach ($teamids as $teamid) {
		$sql = "replace INTO tbl_bet VALUES('yoshikawa' ," .$teamid. "," .$_POST['kakekin' .$teamid]. ");";
		$ret = $dao->inputRecords($sql);
 	}
}

if (isset($_POST['btn']) && $_POST['btn'] != "") {
	$ids = $_POST['id'];
	//print_r($ids);
	
	foreach ($ids as $id) {
	// 合計値
	$item1value = 4 - $_POST[$id .'_item1'];
	$item2value = 4 - $_POST[$id .'_item2'];
	$item3value = 4 - $_POST[$id .'_item3'];
	
	if ($_POST[$id .'_item4'] == 4) {
		$item4value = 0;
	} else {
		$item4value = 3;
	}
	if ($_POST[$id .'_item5'] == 4) {
		$item5value = 0;
	} else {
		$item5value = -3;
	}
	$sum = $item1value + $item2value  + $item3value + $item4value + $item5value;
	
	$rank = "";
	if ($sum <= 3) {
		$rank = SAIYA_5;
	} else if ($sum <= 6) {
		$rank = SAIYA_4;
	} else if ($sum <= 9) {
		$rank = SAIYA_3;
	} else if ($sum <= 11) {
		$rank = SAIYA_2;
	} else {
		$rank = SAIYA_1;
	}
	
	$sql = "update tbl_member set ";
	$sql .= " tec_val = " .$_POST[$id .'_item1'];
	$sql .= ",com_val = " .$_POST[$id .'_item2'];
	$sql .= ",miracle_val = " .$_POST[$id .'_item3'];
	$sql .= ",pulse_val = " .$_POST[$id .'_item4'];
	$sql .= ",minuse_val = " .$_POST[$id .'_item5'];
	$sql .= ",sum_val = " .$sum;
	$sql .= ",paramater = " .$sum * 1000000;
	$sql .= ",rank = '" .$rank. "'";
	
	$sql .= " where id = ".$id .";";
	
	//echo $sql ."<br>";
	
	$ret = $dao->inputRecords($sql);
	/*
	echo $_POST['item1'] ."<br>";
	echo $_POST['item2'] ."<br>";
	echo $_POST['item3'] ."<br>";
	echo $_POST['item4'] ."<br>";
	echo $_POST['item5'] ."<br>";
	*/
	}
}

// チーム情報を取得
$team = $dao->getRecords('SELECT * FROM tbl_team');
$teamYosoku = $dao->getRecords('SELECT * FROM tbl_team ORDER BY RAND() limit 0, 3;');

$member="";
if (isset($_POST['detailid']) && $_POST['detailid'] != "") {
	echo $_POST['detailid'];
	$member = $dao->getRecords('SELECT * FROM tbl_member where team_id = ' .$_POST['detailid']. ' order by id;');
}
?>

<body>
	
	<form name="detail" method="POST" action="main.php">
		<input type="hidden" name="detailid" value="">
	</form>

<div id="topleft">
	<span style="font-weight: bold;">予測</span>
	<div id="teamYosokuWrap">
		<table id="teamYosoku">
			<tr>
				<th>チーム名</th>
				<th>配当金</th>
			</tr>
			<?php
				$i=1;
				while($row = mysql_fetch_assoc($teamYosoku)){
					print "	<tr><td>";
					print $i++ . " . " . $row['name'];
					print "	</td><td>";
					print "	\\1,234,567";
					print "	</td></tr>";
				}
			?>
		</table>
	</div>
</div>
<div id="topright">
	<form name="team" method="POST" action="main.php">
		<table id="team">
			<tr>
				<th>チーム名</th>
				<th>詳細</th>
				<th>かけ金</th>
			</tr>
			<?php
				while($row = mysql_fetch_assoc($team)){
					echo "<input type='hidden' name='teamid[]' value='" .$row['id']. "'>";
					
					print "	<tr><td>";
					print $row['id'] . " . " . $row['name'];
					print "	</td><td>";
				//	print "<input type='link' value='詳細' name='detail" .$row['id']. "' onclick='detail(" .$row['id']. ");'>";
				print '<a href="javascript:detail(' .$row['id']. ');">詳細</a>';
					print "	</td><td>";
					print "	<input type='text' name='kakekin" . $row['id'] . "' size='20' maxlength='20'>VND";
					print "	</td></tr>";
				}
			?>
			<tr>
				<td colspan="3" style="text-align:right;"><input type="submit" name="kakeru" value="賭ける" /></td>
			</tr>
		</table>
	</form>
</div>
<br clear="left">

<form name="member" method="POST" action="main.php">
<table id="member">
	<tr>
		<th style="width:100px">名前</th>
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
		echo "<input type='hidden' name='id[]' value='" .$row['id']. "'>";
		
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
		switch ($row['tec_val']) {
			case 1:$item1_1 = $str; break;
			case 2:$item1_2 = $str; break;
			case 3:$item1_3 = $str; break;
			default:$item1_2 = $str;
		}
		// コミュ力
		switch ($row['com_val']) {
			case 1:$item2_1 = $str; break;
			case 2:$item2_2 = $str; break;
			case 3:$item2_3 = $str; break;
			default:$item2_2 = $str;
		}
		// ミラクル
		switch ($row['miracle_val']) {
			case 1:$item3_1 = $str; break;
			case 2:$item3_2 = $str; break;
			case 3:$item3_3 = $str; break;
			default:$item3_2 = $str;
		}
		// プラス
		switch ($row['pulse_val']) {
			case 1:$item4_1 = $str; break;
			case 2:$item4_2 = $str; break;
			case 3:$item4_3 = $str; break;
			case 4:$item4_4 = $str; break;
			default:$item4_4 = $str;
		}
		// マイナス
		switch ($row['minuse_val']) {
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
		print "<input type='radio' value='1' name='" .$row['id']. "_item1' " .$item1_1. ">" .ITEM1_1 ."<br>";
		print "<input type='radio' value='2' name='" .$row['id']. "_item1' " .$item1_2. ">" .ITEM1_2 ."<br>";
		print "<input type='radio' value='3' name='" .$row['id']. "_item1' " .$item1_3. ">" .ITEM1_3 ."<br>";
		print "	</td>";
		// コミュ力
		print "	<td>";
		print "<input type='radio' value='1' name='" .$row['id']. "_item2' " .$item2_1. ">" .ITEM2_1 ."<br>";
		print "<input type='radio' value='2' name='" .$row['id']. "_item2' " .$item2_2. ">" .ITEM2_2 ."<br>";
		print "<input type='radio' value='3' name='" .$row['id']. "_item2' " .$item2_3. ">" .ITEM2_3 ."<br>";
		print "	</td>";
		// ミラクル
		print "	<td>";
		print "<input type='radio' value='1' name='" .$row['id']. "_item3' " .$item3_1. ">" .ITEM3_1 ."<br>";
		print "<input type='radio' value='2' name='" .$row['id']. "_item3' " .$item3_2. ">" .ITEM3_2 ."<br>";
		print "<input type='radio' value='3' name='" .$row['id']. "_item3' " .$item3_3. ">" .ITEM3_3 ."<br>";
		print "	</td>";
		// プラス
		print "	<td>";
		print "<input type='radio' value='1' name='" .$row['id']. "_item4' " .$item4_1. ">" .ITEM4_1 ."<br>";
		print "<input type='radio' value='2' name='" .$row['id']. "_item4' " .$item4_2. ">" .ITEM4_2 ."<br>";
		print "<input type='radio' value='3' name='" .$row['id']. "_item4' " .$item4_3. ">" .ITEM4_3 ."<br>";
		print "<input type='radio' value='4' name='" .$row['id']. "_item4' " .$item4_4. ">" .ITEM4_4 ."<br>";
		print "	</td>";
		// マイナス
		print "	<td>";
		print "<input type='radio' value='1' name='" .$row['id']. "_item5' " .$item5_1. ">" .ITEM5_1 ."<br>";
		print "<input type='radio' value='2' name='" .$row['id']. "_item5' " .$item5_2. ">" .ITEM5_2 ."<br>";
		print "<input type='radio' value='3' name='" .$row['id']. "_item5' " .$item5_3. ">" .ITEM5_3 ."<br>";
		print "<input type='radio' value='4' name='" .$row['id']. "_item5' " .$item5_4. ">" .ITEM5_4 ."<br>";
		print "	</td>";
		// 合計値
		print "	<td style='text-align:right;'>";
		print number_format($row['paramater']);
		print "	</td>";
		// クラス
		print "	<td style='text-align:right;'>";
		print $row['rank'];
		print "	</td>";
		
		print "</tr>";
	}
?>
	
</table>


<div style="height:50px;"></div>
<input type="submit" name="btn" value="設定">
</form>
		
</body>
</html>
