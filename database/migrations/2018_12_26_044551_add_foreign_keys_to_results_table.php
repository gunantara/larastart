<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('results', function(Blueprint $table)
		{
			$table->foreign('user_id', 'fk_254_user_user_id_result')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('question_id', 'fk_257_question_question_id_result')->references('id')->on('questions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('results', function(Blueprint $table)
		{
			$table->dropForeign('fk_254_user_user_id_result');
			$table->dropForeign('fk_257_question_question_id_result');
		});
	}

}
