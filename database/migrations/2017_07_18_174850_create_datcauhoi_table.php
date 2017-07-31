<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatcauhoiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datcauhoi', function (Blueprint $table) {
          $table->increments('id');
          $table->string('hoten');
          $table->string('diachi');
          $table->string('dienthoai');
          $table->string('email');
          $table->string('tieude');
          $table->string('slug');
          $table->text('noidung');
          $table->string('traloi')->nullable();
          $table->integer('user_id')->unsigned()->nullable();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->boolean('active')->default('0');
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
        Schema::table('datcauhoi', function (Blueprint $table) {
            Schema::dropIfExists('datcauhoi');
        });
    }
}
