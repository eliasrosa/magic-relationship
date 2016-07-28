<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagicGaleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magic_galery', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ref_id')->unsigned();
            $table->string('ref_type');
            $table->string('file_type');
            $table->string('name');
            $table->longtext('description');
            $table->integer('position')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('magic_galery');
    }
}
