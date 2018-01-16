<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('item_id');
                 $table->foreign('item_id')->references('id')->on('products');
                $table->string('body',1000);

                $table->integer('buyer_id');
                $table->integer('seller_id');
                $table->integer('polarity');
                $table->integer('confidence');
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
        Schema::dropIfExists('feedbacks');
    }
}
