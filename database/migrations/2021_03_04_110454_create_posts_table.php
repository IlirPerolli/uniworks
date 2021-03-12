<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('file_id')->unsigned()->index();
            $table->integer('year')->unsigned()->index();
            $table->text('title')->nullable()->index();
            $table->text('abstract')->nullable()->index();
            $table->integer('category_id')->nullable();
            $table->text('resource')->nullable();
            $table->integer('views')->default(0);
            $table->string('slug')->index()->nullable();
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
        Schema::dropIfExists('posts');
    }
}
