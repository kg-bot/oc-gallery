<?php namespace Stefan\Gallery;

use System\Classes\PluginBase;

use System\Models\File;

class Plugin extends PluginBase
{

	public $require = ['Inetis.ListSwitch'];

	public function registerFormWidgets()
	{
		return [
			'Stefan\Gallery\FormWidgets\ImageUpload' => 'stefan_gallery_imageupload',
		];
	}

	public function boot()
	{

		File::extend(function($model) {
			if($model instanceof System\Models\File) {
				
				$model->implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];
				$model->addDynamicProperty('translatable', ['title', 'description']);
			}
		});
	}

	public function registerComponents()
	{
	    return [
	        'Stefan\Gallery\Components\Gallery' => 'stefanGallery'
	    ];
	}
}
