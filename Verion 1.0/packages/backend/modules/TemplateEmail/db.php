<?php
class TemplateEmailDB
{
	function get_folder($dir,&$folders,$i)
	{
		if(is_dir($dir))
		{
			$folders[$dir] = $dir;
			$folder = $dir;
			if($handle = opendir($dir)){
				while ($file = readdir($handle)){
					if($file!="." and $file!="..")
					{
						if(is_dir($dir.'/'.$file))
						{
							$i++;
							$folders[$dir.'/'.$file] = $dir.'/'.$file;
							TemplateEmailDB::get_folder($dir.'/'.$file,$files,$i);
						}
					}
				}
				closedir($handle);
			}
			return $folders;
		}
		else
		{
			return false;
		}		
	}
	function read_file($file)
	{
		if(file_exists($file))
		{
			if(filesize($file))
			{
				$file_size = filesize($file);
			}
			else
			{
				$file_size = 1;
			}
			$fh = fopen($file, 'rw');
			$content = fread($fh,$file_size);
			fclose($fh);
			return $content;
		}
		else
		{
			return false;
		}
	}
	function save_file($file_name,$content)
	{
		$fh = fopen($file_name, 'w') or die("can't open file");
		fwrite($fh, $content);
		fclose($fh);
	}
	function delete_file($file_name)
	{
		if(file_exists($file_name))
		{
			@unlink($file_name);
		}
	}
}
?>
