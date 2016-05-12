<?php 
/******************************
COPY RIGHT BY Catbeloved - Framework
WRITTEN BY ducnm
******************************/
class Upload extends Module
{
	function Upload($row)
	{
		Module::Module($row);
		
		if (!empty($_FILES)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
			$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
			move_uploaded_file($tempFile,$targetFile);
			echo "1";
			exit();
		}
		
		require_once 'db.php';
		require_once 'forms/list.php';
		$this->add_form(new UploadForm());		
	}
}
?>