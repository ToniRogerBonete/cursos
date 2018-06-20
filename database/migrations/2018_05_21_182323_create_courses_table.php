<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('level_id')->unsigned()->nullable();
            $table->foreign('level_id')->references('id')->on('levels');
            $table->string('name','50');
            $table->text('description')->nullable();
            $table->text('objective')->nullable();
            $table->text('requisites')->nullable();
            $table->text('audience')->nullable();
            $table->char('type_sale','1')->nullable();
            $table->decimal('price','6','2')->nullable();
            $table->char('certificate','1')->nullable();
            $table->string('video_presentation','50')->nullable();
            $table->string('video_current_time','50')->nullable();
            $table->string('image_presentation','50')->nullable();
            $table->char('status','1')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
