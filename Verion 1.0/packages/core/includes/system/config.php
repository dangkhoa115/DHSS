<?php
//session_start(); 
//define ('DEBUG',0); // huan sua 28/8 da exists trong library.php
//config header
define('DEBUG',1);
define('START_YEAR',2015);
define('PREFIX','');
define('MUA_GIAI_ID',2);//2015-2016
define('MUA_GIAI','2015 - 2016');//2015-2016
header("Content-Type: text/html; charset=utf-8");
ini_set ('zend.ze1_compatibility_mode','off');
// include kernel 
require_once ROOT_PATH.'cache/modules.php';
require_once ROOT_PATH.'packages/core/includes/system/default_session.php';
require_once ROOT_PATH.'packages/core/includes/system/database.php';
require_once ROOT_PATH.'packages/core/includes/system/system.php';
require_once ROOT_PATH.'packages/core/includes/system/url.php';
require_once ROOT_PATH.'packages/core/includes/system/id_structure.php';
require_once ROOT_PATH.'packages/core/includes/portal/types.php';
require_once ROOT_PATH.'packages/core/includes/portal/form.php';
require_once ROOT_PATH.'packages/core/includes/system/user.php';
require_once ROOT_PATH.'packages/core/includes/portal/module.php';
require_once ROOT_PATH.'packages/core/includes/portal/portal.php';
require_once ROOT_PATH.'packages/core/includes/system/visitor.php';
require_once ROOT_PATH.'packages/core/includes/system/log.php';
//error report
error_reporting(E_ALL);
// Disable ALL magic_quote
ini_set('magic_quotes_runtime', 0);

if (get_magic_quotes_gpc())
{
	function stripslashes_deep($value)
	{
		$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
		return $value;
	}
	$_REQUEST = array_map('stripslashes_deep', $_REQUEST);
	$_COOKIE = array_map('stripslashes_deep', $_COOKIE);
}
?>