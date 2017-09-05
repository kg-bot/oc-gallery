<?php namespace Stefan\Gallery\Models;

use Model;

/**
 * Model
 */
class Gallery extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'slug',
    ];

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required|string',
        'description' => 'required|string',
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:stefan_gallery_galleries'],
    ];

    public $translatable = [
        'title',
        'description',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'stefan_gallery_galleries';

    public $attachMany = [
        'images' => ['Stefan\Gallery\Models\Image', 'order' => 'sort_order'],
    ];
}