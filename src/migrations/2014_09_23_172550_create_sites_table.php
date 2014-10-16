<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function ($table)
        {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->boolean('is_home');
            $table->integer('lft');
            $table->integer('rgt');
            $table->integer('depth');
            $table->string('type');
            $table->integer('template_id')->unsigned();
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
        Schema::drop('sites');
    }

}
