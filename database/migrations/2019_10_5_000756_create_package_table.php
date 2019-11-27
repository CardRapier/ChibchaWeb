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
            $table->string('image');
            $table->timestamps();
        });

        DB::table('packages')->insert(
            array(
                'name'=>'Silver Plan', 
                'price'=>15,
                'description'=> 'This is the silver plan',
                'capacity' => '200 MB',
                'image' => 'https://i.ebayimg.com/images/g/D-UAAOSwU1NdSAd2/s-l300.png'
            ));
        DB::table('packages')->insert(
            array(
                'name'=>'Gold Plan', 
                'price'=>30,
                'description'=> 'This is the gold plan',
                'capacity' => '500 MB',
                'image' => 'https://i.ebayimg.com/images/g/5M8AAOSwIA9dSAet/s-l300.png'
            ));
        DB::table('packages')->insert(
            array(
                'name'=>'Platinum Plan', 
                'price'=>50,
                'description'=> 'This is the platinum plan',
                'capacity' => '1 GB',
                'image' => 'https://img.rankedboost.com/wp-content/uploads/2014/09/Season_2019_-_Platinum_1.png'
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
