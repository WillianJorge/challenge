<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('agency');
            $table->string('number');
            $table->string('digit')->unique();
            $table->string('company_name')->nullable();
            $table->string('trading_name')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('name')->nullable();
            $table->string('cpf')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('account_type_id');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('account_type_id')->references('id')->on('account_types');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
