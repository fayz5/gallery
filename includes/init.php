<?php
/************************************************
 * Initialization is done in here.
 * This module loads all the required files 
 * in the includes folder.
 *
 * @author  Akmal Fayziyev
 * @version 1.0, 06/05/2016
 ************************************************/

//Path related constants
defined("SITE_ROOT")? NULL : define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT']);
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.'/includes');
//defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR); // DIRECTORY_SEPARATOR is a PHP pre-defined constant

//load configuration file
require_once(LIB_PATH.'/config.php');

//load basic functions
require_once(LIB_PATH.'/functions.php');

//load core objects
require_once(LIB_PATH.'/session.php');
require_once(LIB_PATH.'/database.php');
require_once(LIB_PATH.'/database_object.php');

//load database-related classes
require_once(LIB_PATH.'/user.php');
require_once(LIB_PATH.'/photograph.php');

?>