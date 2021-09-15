<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFelidsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('fName')->nullable()->length(15);
            $table->string('mName')->nullable()->length(15);
            $table->string('lName')->nullable()->length(15);
            $table->string('phone')->nullable()->length(15);
            $table->string('parentPhone')->nullable()->length(15);
            $table->string('city')->nullable();
            $table->integer('governorate')->nullable();
            $table->integer('center')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
}
