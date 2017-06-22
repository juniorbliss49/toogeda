<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Campaigndonationvalues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigndonationvalues', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('campaign_id')->unsigned();
            $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->integer('donation_id')->unsigned();
            $table->foreign('donation_id')->references('id')->on('campaigndonation');
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
        Schema::drop('campaigndonationvalues');
    }
}
