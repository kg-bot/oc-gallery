<?php namespace Stefan\Gallery;

use System\Classes\PluginBase;

use System\Models\File;

class Plugin extends PluginBase
{

	public function registerFormWidgets()
	{
		return [
			'Stefan\Gallery\FormWidgets\ImageUpload' => 'stefan_gallery_imageupload',
		];
	}
}
