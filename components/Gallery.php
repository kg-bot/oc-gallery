<?php namespace Stefan\Gallery\Components;

use Cms\Classes\ComponentBase;
use Stefan\Gallery\Models\Gallery as GalleryModel;

class Gallery extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Gallery Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [

            'gallery' => [
                'title' => 'Available Galleries',
                'description' => 'Select Gallery that you want to show',
                'required' => true,
                'validationMessage' => 'You must select gallery',
                'placeholder' => '-- Select Gallery --',
                'type' => 'dropdown',
            ],
            'theme' => [
                'title' => 'Theme',
                'description' => 'Select Theme',
                'type' => 'dropdown',
                'default' => 'fluid',
                'placeholder' => '-- Select Theme --',
                'options' => ['thumbnail' => 'Thumbnail', 'clean' => 'Clean', 'grid' => 'Grid', 'fluid' => 'Fluid'],
            ],
        ];
    }

    public function onRun()
    {
        $gallery = GalleryModel::find($this->property('gallery'));

        $this->page['galleryName'] = $gallery->title;
        $this->page['galleryDescription'] = $gallery->description;

        $this->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
        $this->addCss('https://fonts.googleapis.com/css?family=Droid+Sans:400,700');
        $this->addCss('https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css');

        $this->addJs('https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js');
        $this->addJs('assets/js/gallery.js');
        
        $theme = $this->property('theme');

        switch($theme) {

            case 'clean':

                $this->addCss('assets/css/gallery-clean.css');
                break;
            case 'grid':
            
                $this->addCss('assets/css/gallery-grid.css');
                break;
            case 'thumbnail':

                $this->addCss('assets/css/thumbnail-gallery.css');
                break;
            default:

                $this->addCss('assets/css/fluid-gallery.css');
                break;
        }
    }

    public function getGalleryOptions()
    {
        $galleries = GalleryModel::Published()->get();

        if(count($galleries)) {

            foreach($galleries as $gallery) {

                $options[$gallery->id] = $gallery->title;
            }
        }

        return isset($options) ? $options: [];
    }

    public function images()
    {
        $gallery = GalleryModel::with('images')->find($this->property('gallery'));

        return $gallery->images;
    }
}
