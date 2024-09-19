<?php
// to include user-defined functions to set error handler
require_once ("functions.php");
// to catch and report any types of error
error_reporting(E_ALL);
// not display the errors to the user
ini_set("display_errors", 0);
// log errors into error_log.txt insteads of showing them to user
set_error_handler("customErrorHandler");