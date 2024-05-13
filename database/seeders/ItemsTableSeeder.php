<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('items')->insert([
            [
                'id' => 1,
                'invoice_id' => 'FV2353',
                'name' => 'Logo Re-design',
                'quantity' => 1,
                'price' => 3102.04,
                'total' => 3102.04,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 2,
                'invoice_id' => 'RT3080',
                'name' => 'Brand Guidelines',
                'quantity' => 1,
                'price' => 1800.90,
                'total' => 1800.90,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 3,
                'invoice_id' => 'XM9141',
                'name' => 'Banner Design',
                'quantity' => 1,
                'price' => 156.00,
                'total' => 156.00,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 4,
                'invoice_id' => 'XM9141',
                'name' => 'Email Design',
                'quantity' => 2,
                'price' => 200.00,
                'total' => 400.00,
                'created_at' => null,
                'updated_at' => null
            ]
        ]);
    }
}