<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Maintenance\Company;
use Faker\Factory as Faker;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 15) as $index) {
            Company::insert([
                'name' => $faker->company,
                'email' => $faker->unique()->safeEmail,
                'website' => $faker->url,
                'logo' => json_encode([
                    [
                        'title' => $faker->word . '.jpg',
                        'url' => $faker->imageUrl(),
                        'filename' => $faker->uuid . '.jpg',
                        'timestamp' => now()->toIso8601ZuluString(),
                    ]
                ]),
                'edit_by' => $faker->email,
                'updated_at' => now(),
                'created_at' => now(),
            ]);
        }
    }
}
