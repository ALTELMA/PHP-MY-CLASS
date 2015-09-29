<?php

// NAME : resize_image.php

class ResizeImage{

	/// Decalre Variable ///
	public $image;
	public $image_type;
	public $image_size;

	/// Load resource image ///
	public function load($filename){
		$image_info = getimagesize($filename);
		$this->image_type = $image_info[2];
		if($this->image_type == IMAGETYPE_JPEG){
			$this->image = imagecreatefromjpeg($filename);
		} elseif($this->image_type == IMAGETYPE_PNG){
			$this->image = imagecreatefrompng($filename);
		} elseif($this->image_type == IMAGETYPE_GIF){
			$this->image = imagecreatefromgif($filename);
		}
	}

	/// GET Width and Height ///
	private function getWidth(){
		return imagesx($this->image);
	}
	private function getHeight(){
		return imagesy($this->image);
	}

	/// All metheod to resize image ///
	public function resize($width,$height){
		$new_image = imagecreatetruecolor($width,$height);

		/// For image type is PNG and GIF, then set if transparent ///
		imagealphablending($new_image, false);
 		imagesavealpha($new_image,true);
 		$transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
 		imagefilledrectangle($new_image, 0, 0, $width, $height, $transparent);

		/// Resizing image ///
		imagecopyresized($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		$this->image = $new_image;
	}
	public function resize2Height($height){
		$ratio = $height / $this->getHeight();
		$width = $this->getWidth() * $ratio;
		$this->resize($width, $height);
	}
	public function resize2Width($width){
		$ratio = $width / $this->getWidth();
		$height = $this->getHeight() * $ratio;
		$this->resize($width, $height);
	}
	public function scale($scale){
		$width = $this->getHeight() * 100/$scale;
		$height = $this->getWidth() * 100/$scale;
		$this->resize($width, $height);
	}

	/// Rename image before saving ///
	public function renameImage($str){
		$image_date = date('Ymd');
		$random_digit = rand(000000,999999);

		if($this->image_type == IMAGETYPE_JPEG){

			$rename_image = $image_date.$random_digit.$str.'.jpg';
		} elseif($this->image_type == IMAGETYPE_PNG){

			$rename_image = $image_date.$random_digit.$str.'.png';
		} elseif($this->image_type == IMAGETYPE_GIF){

			$rename_image = $image_date.$random_digit.$str.'.gif';
		}

		return $rename_image;
	}

	/// Save image ///
	public function save($filename, $compression = 75, $permission = null){
		if($this->image_type == IMAGETYPE_JPEG){

			imagejpeg($this->image, $filename, $compression);
		} elseif($this->image_type == IMAGETYPE_PNG){

			imagepng($this->image, $filename);
		} elseif($this->image_type == IMAGETYPE_GIF){

			imagegif($this->image, $filename);
		}
	}

	/// Show output image ///
	public function output(){
		if($this->image_type == IMAGETYPE_JPEG){

			imagejpeg($this->image);
		} elseif($this->image_type == IMAGETYPE_PNG){

			imagepng($this->image);
		} elseif($this->image_type == IMAGETYPE_GIF){

			imagegif($this->image);
		}
	}
}
?>
