<?php
define('FATHER',1);
define('MOTHER',2);
define('MARRIED',3);
define('ENGAGED',4);
define('RELATIONSHIP',5);
define('SEPARATED',6);
define('DIVORCED',7);
$families = array(
	'0'=>''.Portal::language('select_relation_type').'',
	'1'=>Portal::language('father'),
	'2'=>Portal::language('mother'),
	'3'=>Portal::language('married'),
	'4'=>Portal::language('engaged'), // dinh hon
	'5'=>Portal::language('relationship'),
	'6'=>Portal::language('separated'),// ly than
	'7'=>Portal::language('divorced') // ly di
);
?>