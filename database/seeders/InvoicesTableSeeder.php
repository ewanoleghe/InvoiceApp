<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoicesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('invoices')->insert([
            [
                'id' => 1,
                'invoice_id' => 'RT3080',
                'createdAt' => '2021-08-18',
                'paymentDue' => '2021-08-19',
                'description' => 'Re-branding',
                'paymentTerms' => 1,
                'clientName' => 'Jensen Huang',
                'clientEmail' => 'jensenh@mail.com',
                'status' => 'paid',
                'senderAddress_street' => '19 Union Terrace',
                'senderAddress_city' => 'London',
                'senderAddress_postCode' => 'E1 3EZ',
                'senderAddress_country' => 'United Kingdom',
                'clientAddress_street' => '106 Kendell Street',
                'clientAddress_city' => 'Sharrington',
                'clientAddress_postCode' => 'NR24 5WQ',
                'clientAddress_country' => 'United Kingdom',
                'total' => 1800.90,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 2,
                'invoice_id' => 'XM9141',
                'createdAt' => '2021-08-21',
                'paymentDue' => '2021-09-20',
                'description' => 'Graphic Design',
                'paymentTerms' => 30,
                'clientName' => 'Alex Grim',
                'clientEmail' => 'alexgrim@mail.com',
                'status' => 'pending',
                'senderAddress_street' => '19 Union Terrace',
                'senderAddress_city' => 'London',
                'senderAddress_postCode' => 'E1 3EZ',
                'senderAddress_country' => 'United Kingdom',
                'clientAddress_street' => '84 Church Way',
                'clientAddress_city' => 'Bradford',
                'clientAddress_postCode' => 'BD1 9PB',
                'clientAddress_country' => 'United Kingdom',
                'total' => 556.00,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 3,
                'invoice_id' => 'FV2353',
                'createdAt' => '2021-11-05',
                'paymentDue' => '2021-11-12',
                'description' => 'Logo Re-design',
                'paymentTerms' => 30,
                'clientName' => 'Anita Wainwright',
                'clientEmail' => '',
                'status' => 'draft',
                'senderAddress_street' => '19 Union Terrace',
                'senderAddress_city' => 'London',
                'senderAddress_postCode' => 'E1 3EZ',
                'senderAddress_country' => 'United Kingdom',
                'clientAddress_street' => '',
                'clientAddress_city' => '',
                'clientAddress_postCode' => '',
                'clientAddress_country' => '',
                'total' => 3102.04,
                'created_at' => null,
                'updated_at' => null
            ]
        ]);
    }
}