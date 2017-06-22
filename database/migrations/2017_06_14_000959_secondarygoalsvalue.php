<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Secondarygoalsvalue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondarygoalsvalue', function($table)
        {
            $table->increments('id');
            $table->integer('campaign_id')->unsigned();
            $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->integer('secgl_id')->unsigned();
            $table->foreign('secgl_id')->references('id')->on('secondarygoals');
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
        Schema::drop('secondarygoalsvalue');
    }
}
