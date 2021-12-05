<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogCommandMissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_command_mission', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 100);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);

        });

        Schema::table('log_command_mission', function (Blueprint $table) {
            $table->unsignedBigInteger('mission_id');

            $table->foreign('mission_id')->references('id')->on('mission');
        });

        Schema::table('log_command_mission', function (Blueprint $table) {
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
        Schema::table('log_command_mission', function (Blueprint $table) {
            $table->dropForeign('log_command_mission_mission_id_foreign');
        });

        Schema::table('log_command_mission', function (Blueprint $table) {
            $table->dropForeign('log_command_mission_user_id_foreign');
        });

        Schema::dropIfExists('log_command_mission');
    }
}
