<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApollosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apollos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('username');
            $table->string('question');
            $table->string('answer');
            $table->integer('bot')->default(1);
            $table->boolean('status')->default(false);
            $table->bigInteger('group_id')->nullable(true);
            $table->integer('level')->nullable(true);
            $table->integer('message_id')->nullable(true);
            $table->unsignedInteger('user_id')->nullable(true);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('apollos');
    }
}
