<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        Schema::create($tableNames['r_user_authority'], function (Blueprint $table) use ($tableNames) {
            $table->increments('user_id');
            $table->string('auth_name');
            $table->datetime('create_date');
            $table->integer('create_id');
            $table->datetime('modify_date');
            $table->integer('modify_id');
            $table->foreign('user_id')->references('user_id')->on('t_user')->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('r_user_authority');
    }
}
