<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CountingUnitItem;
use App\Models\CountingUnitProcedureItem;
use App\Models\Customer;
use App\Models\Item;
use App\Models\MachineryItem;
use App\Models\ProcedureItem;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

//        Customer::factory(100)->create();
        Category::factory(5)->create();
        SubCategory::factory(5)->create();
        Brand::factory(10)->create();
        Item::factory(50)->create();
        CountingUnitItem::factory(100)->create();
        ProcedureItem::factory(10)->create();
        CountingUnitProcedureItem::factory(20)->create();

    }
}
