<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('voters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id')->unique();
            $table->string('voting_rights');
            $table->string('first_name');
            $table->string('last_name');

            $table->integer('address')->index();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('voters');
    }
}
