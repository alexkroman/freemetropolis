<?php
// $Id: index.php,v 1.1.1.1 2004/07/24 19:09:38 alex Exp $

include_once "includes/bootstrap.inc";
drupal_page_header();
include_once "includes/common.inc";

fix_gpc_magic();

menu_build("system");

if (menu_active_handler_exists()) {
  menu_execute_active_handler();
}
else {
  drupal_not_found();
}

drupal_page_footer();
echo $queries;
$filename = '/Users/alex/Sites/freemet/slow-queries.log';
if (is_writable($filename)) {
	$handle = fopen($filename, 'a+');
	fwrite($handle, $queries);
	fclose($handle);
}
?>
