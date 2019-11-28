<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('user_types')->insert(
            array(
                'name'=>'Admin'
        ));
        DB::table('user_types')->insert(
            array(
                'name'=>'User'
        ));
        DB::table('user_types')->insert(
            array(
                'name'=>'Support'
        ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_types');
    }
}
