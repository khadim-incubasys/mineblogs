<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCommentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('blog_comments', function(Blueprint $table) {
            $table->increments('id');
            $table->text('description');
             $table->integer('blog_id');
            $table->integer('user_id');
            $table->string('user_name');
            $table->bigInteger('likes')->nullable()->default(0);
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists("blog_comments");
    }

}
