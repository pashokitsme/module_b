<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Consultant;
use App\Models\Region;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    Category::create(['name' => 'category01']);
    Admin::create(['name' => 'admin', 'email' => 'q@w.com', 'password' => '123']);
    Region::create(['name' => 'region1']);
    Branch::create(['region_id' => 1, 'name' => 'branch01']);
    Consultant::create(['name' => 'cons', 'email' => 'c@w.com', 'password' => '123', 'branch_id' => 1]);
  }
}