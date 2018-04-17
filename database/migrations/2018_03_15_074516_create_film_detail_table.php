<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('film_id');
            $table->string('name');
            $table->text('source1')->nullable();
            $table->text('source2')->nullable();
            $table->text('source3')->nullable();
            $table->text('source_vip1')->nullable();
            $table->text('source_vip2')->nullable();
            $table->text('source_vip3')->nullable();
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
        Schema::dropIfExists('film_detail');
    }
}
