<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagicTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magic_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ref_id')->unsigned();
            $table->string('magic_id', 32);
            $table->string('type', 10);
            $table->string('name');
            $table->longtext('description');
            $table->integer('position')->unsigned();
            $table->timestamps();
        });

        Schema::create('magic_listings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('magic_id', 32);
            $table->string('name');
            $table->longtext('description');
            $table->timestamps();
        });

        Schema::create('magic_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('magic_id', 32);
            $table->string('name');
            $table->longtext('description');
            $table->timestamps();
        });

        Schema::create('magic_tags_rel', function (Blueprint $table) {
            $table->integer('tag_id');
            $table->integer('taggable_id');
            $table->string('taggable_type');

            //
            $table->primary(['tag_id', 'taggable_id', 'taggable_type']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('magic_images');
        Schema::drop('magic_listings');
        Schema::drop('magic_tags');
        Schema::drop('magic_tags_rel');
    }
}
