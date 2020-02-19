<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_members', function (Blueprint $table) {
            $table->bigIncrements('tour_member_id');
            $table->integer('user_id')->unique();
            $table->integer('tour_id');
            $table->integer('person_quantity')->default(0);
            $table->integer('child_quantity')->default(0);
            $table->integer('baby_quantity')->default(0);
            $table->integer('accepted')->default(0);
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
        Schema::dropIfExists('tour_members');
    }
}
