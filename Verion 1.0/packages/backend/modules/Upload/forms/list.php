<?php
class UploadForm extends Form{
	function UploadForm(){
		Form::Form('UploadForm');
		$this->link_css('skins/default/css/cms.css');
		$this->link_js('packages/backend/includes/multi_upload/jquery.uploadify.v2.1.0.min.js');
		$this->link_css('packages/core/includes/js/jquery/multifile_upload/jquery.fileupload-ui.css');
	}		
	function on_submit(){
	}	
	function draw(){
		$this->parse_layout('list');
	}
}
?>