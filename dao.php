<?php

class dao
{
	private $conStr;

	public function dao()
	{
	}
	
	// Žæ“¾
	public function getRecords($sql)
	{
		//$link = mysql_connect('brthdb.cetjzfpmiivw.us-west-2.rds.amazonaws.com', 'root', 'admin123daa');
		$link = mysql_connect('testdb.cjnxpxdsgipg.us-west-2.rds.amazonaws.com', 'awsuser', 'admin123daa');

		if (!$link) {
			print(mysql_error());
		} else {
			//echo "OK";
		}

		//$db_selected = mysql_select_db('brth', $link);
		$db_selected = mysql_select_db('brth_20150627', $link);
		
		if (!$db_selected){
			die('DB select error');
		}
		$result = mysql_query($sql);

		mysql_close($link);
		return $result;
	}

	// “o˜^
	public function inputRecords($sql)
	{
		//$link = mysql_connect('brthdb.cetjzfpmiivw.us-west-2.rds.amazonaws.com', 'root', 'admin123daa');
		$link = mysql_connect('testdb.cjnxpxdsgipg.us-west-2.rds.amazonaws.com', 'awsuser', 'admin123daa');

		if (!$link) {
			print(mysql_error());
		} else {
			//echo "OK";
		}

		//$db_selected = mysql_select_db('brth', $link);
		$db_selected = mysql_select_db('brth_20150627', $link);

		if (!$db_selected){
			die('DB insert error');
		}
		$result = mysql_query($sql);

		if (!$result) {
		    die('INSERT NG'.mysql_error());
		}

		mysql_close($link);
		return $result;
	}
}
