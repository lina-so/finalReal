<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoraitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoraites', function (Blueprint $table) {
            // $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('is_favoraite');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('real_id')->unsigned();

            $table->primary(['user_id','real_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('real_id')->references('id')->on('realestates')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favoraites');
    }
}
