<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->foreignId('user_id')->constrained('user');
            $table->string('name', 100);
            $table->boolean('has_finished');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });

        Schema::table('mission', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('user');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mission', function (Blueprint $table) {
            $table->dropForeign('mission_user_id_foreign');
        });

        Schema::dropIfExists('mission');
    }
}
