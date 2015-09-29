<?php

// *===================================================================*
// | MY UPLOADER v 0.01 BETA!!                                         |
// | EASY AND SIMPLE !!                                                |
// |                                                                   |
// *-------------------------------------------------------------------*
// | Authur : Phongthorn Kumkankaew                                    |
// | Copy Right : 2011 Phongthorn Kumkankaew                           |
// | Date : 16/09/2011                                                 |
// *-------------------------------------------------------------------*
// |                                                                   |
// | - This version can use for single upload file only                |
// |                                                                   |
// *===================================================================*

class uploader{
	
	/// DECLARE VARIABLES ///
	public $file_tmpname;
	public $file_type;
	public $file_size;
	public $file_path;
	public $file_type_check;
	public $check_resize;
		
	/// INITIAL ALL FUNCTION ///
	public function init(){
				
		$this->file_tmpname = '';
		$this->file_type = '';
		$this->file_size = '';
		
		$this->file_path = '';	
		$this->file_check = false;	
		$this->check_resize = false;
	}
	/// GET ALL VALUES ///
	public function get_fileName(){
		
		$this->file_name = $_FILES['file']['name'];
	}
	public function get_filetmpName(){
	
		$this->file_tmpname = $_FILES['file']['tmp_name'];
	}
	public function get_fileType(){
		
		$this->file_type = $_FILES['file']['type'];
		$this->file_type_check = $this->check_fileType();
	}
	public function get_fileSize(){
		
		$this->file_size = $_FILES['file']['size'];
	}
	public function get_filePath($path){
		
		$this->file_path = $path;
	}
	public function check_fileType(){
		
		if(($this->file_type == 'image/jpeg')){
			
			return true;
		}else if(($this->file_type == 'application/msword')){
		
			return false;
		}
	}
	/// USE THIS METHOD WHEN YOU WANT TO KNOW FILE INFO ///
	public function fileInfo(){
		
		$info1 = 'FILE NAME = '.$this->file_name.' ('.$this->file_tmpname.')<br />';
		$info2 = 'FILE TYPE = '.$this->file_type.'<br />';
		$info3 = 'FILE SIZE = '.$this->file_size.' btyes <br />';
		$info4 = 'FILE PATH = '.$this->file_path;
		
		echo $info1.$info2.$info3.$info4;
	}
	
	/// UPLOAD ///
	public function load($file){
		
		$this->init();
		$this->file_tmpname = $file;
		$this->get_fileType();
				
	}
	
	/// ALL PROCESS ///
	public function process(){
		
		///Check File Type ///
		if($this->file_check){
		
			echo 'AAA';
		}else{
			
			echo 'BBB';
		}
		
		///Resize function ///
		if($this->check_resize){
			echo 'Resized!!!';
		}
	}
	
	/// SAVE ///
	public function save(){
		
		
	}
	public function clean(){
	
	}
	
}
?>
