<?php
include_once "includes/bootstrap.inc";
include_once "includes/common.inc";


$result = db_query("select * from node INNER JOIN place ON place.nid = node.nid WHERE node.nid > 173 and node.type = 'place-bar'");
while ($node = db_fetch_object($result)) {
	if (stristr($node->address,"SW" )) {
		$tid = 275;
		
	}

	elseif (stristr($node->address,"NW")) {
		$tid = 273;
	}
	elseif (stristr($node->address,"SW")) {
		$tid = 275;
	}
	elseif (stristr($node->address,"NE")) {
		$tid = 272;
	}
	
	elseif (stristr($node->address,"SE")) {
		//$tid = 274;
	}
	

	if (!empty($tid)) {
		db_query("insert into term_node (nid, tid) VALUES ($node->nid,$tid)");
	}

	$tid = null;
	
}


?>