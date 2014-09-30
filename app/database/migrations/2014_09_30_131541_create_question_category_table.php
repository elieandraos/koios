<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('question_category', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name', 50);
			$table->integer('application_id')->unsigned();
			$table->foreign('application_id')
						->references('id')
						->on('application')
						->onDelete('cascade');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('question_category');
	}

}
