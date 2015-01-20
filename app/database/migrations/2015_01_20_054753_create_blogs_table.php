<?php
/** author:Khadim Raath */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogsTable extends Migration {

	public function up()
	{
		Schema::create('blogs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->text('body');
			$table->integer('user_id');
			$table->boolean('status')->default(0);;
			$table->integer('permission')->default(0);;
			$table->integer('likes')->nullable()->default(0);
			$table->string('imageUrl')->nullable();
                        $table->rememberToken();
			$table->nullableTimestamps();
		});
	}

	public function down()
	{
		Schema::drop('blogs');
	}

}
