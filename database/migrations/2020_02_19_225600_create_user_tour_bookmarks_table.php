<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTourBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tour_bookmarks', function (Blueprint $table) {
            $table->bigIncrements('tour_bookmark_id');
            $table->integer('user_id');
            $table->integer('tour_id')->unique();
            $table->integer('marked')->default(0);
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
        Schema::dropIfExists('user_tour_bookmarks');
    }
}
