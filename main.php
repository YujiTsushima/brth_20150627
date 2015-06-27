<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 

<?php

require "dao.php"; 

$dao = new dao();

$ret = $dao->inputRecords("insert into tbl_team (name) values('aaa');");

$ret = $dao->getRecords('SELECT * FROM tbl_team');

if ($ret == null) {
    die('NG');
} else {
	while($row = mysql_fetch_assoc($ret)){
		print($row['id']);
		print($row['name']);
	}
}

?>


</html>
