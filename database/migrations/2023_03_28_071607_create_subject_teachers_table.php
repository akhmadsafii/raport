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
        Schema::create('subject_teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->nullable();
            $table->unsignedInteger('id_teacher');
            $table->unsignedInteger('id_course');
            $table->unsignedInteger('id_school_year');
            $table->json('id_study_class');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('subject_teachers', function (Blueprint $table) {
            $table->foreign('id_teacher')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('id_course')->references('id')->on('courses')->onDelete('cascade');
            // $table->foreign('id_study_class')->references('id')->on('study_classes')->onDelete('cascade');
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
        Schema::table('subject_teachers', function (Blueprint $table) {
            $table->dropForeign('subject_teachers_id_teacher_foreign');
            $table->dropForeign('subject_teachers_id_course_foreign');
            // $table->dropForeign('subject_teachers_id_study_class_foreign');
            $table->dropForeign('subject_teachers_id_school_year_foreign');
        });

        Schema::dropIfExists('subject_teachers');
    }
};
