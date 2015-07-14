<?php namespace Services;


class Image {

	public $errors = array();

	public $path;

	public function __construct() {

	}

	public function upload($file, $directory)
	{
		$filename = $file->getClientOriginalName();
		$path = \Config::get('image.upload_path').$directory."/";
		$url = "/uploads/".$directory."/".$filename;
		$dest_file = $path.$filename;
		$ext = strtolower($file->getClientOriginalExtension());

		$dimensions = \Config::get('image.dimensions');

		$file->move($path, $filename);
		$paths = array();
		$paths['orignal'] = $url;
				foreach ($dimensions as $key => $dimension)
    {
      // Get dimmensions and quality
      $width   = (int) $dimension[0];
      $height  = (int) $dimension[1];
      $crop    = (bool) $dimension[2];

      // Run resizer
      $image = \Image::make($dest_file);

      if($crop) {
      	$image = $image->grab($width, $height);
      }
      else {
      	$image = $image->resize($width, $height, true, false);
      }
      $paths[$key] = "/uploads/".$directory."/".basename($filename, '.'.$ext).$width.'x'.$height.'.'.$ext;
      $image->save($path.basename($filename, '.'.$ext).$width.'x'.$height.'.'.$ext);
    }
    $this->path = json_encode($paths);
	}
}