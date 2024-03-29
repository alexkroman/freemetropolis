<?php
// $Id: database.mysql.inc,v 1.1.1.1 2004/07/24 19:09:42 alex Exp $

function db_connect($url) {
  $url = parse_url($url);

  // Allow for non-standard MySQL port.
  if (isset($url["port"])) {
     $url["host"] = $url["host"] . ":" . $url["port"];
  }

  mysql_connect($url["host"], $url["user"], $url["pass"]) or die(mysql_error());
  mysql_select_db(substr($url["path"], 1)) or die("unable to select database");

  /*
  ** Note that you can change the 'mysql_connect' statement to 'mysql_pconnect'
  ** if you want to use persistent connections.  This is not recommended on
  ** shared hosts, might require additional database/webserver tuning but
  ** increases performance when the overhead to connect to your database is
  ** high (eg. your database and webserver live on different machines).
  */
}

/**
 * Runs a query in the database.
 *
 * @param $query SQL query, followed by a variable number of arguments which
 *   are substituted into query by sprintf.
 * @return a MySQL result or FALSE if the query was not executed correctly.
 */
function db_query($query) {
  $args = func_get_args();

  $query = db_prefix_tables($query);
  if (count($args) > 1) {
    if(is_array($args[1])){
      $args1 = array_map("check_query", $args[1]);
      $nargs = array_merge(array($query), $args1);
    }
    else {
      $nargs = array_map("check_query", $args);
      $nargs[0] = $query;
    }
    return _db_query(call_user_func_array("sprintf", $nargs));
  }
  else {
    return _db_query($query);
  }
}

// debug version
function db_queryd($query) {
  $args = func_get_args();
  $query = db_prefix_tables($query);
  if (count($args) > 1) {
    if(is_array($args[1])){
      $args1 = array_map("check_query", $args[1]);
      $nargs = array_merge(array($query), $args1);
    }
    else {
      $nargs = array_map("check_query", $args);
      $nargs[0] = $query;
    }
    return _db_query(call_user_func_array("sprintf", $nargs), 1);
  }
  else {
    return _db_query($query, 1);
  }
}

// private
function _db_query($query, $debug = 0) {
  global $queries;


    list($usec, $sec) = explode(" ", microtime());
    $timer = (float)$usec + (float)$sec;
  

  $result = mysql_query($query);

    list($usec, $sec) = explode(" ", microtime());
    $stop = (float)$usec + (float)$sec;
    $diff = $stop - $timer;
    if ($diff > .5) {
    	$x_debug_queries .= $diff . " seconds " . $query . " from: " . $_SERVER['PHP_SELF'] . "\n";
	}
  if ($debug) {
    print "<p>query: $query<br />error:". mysql_error() ."</p>";
  }

  if (!mysql_errno()) {
    return $result;
  }
  else {
    trigger_error(mysql_error() ."\nquery: ". htmlspecialchars($query), E_USER_ERROR);
  }
}

function db_fetch_object($result) {
  if ($result) {
    return mysql_fetch_object($result);
  }
}

function db_fetch_array($result) {
  if ($result) {
    return mysql_fetch_array($result, MYSQL_ASSOC);
  }
}

function db_num_rows($result) {
  if ($result) {
    return mysql_num_rows($result);
  }
}

function db_result($result, $row = 0) {
  if ($result && mysql_num_rows($result) > $row) {
    return mysql_result($result, $row);
  }
}

function db_error() {
  return mysql_errno();
}

function db_next_id($name) {

  /*
  ** Note that REPLACE query below correctly creates a new sequence
  ** when needed
  */

  $name = db_prefix_tables($name);
  db_query("LOCK TABLES {sequences} WRITE");
  $id = db_result(db_query("SELECT id FROM {sequences} WHERE name = '%s'", $name)) + 1;
  db_query("REPLACE INTO {sequences} VALUES ('%s', %d)", $name, $id);
  db_query("UNLOCK TABLES");

  return $id;
}

function db_affected_rows() {
  return mysql_affected_rows();
}

/**
 * Runs a LIMIT query in the database.
 *
 * @param $query SQL query, followed by a variable number of arguments which
 *   are substituted into query by sprintf, followed by 'from' and 'count'
 *   parameters. 'from' is the row to start fetching, 'count' the numbers of
 *   rows to fetch.
 * @return a MySQL result or FALSE if the query was not executed correctly.
 */
function db_query_range($query) {
  $args = func_get_args();
  $count = array_pop($args);
  $from = array_pop($args);
  if (count(func_get_args()) > 3) {
    $args = array_map("check_query", $args);
    $query = db_prefix_tables($query);
    $args[0] = $query;
    $query = call_user_func_array("sprintf", $args);
  }
  else {
    $query = func_get_arg(0);
    $query = db_prefix_tables($query);
  }
  $query .= " LIMIT $from, $count";
  return _db_query($query);
}

?>
