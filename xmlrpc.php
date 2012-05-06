<?php
// $Id: xmlrpc.php,v 1.1.1.1 2004/07/24 19:09:39 alex Exp $

include_once "includes/bootstrap.inc";
include_once "includes/common.inc";
include_once "includes/xmlrpcs.inc";

$functions = module_invoke_all("xmlrpc");

$server = new xmlrpc_server($functions);

?>
