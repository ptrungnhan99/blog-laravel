<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoColumnToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('seo_title')->nullable();
            $table->string('seo_canonical')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->string('seo_desc')->nullable();
            $table->string('post_type')->nullable();
            $table->string('meta_robot')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'seo_title',
                'seo_canonical',
                'seo_keyword',
                'seo_desc',
                'post_type',
                'meta_robot'
            ]);
        });
    }
}
