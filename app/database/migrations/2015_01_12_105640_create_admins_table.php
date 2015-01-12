<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('admins', function(Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', '50');
            $table->string('token');
            $table->boolean('status');
            $table->string('name', '200');
            $table->string('city', '100')->nullable();
            $table->string('country', '100')->nullable();
            $table->string('imageUrl')->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists("admins");
    }

}
