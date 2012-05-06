<?php
require("jsrsServer.php");
include_once "includes/bootstrap.inc";
include_once "includes/common.inc";
jsrsDispatch( "rate" );


function rate($variable) {
	global $user;
	
	$var = split("_",$variable);
	/**
	 * Do the rating.
	 */
	db_query ("INSERT INTO {place_ratings} (nid, type, score, ip, uid) VALUES (%d, '%s', %d, '%s', %d)", $var[0], $var[2], $var[1], $_SERVER[REMOTE_ADDR], $user->uid);
	$score = db_fetch_object(db_query("SELECT AVG(score) as score, count(*) as count FROM {place_ratings} WHERE nid = %d", $node->nid));
	db_query ("UPDATE {place} SET score = %d, votes = %d WHERE nid = %d", $score->score, $score->count, $node->nid);
	return "OK_" . $var[0] . "_" . $var[1] . "_" . $var[2];
}


?>