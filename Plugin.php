<?php namespace Stefan\Gallery;

use System\Classes\PluginBase;

use October\Rain\Database\Attach\File;

class Plugin extends PluginBase
{

	public function registerFormWidgets()
	{
		return [
			'Stefan\Gallery\FormWidgets\ImageUpload' => 'stefan_gallery_imageupload',
		];
	}
}
