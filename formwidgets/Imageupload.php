<?php namespace Stefan\Gallery\FormWidgets;

use Backend\Classes\FormWidgetBase;

/**
 * imageupload Form Widget
 */
class Imageupload extends FormWidgetBase
{
    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'stefan_gallery_imageupload';

    /**
     * @inheritDoc
     */
    public function init()
    {
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('imageupload');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
    }

    /**
     * @inheritDoc
     */
    public function loadAssets()
    {
        $this->addCss('css/imageupload.css', 'Stefan.Gallery');
        $this->addJs('js/imageupload.js', 'Stefan.Gallery');
    }

    /**
     * @inheritDoc
     */
    public function getSaveValue($value)
    {
        return $value;
    }
}
