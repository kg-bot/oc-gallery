<?php namespace Stefan\Gallery\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration104 extends Migration
{
    public function up()
    {
        Schema::table('system_files', function($table) {
            $table->json('stefan_gallery_tags')->nullable();
        });
    }

    public function down()
    {
        Schema::table('system_files', function($table) {
            $table->dropColumn('stefan_gallery_tags');
        });
    }
}