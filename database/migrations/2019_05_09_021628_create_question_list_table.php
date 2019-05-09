<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_list', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->increments('id');
            $table->timestamps();
            $table->integer('title_id');
            $table->string("name",255);
            $table->string("image_url",255)->nullable();
            $table->string("answer_A",255);
            $table->string("answer_B",255);
            $table->string("answer_C",255);
            $table->string("answer_D",255);
            $table->string("answer_true",255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_list');
    }
}
