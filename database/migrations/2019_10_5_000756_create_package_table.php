<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('price');
            $table->longText('description');
            $table->string('capacity');
            $table->timestamps();
        });

        DB::table('packages')->insert(
            array(
                'name'=>'Silver Plan', 
                'price'=>5000,
                'description'=> 'This is the silver plan',
                'capacity' => '200 MB'
            ));
        DB::table('packages')->insert(
            array(
                'name'=>'Gold Plan', 
                'price'=>10000,
                'description'=> 'This is the gold plan',
                'capacity' => '500 MB'
            ));
        DB::table('packages')->insert(
            array(
                'name'=>'Platinum Plan', 
                'price'=>15000,
                'description'=> 'This is the platinum plan',
                'capacity' => '1 GB'
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
