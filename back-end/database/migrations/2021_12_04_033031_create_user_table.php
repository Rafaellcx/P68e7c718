<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->foreignId('type_user_id')->constrained('user');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 200);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);

        });

        Schema::table('user', function (Blueprint $table) {
            $table->unsignedBigInteger('type_user_id');

            $table->foreign('type_user_id')->references('id')->on('type_user');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropForeign('user_type_user_id_foreign');
        });
        Schema::dropIfExists('user');
    }
}
