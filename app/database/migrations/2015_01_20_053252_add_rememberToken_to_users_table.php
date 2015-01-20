<?php
/** author:Khadim Raath */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRememberTokenToUsersTable extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->rememberToken();
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn('rememberToken');
		});
	}

}
