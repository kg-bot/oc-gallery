<?php namespace Stefan\Gallery\FormWidgets;

use Backend\FormWidgets\FileUpload;
use Illuminate\Support\Facade\Storage as LStorage;

use Stefan\Gallery\Models\Tag;
use October\Rain\Database\Attach\Resizer;

/**
 * imageupload Form Widget
 */
class ImageUpload extends FileUpload
{
    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'stefan_gallery_imageupload';


    /**
     * @inheritDoc
     */
    public function loadAssets()
    {
        parent::loadAssets();
        $this->addCss('https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.min.css', 'core');
        $this->addCss('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css', 'core');

        $this->addJs('https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.min.js', 'core');
        $this->addJs('js/imageupload.js', 'core');
    }

    /**
     * AJAX handler, gets called when we crop image uploaded with fileupload
     * 
     * @return void
     */
    public function on_ImageCrop($width = null, $height = null, $x = null, $y = null, $file_id)
    {
        if($width && $height && $x && $y) {
            
            $fileModel = $this->getRelationModel();

            $file = $fileModel::find($file_id);

            $file_on_disk= $file->getDiskPath();
            
            // to finally create image instances
            \Session::flash('image-resize', Resizer::open('storage/app/' . $file_on_disk)->crop((int) $x, (int) $y, (int) $width, (int) $height)->save('storage/app/' . $file_on_disk, 100));

            //Delete old thumbs
            $file->deleteThumbs();
            // Generate new thumb from cropped image
            return $file->getThumb($width, $height);
        }
    }

    /**
     * @inheritDoc
     * Also allows tags to be added
     */
    public function onLoadAttachmentConfig()
    {
        $fileModel = $this->getRelationModel();
        if (($fileId = post('file_id')) && ($file = $fileModel::find($fileId))) {

            $this->vars['available_tags'] = json_encode($this->getAvailableTags());
        }

        $partial = parent::onLoadAttachmentConfig();
        return $partial;
    }

    /**
     * @inheritDoc
     * Used to extend file with tags
     */
    public function onSaveAttachmentConfig()
    {
        try {
            $fileModel = $this->getRelationModel();
            if (($fileId = post('file_id')) && ($file = $fileModel::find($fileId))) {
                $file->tags = post('tags');
                $file->save();

                // Save every new tag into database for later reuse
                $this->saveNewTags(post('tags'));

                // Crop image

                parent::onSaveAttachmentConfig();
                $response['file_id'] = $file->id;
                $response['new_thumb'] = $this->on_ImageCrop(input('crop-width'), input('crop-height'), input('crop-x'), input('crop-y'), post('file_id'));

                return $response;
            }

            throw new ApplicationException('Unable to find file, it may no longer exist');
        }
        catch (Exception $ex) {
            return json_encode(['error' => $ex->getMessage()]);
        }
    }

    protected function getAvailableTags()
    {
        $tagsCollection = Tag::all();

        $tags = [];

        if(count($tagsCollection)) {
            foreach ($tagsCollection as $tag) {
                $tags[] = ['id' => $tag->title, 'text' => $tag->title];
            }
        }

        return $tags;
    }

    /**
     * When user enters a new tag it should be saved to datbaase for later usage
     * @param  array  $tags Tags to insert into database
     * @return void
     */
    protected function saveNewTags($tags = [])
    {
        if(count($tags)) {
            foreach($tags as $tag) {

                Tag::firstOrCreate(['title' => $tag]);
            }
        }
    }
}