<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProjectInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table)
        {
            $table->increments('id')->index()->unsigned();
            $table->string('description',500)->nullable(false);
            $table->string('district', 200)->nullable(false);
            $table->string('cep', 10);
            $table->integer('city');
            $table->string('uf', 2)->nullable(false);
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('company', function (Blueprint $table)
        {
            $table->increments('id')->index()->unsigned();
            $table->string('name',300)->nullable(false);
            $table->string('cnpj',14)->nullable(false);
            $table->timestamp('created_at')->nullable();
            $table->integer('address_id')->unsigned();
            $table->foreign('address_id')
                ->references('id')
                ->on('address');
        });


        Schema::create('provider', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->string('name',300)->nullable(false);
            $table->string('document',14)->nullable(false);
            $table->integer('address_id')->unsigned();
            $table->foreign('address_id')
                ->references('id')
                ->on('address');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')
                ->references('id')
                ->on('company');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('client', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->string('name', 300)->nullable(false);
            $table->string('cnh', 50)->nullable(false);
            $table->integer('address_id')->unsigned();
            $table->foreign('address_id')->index()
                ->references('id')
                ->on('address');
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('car', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->string('automaker',100)->nullable(false);
            $table->string('model',200)->nullable(false);
            $table->string('power',4);
            $table->string('year_factory', 4);
            $table->string('year', 4);
            $table->string('tag', 8);
            $table->string('renavan');
            $table->integer('door');
            $table->integer('capacity');
            $table->integer('company_id')->unsigned();
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->index()
                ->nullable()
                ->references('id')
                ->on('provider');
            $table->timestamp('created_at')->nullable();
        });
//
        Schema::create('type_rent', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
        });
//
        Schema::create('schedule', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('car_id')->unsigned();
            $table->foreign('car_id')->index()
                ->nullable()
                ->references('id')
                ->on('car');
            $table->integer('client_id')->unsigned();
            $table->integer('type_rent_id')->unsigned();
            $table->timestamp('init');
            $table->timestamp('end');
            $table->string('comment');
            $table->integer('user_id')->unsigned();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('daily', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('schedule_id')->unsigned();
            $table->foreign('schedule_id')->index()
                ->nullable()
                ->references('id')
                ->on('schedule');
            $table->string('value');
        });

        Schema::create('rent', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('car_id')->unsigned();
            $table->foreign('car_id')->index()
                ->nullable()
                ->references('id')
                ->on('car')
                ->onDelete('set null');
            $table->integer('client_id')->unsigned();
            $table->integer('type_rent_id')->unsigned();
            $table->string('daily')->index();
            $table->timestamp('init');
            $table->timestamp('end');
            $table->string('comment');
            $table->integer('user_id')->unsigned();
        });

        Schema::create('inspection', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('rent_id')->unsigned();
            $table->foreign('rent_id')->index()
                ->nullable()
                ->references('id')
                ->on('rent')
                ->onDelete('set null');
           $table->integer('user_id')->unsigned();
            $table->string('init_km');
            $table->string('gasoline', 10);
            $table->string('bodywork', 200); //lataria
            $table->string('washed_out', 200); //lavagem
            $table->string('note', 500);
        });

        Schema::create('devolution', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('rent_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('end_km');
            $table->string('gasoline', 10);
            $table->string('bodywork', 200); //lataria
            $table->string('washed_out', 200); //lavagem
            $table->string('note', 500);
        });

        Schema::create('penalty', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('rent_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('value', 10);
            $table->string('note', 500);
            $table->timestamp('datetime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily');
        Schema::dropIfExists('devolution');
        Schema::dropIfExists('inspection');
        Schema::dropIfExists('penalty');
        Schema::dropIfExists('type_rent');
        Schema::dropIfExists('schedule');
        Schema::dropIfExists('rent');
        Schema::dropIfExists('car');
        Schema::dropIfExists('address');
        Schema::dropIfExists('company');
        Schema::dropIfExists('client');
        Schema::dropIfExists('provider');
    }
}
