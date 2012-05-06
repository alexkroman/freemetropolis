<?php
include_once "includes/bootstrap.inc";
include_once "includes/common.inc";
$counter = 0;
$inc = 10;
$limit = 700;


while ($counter < $limit) {
	
	$get = "http://digitalcity.com/portland/dining/search.adp?skip=$counter";
	$place = file_get_contents($get);
	$place = explode("\n", $place);
	foreach ($place as $place_line) 
	{
		$go = false;
		
		if (stristr($place_line,"venue.adp" )) {
			$title = strip_tags($place_line);
			$go = true;
			if (!empty($title)) {
				echo $title . "\n";
				
				db_query("insert into {node} (type,title,created) VALUES ('place-restaurant','" . addslashes($title) . "'," . time() . ")");
			}
		}
		if (preg_match("/&nbsp;&nbsp;[0-9]/",$place_line )) {
			$address = strip_tags($place_line);
			$address = str_replace("&nbsp;&nbsp;","",$address);
			if (!empty($address)) {
				db_query("insert into {place} (nid, type, address, city, state) VALUES (" . mysql_insert_id() . ", 'place-restaurant','" . addslashes($address) ."','Portland','OR')");
			}
			
		}
		
		$title = null;
		$address = null;
		
		
	}
	
	$counter = $counter + $inc;
	
}



?>