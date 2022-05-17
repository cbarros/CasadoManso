<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Produtos extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->integer('user_id')->nullable();
            $table->timestamp('confirmado')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
