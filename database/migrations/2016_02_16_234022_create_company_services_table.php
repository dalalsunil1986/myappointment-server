<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('service_id');
            $table->decimal('price',5,2);
            $table->string('duration_en')->nullable(); // ex: 1 hour, 2 hour, 30min etc
            $table->text('description_en')->nullable();

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
        Schema::drop('company_services');
    }
}
