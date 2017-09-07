<?php namespace Stefan\Gallery\Models;

use Model;
use Stefan\Gallery\Models\Tag;

use System\Models\File;

/**
 * Model
 */
class Image extends File
{

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = [
        'description',
        'title',
    ];

    protected $jsonable = ['tags'];
}