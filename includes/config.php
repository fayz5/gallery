<?php
/************************************************
 * This is the configuration file.
 * Contains Database related constants.
 *
 * @author  Akmal Fayziyev
 * @version 1.0, 06/05/2016
 ************************************************/

//Database related constants
defined("DB_SERVER")? NULL : define("DB_SERVER","localhost");
defined("DB_USER")  ? NULL : define("DB_USER","photographer");
defined("DB_PASS")  ? NULL : define("DB_PASS","gallery12345");
defined("DB_NAME")	? NULL : define("DB_NAME","photo_gallery");

//Path related constants
// defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR); // DIRECTORY_SEPARATOR is a PHP pre-defined constant
// defined("SITE_ROOT")  ? NULL : define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT']);

?>
