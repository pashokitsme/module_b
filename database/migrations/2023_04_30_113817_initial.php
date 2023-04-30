<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Initial extends Migration
{
  public function up()
  {
    $basic = function (Blueprint $scheme) {
      $scheme->id();
      $scheme->string('name')->unique();
      $scheme->timestamps();
    };

    $user_table = function (Blueprint $scheme, $consultant) {
      $scheme->id();
      $scheme->string('name');
      $scheme->string('email')->unique();
      $scheme->string('password');
      $scheme->string('bearer')->unique()->nullable();
      if ($consultant)
        $scheme->unsignedBigInteger('branch_id');
      $scheme->timestamps();
    };

    Schema::create('categories', $basic);

    Schema::create('regions', $basic);

    Schema::create('branches', function (Blueprint $scheme) {
      $scheme->id();
      $scheme->unsignedBigInteger('region_id');
      $scheme->string('name')->unique();
      $scheme->timestamps();
    });

    Schema::create('consultants', function ($scheme) use ($user_table) {
      $user_table($scheme, true);
    });

    Schema::create('admins', function ($scheme) use ($user_table) {
      $user_table($scheme, false);
    });
  }

  public function down()
  {
    // nothing here
  }
}