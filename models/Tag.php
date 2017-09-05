<?php namespace Stefan\Gallery\Models;

use Model;

/**
 * Model
 */
class Tag extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    protected $dates = ['deleted_at', 'created_at,', 'updated_at'];

    public $translatable = [
        'title',
    ];

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required|string',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'stefan_gallery_tags';
}