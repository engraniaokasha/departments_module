<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsDepartmentsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments__departments_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('departments_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['departments_id', 'locale']);
            $table->foreign('departments_id')->references('id')->on('departments__departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departments__departments_translations', function (Blueprint $table) {
            $table->dropForeign(['departments_id']);
        });
        Schema::dropIfExists('departments__departments_translations');
    }
}
