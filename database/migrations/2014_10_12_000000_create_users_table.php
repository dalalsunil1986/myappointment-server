<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',40)->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('mobile',15);
            $table->string('activation_code')->nullable();
            $table->string('api_token', 60)->unique();
            $table->boolean('active')->default(0);
            $table->boolean('admin')->nullable()->default(0);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
