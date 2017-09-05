<?php namespace Stefan\Gallery\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateStefanGalleryTags extends Migration
{
    public function up()
    {
        Schema::create('stefan_gallery_tags', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('title')->index();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('stefan_gallery_tags');
    }
}
