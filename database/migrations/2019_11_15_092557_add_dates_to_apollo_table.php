<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatesToApolloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apollos', function (Blueprint $table) {
            $table->string('edited_by');
            $table->boolean('validated');
            $table->string('validated_by');
            $table->dateTime('validated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apollos', function (Blueprint $table) {
            $table->dropColumn('edited_by');
            $table->dropColumn('validated');
            $table->dropColumn('validated_by');
            $table->dropColumn('validation_date');
        });
    }
}
