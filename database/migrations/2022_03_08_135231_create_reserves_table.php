<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            // $table->id();
            // $table->integer('period');
            $table->boolean('is_reserve')->default(0);
            $table->timestamps();
            $table->softDeletes();


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
        Schema::dropIfExists('reserves');
    }
}
