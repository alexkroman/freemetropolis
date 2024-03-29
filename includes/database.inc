<?php
// $Id: database.inc,v 1.1.1.1 2004/07/24 19:09:42 alex Exp $

function db_prefix_tables($sql) {
  global $db_prefix;

  if (is_array($db_prefix)) {
    $prefix = $db_prefix["default"];
    foreach ($db_prefix as $key => $val) {
      if ($key !== "default") {
        $sql = strtr($sql, array("{". $key. "}" => $val. $key));
      }
    }
  }
  else {
    $prefix = $db_prefix;
  }
  return strtr($sql, array("{" => $prefix, "}" => ""));
}

$db_type = substr($db_url, 0, strpos($db_url, "://"));

if ($db_type == "mysql") {
  include_once "includes/database.mysql.inc";
}
else {
  include_once "includes/database.pear.inc";
}

db_connect($db_url);


?>
