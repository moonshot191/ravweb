<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKadlusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kadlus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('c_type')->nullable();
            $table->longText('filename')->nullable();
            $table->string('language')->default('English');
            $table->string('title')->nullable();
            $table->integer('level')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('kadlus');
    }
}
