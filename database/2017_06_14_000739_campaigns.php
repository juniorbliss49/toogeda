<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Campaigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->integer('primarygoal_id')->unsigned();
            $table->foreign('primarygoal_id')->references('id')->on('primarygoals');
            $table->string('campaignimage');
            $table->text('description');
            $table->string('campaignstartdate');
            $table->string('campaignenddate');
            $table->string('campaignstarttime');
            $table->string('campaignendtime');
            $table->string('visiblilty');
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
        Schema::drop('campaigns');
    }
}
