<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNuwasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nuwas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('answer');
            $table->string('language');
            $table->integer('level')->nullable(true);
            $table->string('edited_by')->nullable();
            $table->boolean('validated')->default(false);
            $table->string('validated_by')->nullable();
            $table->timestamp('validated_at')->nullable();
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
        Schema::dropIfExists('nuwas');
    }
}
