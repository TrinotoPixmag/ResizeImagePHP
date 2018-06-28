//if u using CI you can set parameter $size = h123-w234
//and $image as name of your file
// ./assets/newassets/ is your photo location

public function convertimage($size, $image){
	$newsize = explode("-",$size);
	$h = str_replace('h','',$newsize[0]);
	$w = str_replace('w','',$newsize[1]);
	$path = './assets/newassets/'.$image;
	if(file_exists($path)){
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		
		list($width, $height) = getimagesize($path);
		$r = $width / $height;
		
		if ($w/$h > $r) {
			$newwidth = $h*$r;
			$newheight = $h;
		} else {
			$newheight = $w/$r;
			$newwidth = $w;
		}
		
		
		if (strtolower($ext) == 'png') {
			$images = imagecreatefrompng($path);
			$thumbImage = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresampled($thumbImage, $images, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagedestroy($images);
			
			header('Content-Type: image/png');  
			imagepng($thumbImage); 
			imagedestroy($thumbImage);
			exit;  
		} 
		else
		{
			$images = imagecreatefromjpeg($path);
			$thumbImage = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresampled($thumbImage, $images, 0, 0, 0, 0,$newwidth, $newheight, $width, $height);
			imagedestroy($images);
			
			header('Content-Type: image/jpeg');  
			imagejpeg($thumbImage); 
			imagedestroy($thumbImage);
			exit;
		}
	}
}