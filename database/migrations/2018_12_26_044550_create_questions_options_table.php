<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions_options', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('question_id')->unsigned()->nullable()->index('fk_257_question_question_id_questions_option');
			$table->string('option', 191)->nullable();
			$table->integer('value')->nullable();
			$table->timestamps();
			$table->softDeletes()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questions_options');
	}

}
