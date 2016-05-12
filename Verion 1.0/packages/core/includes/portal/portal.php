<?php
/******************************
COPY RIGHT BY CATBELOVED
******************************/
class Portal{
	static $current = false;
	static $extra_header = '';
	static $page_gen_time = 0;
	static $page = false;
	static $meta_keywords = '';
	static $meta_description = '';
	static $document_title = '';
	static $canonical = '';
	static $image_url = '';
	function Portal(){
	}
	static function register_module($row_or_id, &$module){
		if(is_numeric($row_or_id)){
			$id=$row_or_id;
		}
		else
		if(isset($row_or_id['id'])){
			$id = $row_or_id['id'];
		}
		else{
			System::halt();
		}
		if(is_numeric($row_or_id)){
			DB::query('
				select
					id, name, package_id
				from
					module
				where
					id = '.$row_or_id);
			$row = DB::fetch();
			if(!$row){
				System::halt();
			}
		}
		else{
			$row = $row_or_id;
		}
		require_once 'packages/core/includes/portal/package.php';
		$class_fn = get_package_path($row['package_id']).'module_'.$row['name'].'/class.php';
		require_once $class_fn;
		$module = new $row['name']($row);
		$module->package = &$GLOBALS['packages'][$row['package_id']];
	}
	//Chay portal
	static function run(){
		if(!Session::is_set('portal')){
			$portal = DB::fetch('select id from account where type="PORTAL" and is_active = 1 and id = "#'.addslashes($_REQUEST['portal']).'"');
			Session::set('portal',$portal);
		}
		if(Session::is_set('portal') and Session::get('portal')){
			$cache_setting = true;
			if(Session::get('portal','cache_setting')){
				eval('$cache_setting='.Session::get('portal','cache_setting'));
				if(empty($cache_setting)){
					$cache_setting = false;
				}
			}else{
				$cache_setting = false;
			}
			if($cache_setting==false){
				require_once 'packages/core/includes/system/make_account_setting_cache.php';
				make_account_setting_cache(Session::get('portal','id'));
				Session::set('portal', DB::select('account','id="'.Session::get('portal','id').'"'));				
			}					
			eval('Portal::$current->settings='.Session::get('portal','cache_setting'));
			define('PORTAL_ID',Session::get('portal','id'));
			define('REWRITE',1);//Portal::get_setting('rewrite')
			define('USE_CACHE',Portal::get_setting('use_cache'));
			// ------- add check language : ngocnv - 30/07/2009 ---------------
			if(!Session::is_set('language_changed')){
				Session::set('language_id',Portal::get_setting('language_default'));			
			}			
			if(Portal::get_setting('is_active') or User::can_admin(MODULE_NEWSADMIN,ANY_CATEGORY) or (Url::sget('page')=='dang-nhap')){
				
				if(Url::sget('page') and $page = DB::fetch('select * from page where name="'.addslashes(Url::sget('page')).'"')){
					Portal::run_page($page,$page['name'],$page['params']);
				}
				else{
					if($_SERVER['HTTP_HOST']=='lmanshop.local'){
						if($page = DB::fetch('select * from page where name="home1"')){
							Portal::run_page($page,$page['name'],$page['params']);
						}
					}elseif($_SERVER['HTTP_HOST']=='doihinhsieusao.com'){
						if($page = DB::fetch('select * from page where name="starteam"')){
							Portal::run_page($page,$page['name'],$page['params']);
						}
					}else{
						if($page = DB::fetch('select * from page where name="landing-page"')){
							Portal::run_page($page,$page['name'],$page['params']);
						}
					}
				}
			}
			else{
				echo Portal::get_setting('notification_when_interrption');
			}	
		}	
		Session::end();
		DB::close();
	}
	static function run_page($row, $page_name, $params=false){
		//Counter::check_session();
		$postfix = $params?'.'.$params:'';
		$page_file = ROOT_PATH.'cache/pages/'.$page_name.$postfix.'.cache.php';
		if(file_exists($page_file) and USE_CACHE){
			require_once $page_file;								
		}
		else{
			require_once 'packages/core/includes/portal/generate_page.php';
			$generate_page = new GeneratePage($row);
			$generate_page->generate();
			$page_name=$row['name'];
		}
	}
	static function template($portal = true){
		if($portal){
			return 'skins/'.substr(PORTAL_ID,1).'/';
		}
		return 	'skins/default/';
	}
	static function tpl($name){//ham ten ngan gon lay template
		if($name){
			return 'skins/'.$name.'/';
		}else{
			return 	'skins/default/';
		}
	}
	static function template_css($portal = 'default'){
		return 'skins/'.$portal.'/';
	}
	static function template_js($package= 'core'){
		return 'packages/'.$package.'/includes/js/';
	}
	static function service($service_name){
		$services = Portal::get_setting('registered_services');
		return isset($services[$service_name]);
	}
	static function language($name=false){
		if($name){
			if(isset($GLOBALS['all_words']['[[.'.$name.'.]]'])){
				return $GLOBALS['all_words']['[[.'.$name.'.]]'];
			}
			else{
				$languages = DB::select_all('language');
				$row = array();
				foreach($languages as $language){
					$row['value_'.$language['id']] = ucfirst(str_replace('_',' ',$name));
				}
				DB::insert('word',$row + array(
					'id'=>$name,
					'package_id'=>Module::$current->data['module']['package_id']
				),1);
				Portal::make_word_cache();
				return $name;
			}
		}
		if(Session::is_set('language_id') and Session::get('language_id')!=''){
			return Session::get('language_id');
		}
		return 1;
	}
	static function get_setting($name, $default=false, $user_id = false){
		if(!$user_id){			
			if(isset(User::$current->settings[$name])){
				if(User::$current->settings[$name] == '@VERY_LARGE_INFORMATION'){
					if($setting = DB::select('account_setting','setting_id="'.DB::escape($name).'" and account_id="'.User::id().'"')){
						return $setting['value'];
					}
				}
				else{					
					return User::$current->settings[$name];
				}
			}elseif(isset(Portal::$current->settings[$name])){	
				if(Portal::$current->settings[$name] == '@VERY_LARGE_INFORMATION'){
					if($setting = DB::select('account_setting','setting_id="'.DB::escape($name).'" and account_id="'.PORTAL_ID.'"')){
						return $setting['value'];
					}
				}else{
					return Portal::$current->settings[$name];
				}
			}			
		}else{
			if($setting = DB::select('account_setting','setting_id="'.DB::escape($name).'" and account_id="'.DB::escape($user_id).'"')){
				return $setting['value'];
			}
			return $default;
		}		
		return $default;
	}
	static function use_service($name){
		return isset(Portal::$current->services[$name]);
	}
	static function set_setting($name, $value,$user_id=false,$account_type = 'USER'){
		if($setting = DB::select('setting','id="'.$name.'"')){
			if($user_id==false){
				if($setting['account_type']=='USER'){
					$account_id = Session::get('user_id');
				}
				else{
					$account_id = Session::get('portal','id');
				}
			}
			else{
				$account_id = $user_id;
			}
			if(DB::select('account_setting','account_id="'.addslashes($account_id).'" and setting_id="'.addslashes($name).'"')){
				DB::update('account_setting',
					array(
						'value'=>$value
					),
					'account_id="'.addslashes($account_id).'" and setting_id="'.addslashes($name).'"'
				);
			}
			else{
				DB::insert('account_setting',
					array(
						'account_id'=>$account_id,
						'setting_id'=>$name,
						'value'=>$value
					)
				);
			}
			DB::update('account',array('cache_setting'=>''),'id="'.$account_id.'"');
			if($setting['account_type']=='PORTAL' and $account_id==PORTAL_ID){				
				if(isset($_REQUEST['portal']) and $portal=DB::select_id('account','#'.addslashes($_REQUEST['portal']))){
					Session::set('portal', $portal);
				}
				else{
					Session::set('portal', DB::select_id('account','#default'));
				}
			}
		}
		else{
			DB::insert('setting',array('id'=>$name,'default_value'=>$value,'type'=>'TEXT','account_type'=>$account_type));
			if($user_id==false){
				$user_id = Session::get('portal','id');				
			}
			DB::insert('account_setting',array('setting_id'=>$name,'value'=>$value,'account_id'=>$user_id));
		}
	}
	static function make_word_cache(){
		$languages = DB::select_all('language');
		foreach($languages as $language_id=>$row){
			$all_words = DB::fetch_all('
					SELECT 
						id, value_'.$language_id.' as value 
					FROM
						word 
				');
			$language_convert = array();
			foreach($all_words as $language){
				$language_convert = $language_convert + 
					array('[[.'.$language['id'].'.]]'=>$language['value']);
			}
			if($language_id==Portal::language()){
				$GLOBALS['all_words'] = $language_convert;
			}
			$st = '<?php
if(!isset($GLOBALS[\'all_words\'])){
	$GLOBALS[\'all_words\'] = '.var_export($language_convert,1).';
}
?>';
			$f = fopen('cache/language_'.$language_id.'.php','w+');
			fwrite($f,$st);
			fclose($f);
			$st = 'TCV.Portal.words = '.String::array2js($language_convert).';';
			$f = fopen('cache/language_'.$language_id.'.js','w+');
			fwrite($f,$st);
			fclose($f);
		}
	}
}
Portal::$page_gen_time = new Timer();
Portal::$page_gen_time->start_timer();
require_once ROOT_PATH.'cache/language_'.Portal::language().'.php';
Portal::$current = new Portal();
?>