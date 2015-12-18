<?php

namespace app\classes;
						/********* Для статических методов *********/
class Funct {
	
	/********* Ресайз картинки *********/

	static function imgresize($photo_src, $width, $name)
	{
		$parametr = getimagesize($photo_src);
		list($width_orig, $height_orig) = getimagesize($photo_src);
		$ratio_orig = $width_orig/$height_orig;
		$new_width = $width;
		$new_height = $width / $ratio_orig;
		$newpic = imagecreatetruecolor($new_width, $new_height);
		
		imageAlphaBlending($newpic, false);
		imageSaveAlpha($newpic, true);
		
		
		switch ( $parametr[2] )
		{
			case 1: $image = imagecreatefromgif($photo_src);
			break;
			case 2: $image = imagecreatefromjpeg($photo_src);
			break;
			case 3: $image = imagecreatefrompng($photo_src);
			break;
		}

		imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
		imagepng($newpic, $name);
		return true;
	}
}
