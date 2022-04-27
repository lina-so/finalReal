<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address');
            $table->integer('floor');
            $table->integer('area')->nullable();
            $table->double('price')->nullable();
            $table->integer('number_of_rooms')->nullable();;
            $table->integer('number_of_path_rooms')->nullable();
            $table->boolean('is_sales')->default(0);
            $table->boolean('is_rent')->default(0);
            $table->boolean('is_favoraite')->default(0);
            $table->enum('state' , ["sale" , "rent" ])->default('sale');
            $table->enum('type' , ["tabo" , "court" ])->default('tabo');
            $table->enum('property_type', ["villa" , "flat","land","shop" ])->default('flat');
            $table->string('long')->nullable();
            $table->string('lat')->nullable();
    
            $table->timestamps();


            $table->bigInteger('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


            $table->bigInteger('cities_id')->unsigned();

            $table->foreign('cities_id')->references('id')->on('cities')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desires');
    }
}
