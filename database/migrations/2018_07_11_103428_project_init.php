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
        Schema::create('brand', function (Blueprint $table)
        {
            $table->increments('id')->index()->unsigned();
            $table->string('name',500)->nullable(false);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('model', function (Blueprint $table)
        {
            $table->increments('id')->index()->unsigned();
            $table->string('name',500)->nullable(false);
            $table->integer('brand_id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('model', function (Blueprint $table)
        {
            $table->foreign('brand_id', 'fk_model_brand')
                ->references('id')
                ->on('brand')->onDelete('cascade');
        });

        Schema::create('address', function (Blueprint $table)
        {
            $table->increments('id')->index()->unsigned();
            $table->string('description',500)->nullable(false);
            $table->string('district', 200)->nullable(false);
            $table->string('cep', 10);
            $table->string('city', 100);
            $table->string('uf', 2)->nullable(false);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('company', function (Blueprint $table)
        {
            $table->increments('id')->index()->unsigned();
            $table->string('name',300)->nullable(false);
            $table->string('cnpj',14)->nullable(false);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('address_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });

        Schema::table('company', function(Blueprint $table) {
            $table->foreign('address_id', 'fk_company_address')->index()
                ->references('id')
                ->on('address')->onDelete('cascade');
//            $table->foreign('user_id', 'fk_company_user')->index()
//                ->references('id')
//                ->on('users')->onDelete('cascade');
        });

        Schema::create('provider', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->string('name',300)->nullable(false);
            $table->string('document',14)->nullable(false);
            $table->integer('address_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

        });

        Schema::table('provider', function(Blueprint $table) {
             $table->foreign('company_id', 'fk_provider_company')->index()
                ->references('id')
                ->on('company')->onDelete('cascade');
            $table->foreign('address_id', 'fk_provider_address')
                ->references('id')
                ->on('address')->onDelete('cascade');
        });

        Schema::create('client', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->string('name', 300)->nullable(false);
            $table->string('cnh', 50)->nullable(false);
            $table->integer('address_id')->unsigned();

            $table->integer('user_id')->unsigned();

            $table->integer('company_id')->unsigned();

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();


        });

        Schema::table('client', function(Blueprint $table) {
             $table->foreign('address_id', 'fk_client_address')->index()
                ->references('id')
                ->on('address')->onDelete('cascade');
            $table->foreign('user_id', 'fk_client_user')
                ->references('id')
                ->on('users')->onDelete('cascade');
//            $table->foreign('company_id', 'fk_client_company')->index()
//                ->references('id')
//                ->on('company')->onDelete('cascade');
        });

        Schema::create('car', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('model_id')->unsigned();

            $table->string('power',4);
            $table->string('year_factory', 4);
            $table->string('year', 4);
            $table->string('tag', 8);
            $table->string('renavan');
            $table->integer('door');
            $table->integer('capacity');
            $table->integer('company_id')->unsigned();

            $table->integer('provider_id')->unsigned()->nullable();

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('car', function(Blueprint $table) {
             $table->foreign('model_id', 'fk_car_model')
                ->references('id')
                ->on('model');
            $table->foreign('company_id', 'fk_car_company')->index()
                ->references('id')
                ->on('company')->onDelete('cascade');
//            $table->foreign('provider_id', 'fk_car_provider')->index()
//                ->references('id')
//                ->on('provider')->onDelete('cascade');
        });
//
        Schema::create('type_rent', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
//
        Schema::create('schedule', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('car_id')->unsigned();

            $table->integer('client_id')->unsigned();

            $table->integer('type_rent_id')->unsigned();
            $table->integer('km_day');
            $table->timestamp('init');
            $table->timestamp('end');
            $table->string('comment')->nullable();
            $table->integer('user_id')->unsigned();

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('schedule', function(Blueprint $table) {
             $table->foreign('car_id', 'fk_schedule_car')->index()
                ->nullable()
                ->references('id')
                ->on('car')->onDelete('cascade');
//            $table->foreign('client_id', 'fk_schedule_client')->index()
//                ->references('id')
//                ->on('client')->onDelete('cascade');
//            $table->foreign('type_rent_id', 'fk_schedule_type_rent')->index()
//                ->references('id')
//                ->on('type_rent')->onDelete('cascade');
//            $table->foreign('user_id', 'fk_schedule_user')->index()
//                ->references('id')
//                ->on('users')->onDelete('cascade');
        });

        Schema::create('daily', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('schedule_id')->unsigned();

            $table->string('value');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();


        });

        Schema::table('daily', function(Blueprint $table) {
             $table->foreign('schedule_id', 'fk_daily_schedule')->index()
                ->nullable()
                ->references('id')
                ->on('schedule')->onDelete('cascade');
        });

        Schema::create('rent', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('car_id')->unsigned();

            $table->integer('company_id')->unsigned();

            $table->integer('client_id')->unsigned();

            $table->integer('type_rent_id')->unsigned();
            $table->integer('total_km');
            $table->string('value_km_extra');
            $table->string('daily');
            $table->timestamp('init');
            $table->timestamp('end');
            $table->string('comment')->nullable();
            $table->integer('user_id')->unsigned();

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('rent', function(Blueprint $table) {
             $table->foreign('car_id', 'fk_rent_car')->index()
                ->nullable()
                ->references('id')
                ->on('car')
                ->onDelete('set null');
//            $table->foreign('company_id', 'fk_rent_company')->index()
//                ->references('id')
//                ->on('company')->onDelete('cascade');
//            $table->foreign('client_id', 'fk_rent_client')->index()
//                ->references('id')
//                ->on('client')->onDelete('cascade');
//            $table->foreign('type_rent_id', 'fk_rent_type')->index()
//                ->references('id')
//                ->on('type_rent');
//            $table->foreign('user_id', 'fk_rent_user')->index()
//                ->references('id')
//                ->on('users')->onDelete('cascade');
        });

        Schema::create('inspection', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('rent_id')->unsigned();

           $table->integer('user_id')->unsigned();

            $table->string('init_km');
            $table->string('gasoline', 10);
            $table->string('bodywork', 200); //lataria
            $table->string('washed_out', 200); //lavagem
            $table->string('note', 500)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();


        });

        Schema::table('inspection', function(Blueprint $table) {
            $table->foreign('rent_id', 'fk_inspection_rent')->index()
                ->nullable()
                ->references('id')
                ->on('rent')
                ->onDelete('set null');
//            $table->foreign('user_id', 'fk_inspection_user')->index()
//                ->references('id')
//                ->on('users');
        });

        Schema::create('devolution', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('rent_id')->unsigned();

            $table->integer('user_id')->unsigned();

            $table->string('end_km');
            $table->string('gasoline', 10);
            $table->string('bodywork', 200); //lataria
            $table->string('washed_out', 200); //lavagem
            $table->string('note', 500)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();


        });

        Schema::table('devolution', function(Blueprint $table) {
            $table->foreign('rent_id', 'fk_devolution_rent')->index()
                ->references('id')
                ->on('rent');
//            $table->foreign('user_id', 'fk_devolution_user')->index()
//                ->references('id')
//                ->on('users');
        });

        Schema::create('penalty', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('rent_id')->unsigned();

            $table->integer('user_id')->unsigned();

            $table->string('value', 10);
            $table->string('note', 500);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();


        });

        Schema::table('penalty', function(Blueprint $table) {
            $table->foreign('rent_id', 'fk_penalty_rent')->index()
                ->references('id')
                ->on('rent');
//            $table->foreign('user_id', 'fk_penalty_user')->index()
//                ->references('id')
//                ->on('users');
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
        Schema::dropIfExists('client');
        Schema::dropIfExists('company');
        Schema::dropIfExists('provider');
        Schema::dropIfExists('address');
    }
}
