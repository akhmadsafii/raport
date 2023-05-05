<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_merdekas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->nullable();
            $table->bigInteger('id_student_class')->nullable();
            $table->integer('id_course')->nullable();
            $table->integer('id_study_class')->nullable();
            $table->integer('id_teacher')->nullable();
            $table->integer('id_school_year')->nullable();
            $table->json('score_formative')->nullable();
            $table->integer('average_formative')->nullable();
            $table->json('score_summative')->nullable();
            $table->integer('average_summative')->nullable();
            $table->integer('score_uts')->nullable();
            $table->integer('score_uas')->nullable();
            $table->integer('final_score')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('score_merdekas', function (Blueprint $table) {
            $table->foreign('id_student_class')->references('id')->on('student_classes')->onDelete('cascade');
            $table->foreign('id_course')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('id_study_class')->references('id')->on('study_classes')->onDelete('cascade');
            $table->foreign('id_teacher')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('id_school_year')->references('id')->on('school_years')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('score_merdekas', function (Blueprint $table) {
            $table->dropForeign('score_merdekas_id_student_class_foreign');
            $table->dropForeign('score_merdekas_id_course_foreign');
            $table->dropForeign('score_merdekas_id_teacher_foreign');
            $table->dropForeign('score_merdekas_id_study_class_foreign');
            $table->dropForeign('score_merdekas_id_school_year_foreign');
        });


        Schema::dropIfExists('score_merdekas');
    }
};
