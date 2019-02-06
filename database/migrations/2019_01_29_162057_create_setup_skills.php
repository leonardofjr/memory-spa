<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetupSkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setup_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('skills_and_offer');
            $table->string('html');
            $table->string('css');
            $table->string('javascript');
            $table->string('bootstrap');
            $table->string('angular');
            $table->string('vuejs');
            $table->string('php');
            $table->string('laravel');
            $table->string('expressjs');
            $table->string('git');
            $table->string('windows');
            $table->string('mac');
            $table->string('linux');
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
        Schema::dropIfExists('setup_skills');
    }
}
