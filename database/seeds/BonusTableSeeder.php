<?php

use App\Models\Bonus;
use Illuminate\Database\Seeder;

class BonusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bonus = [
            [
                'name' => 'Doou seu pontos',
                'cost'=> 0,
                'quantity' => 0,
                'bonus_type'=> 0,
                'bytes' => 0,
                'is_enabled' => false,
                'deleted_at' => now()
            ],
            [
                'name' => '1GB Uploaded',
                'cost'=> 275,
                'quantity' => 1073741824,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '2.5GB Uploaded',
                'cost'=> 350,
                'quantity' => 2684354560,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '5GB Uploaded',
                'cost'=> 550,
                'quantity' => 5368709120,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '10GB Uploaded',
                'cost'=> 1000,
                'quantity' => 10737418240,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '25GB Uploaded',
                'cost'=> 2000,
                'quantity' => 26843545600,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '50GB Uploaded',
                'cost'=> 4000,
                'quantity' => 53687091200,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '100GB Uploaded',
                'cost'=> 8000,
                'quantity' => 107374182400,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '520GB Uploaded',
                'cost'=> 40000,
                'quantity' => 558345748480,
                'bonus_type'=> 1,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '1TB Uploaded',
                'cost'=> 80000,
                'quantity' => 1099511627776,
                'bonus_type'=> 1,
                'bytes' => 2,
                'is_enabled' => true
            ],
            [
                'name' => '3 Convites',
                'cost'=> 650,
                'quantity' => 3,
                'bonus_type'=> 4,
                'bytes' => null,
                'is_enabled' => true
            ],
            [
                'name' => 'Remover Aviso',
                'cost'=> 1000,
                'quantity' => 1000,
                'bonus_type'=> 3,
                'bytes' => null,
                'is_enabled' => true
            ],
            [
                'name' => '1GB Download Removal',
                'cost'=> 150,
                'quantity' => 1073741824,
                'bonus_type'=> 0,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '2.5GB Download Removal',
                'cost'=> 300,
                'quantity' => 2684354560,
                'bonus_type'=> 0,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => '5GB Download Removal',
                'cost'=> 500,
                'quantity' => 5368709120,
                'bonus_type'=> 0,
                'bytes' => 1,
                'is_enabled' => true
            ],
            [
                'name' => 'VIP por 1 ano',
                'cost'=> 100000,
                'quantity' => 365,
                'bonus_type'=> 2,
                'bytes' => null,
                'is_enabled' => true
            ],
            [
                'name' => '+3 Slots',
                'cost'=> 1000,
                'quantity' => 3,
                'bonus_type'=> 5,
                'bytes' => null,
                'is_enabled' => true
            ],
        ];

        foreach ($bonus as $bon) {
            Bonus::create($bon);
        }
    }
}
