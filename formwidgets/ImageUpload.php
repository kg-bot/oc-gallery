<?php namespace Stefan\Gallery\FormWidgets;

use Backend\FormWidgets\FileUpload;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facade\Storage as LStorage;

use Stefan\Gallery\Models\Tag;

/**
 * imageupload Form Widget
 */
class ImageUpload extends FileUpload
{
    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'stefan_gallery_imageupload';

    public function index()
    {
        return 'hello';
    }


    /**
     * @inheritDoc
     */
    public function loadAssets()
    {
        parent::loadAssets();
        $this->addCss('https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.min.css', 'core');
        $this->addCss('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css', 'core');
        $this->addCss('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css', 'core');

        $this->addJs('https://cdnjs.cloudflare.com/ajax/libs/cropper/3.0.0/cropper.min.js', 'core');
        $this->addJs('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', 'core');
        $this->addJs('js/imageupload.js', 'core');
    }

    /**
     * AJAX handler, gets called when we crop image uploaded with fileupload
     * 
     * @return void
     */
    public function onImageCrop()
    {
        $fileModel = $this->getRelationModel();

        $file = $fileModel::find(input('file_id'));

        // create an image manager instance with favored driver
        $manager = new ImageManager(array('driver' => 'gd'));
        $file_path = $file->getPath();

        // to finally create image instances
        $image = $manager->make($file_path)->crop((int) input('width'), (int) input('height'), (int) input('x'), (int) input('y'))->stream();

        \Storage::put($file->getDiskPath(), $image);

        return ['url' => $file_path, 'thumb_url' => $file->thumbUrl];
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

                $response = parent::onSaveAttachmentConfig();

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
}