<?php namespace Stefan\Gallery\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateStefanGalleryGalleries extends Migration
{
    public function up()
    {
        Schema::table('stefan_gallery_galleries', function($table)
        {
            $table->integer('sort_order')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('stefan_gallery_galleries', function($table)
        {
            $table->dropColumn('sort_order');
        });
    }
}
