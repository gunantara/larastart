<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('topic_id')->unsigned()->nullable()->index('fk_256_topic_topic_id_question');
			$table->text('question_text', 65535)->nullable();
			$table->text('code_snippet', 65535)->nullable();
			$table->text('answer_explanation', 65535)->nullable();
			$table->string('more_info_link', 191)->nullable();
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
		Schema::drop('questions');
	}

}
