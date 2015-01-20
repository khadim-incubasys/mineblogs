<?php
/** author:Khadim Raath */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('description');
			$table->integer('blog_id');
                        $table->foreign('blog_id')->references('id')->on('blogs');
			$table->integer('user_id');
                        $table->foreign('user_id')->references('id')->on('users');
			$table->boolean('status')->default(0);
			$table->integer('likes')->nullable()->default(0);
			$table->string('imageUrl')->nullable();
			$table->nullableTimeStamps();
		});
	}

	public function down()
	{
		Schema::drop('comments');
	}

}
