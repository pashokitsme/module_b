<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relations extends Migration
{
  public function up()
  {
    Schema::table('consultants', function (Blueprint $scheme) {
      $scheme->foreign('branch_id')->on('branches')->references('id');
    });

    Schema::table('branches', function (Blueprint $scheme) {
      $scheme->foreign('region_id')->on('regions')->references('id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    //
  }
}