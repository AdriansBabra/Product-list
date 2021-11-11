<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->delete();
                $items = [
                    ['id' => 1, 'name' => 'Laptop HP', 'category' => 'Electronics & Media', 'available' => '344', 'price' => '234','weight' => '2',
                        'updated_at'=> date('Y-m-d H:i:s'), 'created_at'=> date('Y-m-d H:i:s')],
                    ['id' => 2, 'name' => 'Apple Watch', 'category' => 'Electronics & Media', 'available' => '201', 'price' => '401','weight' => '0.5',
                        'updated_at'=> date('Y-m-d H:i:s'),'created_at'=> date('Y-m-d H:i:s')],
                    ['id' => 3, 'name' => 'Office table', 'category' => 'Furniture & Appliances', 'available' => '50', 'price' => '95','weight' => '5.3',
                        'updated_at'=> date('Y-m-d H:i:s'), 'created_at'=> date('Y-m-d H:i:s')],
                    ['id' => 4, 'name' => 'Toothpaste V2', 'category' => 'Food & Personal Care', 'available' => '39', 'price' => '4','weight' => '2',
                        'updated_at'=> date('Y-m-d H:i:s'),'created_at'=> date('Y-m-d H:i:s')],
                    ['id' => 5, 'name' => 'Blue Jacket', 'category' => 'Fashion', 'available' => '54', 'price' => '76','weight' => '1',
                        'updated_at'=> date('Y-m-d H:i:s'), 'created_at'=> date('Y-m-d H:i:s')],
                    ['id' => 6, 'name' => 'Fishing rod', 'category' => 'Toys, Hobby', 'available' => '42', 'price' => '150','weight' => '3.5',
                        'updated_at'=> date('Y-m-d H:i:s'),'created_at'=> date('Y-m-d H:i:s')],
                ];

        Item::insert($items);

//            'created_at'=> date('Y-m-d H:i:s'),
//            'updated_at'=> date('Y-m-d H:i:s'),
    }
}
