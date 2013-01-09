<?php
function createThumbs( $pathToImages, $pathToThumbs, $thumbSize )
{
  // open the directory
  $dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
    $info = pathinfo($pathToImages . $fname);
    
      $img = "";

	switch( strtolower($info['extension']))
	{
	case "bmp":
		$img = imagecreatefromwbmp( "{$pathToImages}{$fname}" );
		break;
	case "jpg":
		$img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
		break;
	case "jpeg":
		$img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
		break;
	case "png":
		$img = imagecreatefrompng( "{$pathToImages}{$fname}" );
		break;
	case "gif":
		$img = imagecreatefromgif( "{$pathToImages}{$fname}" );
		break;
	case "flv":
		makeJpgForMovie("{$pathToImages}{$fname}","tmp/tmp.jpg","0.02");
		$img = imagecreatefromjpeg( "tmp/tmp.jpg" );
		break;
	case "avi":
		echo "avi";
		makeJpgForMovie("{$pathToImages}{$fname}","tmp/tmp.jpg","0.02");
		$img = imagecreatefromjpeg( "tmp/tmp.jpg" );
		break;
	}


	if ( $img != "")
	{
		$width = imagesx( $img );
		$height = imagesy( $img );

		// calculate thumbnail size
		if($width>$height)
		{
			$new_width = $thumbSize;
			$new_height = floor( $height * ( $thumbSize / $width ) );
		}
		else
		{
			$new_height = $thumbSize;
			$new_width = floor( $width * ( $thumbSize / $height ) );
		}
			
		// create a new temporary image
		$tmp_img = imagecreatetruecolor( $new_width, $new_height );

		// copy and resize old image into new image
		imagecopyresampled( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

		// Izostravanje
		//$sharpenMatrix = array(-1,-1,-1,-1,16,-1,-1,-1,-1);
		$sharpenMatrix[0] = array(-1,-1,-1);
		$sharpenMatrix[1] = array(-1,16,-1);
		$sharpenMatrix[2] = array(-1,-1,-1);
		$divisor = 8;
		$offset = 0;
/*
		imageconvolution($img, $sharpenMatrix, $divisor, $offset);
*/
		// save thumbnail into a file
		imagejpeg( $tmp_img, $pathToThumbs."/".$info['filename'].".jpg", 100);
		
		if(strtolower($info['extension'])=='flv')
		{
			unlink("tmp/tmp.jpg");
		}
	}
  }
  // close the directory
  closedir( $dir );
}

function makeJpgForMovie($input, $output, $fromdurasec="01") 
{
	$ffmpegpath = "/usr/bin/ffmpeg";
	if(!file_exists($input))
	{
		return false;
	}

	$command = "$ffmpegpath -i \"$input\" -an -ss 00:00:$fromdurasec -r 1 -vframes 1 -f mjpeg -y $output";
	
	exec( $command, $ret );
	
	if(!file_exists($output)) return false;
	if(filesize($output)==0) return false;
	return true;
}
?>
