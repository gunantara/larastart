<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToQuestionsOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('questions_options', function(Blueprint $table)
		{
			$table->foreign('question_id', 'fk_257_question_question_id_questions_option')->references('id')->on('questions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('questions_options', function(Blueprint $table)
		{
			$table->dropForeign('fk_257_question_question_id_questions_option');
		});
	}

}
