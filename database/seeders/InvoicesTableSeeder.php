<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class InvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i <= 100; $i++) {
            Invoice::create([
                'number'          => $faker->numberBetween(0, 100),
                'paid'            => $faker->boolean(),
                'issue_date'      => $faker->date(),
                'collection_date' => $faker->date(),
                'buyer_name'      => $faker->firstName(50),
                'buyer_surname'   => $faker->lastName(50),
                'buyer_street'    => $faker->streetName(),
                'amount'          => $faker->randomFloat(1, 20, 30),
            ]);
        }
    }
}
