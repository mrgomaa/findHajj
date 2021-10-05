<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeadOmraRequestsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dead_omra_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile_no');
            $table->string('request_sender_name');
            $table->string('dead_name');
            $table->integer('dead_age');
            $table->text('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dead_omra_requests');
    }
}
