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

	public function boot()
	{
		File::extend(function($model) {
			$model->implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];
			$model->addDynamicProperty('translatable', ['title', 'description']);
		});
	}
}
