<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('portfolio_entry_id')->unsigned();
            $table->foreign('portfolio_entry_id')->references('id')->on('portfolio');
            $table->string('filename_1')->nullable();
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
        Schema::drop('portfolio_photos');
    }
}
