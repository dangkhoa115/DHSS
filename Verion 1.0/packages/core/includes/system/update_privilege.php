<?php
/******************************
COPY RIGHT BY Catbeloved - Framework
WRITTEN BY catbeloved
******************************/

function make_privilege_cache($cond='1')
{
	DB::query('update `account` set cache_privilege="" where '.$cond);
}
?>