<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PoliticalParty;

class PoliticalPartiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parties = [
            ['name' => 'Awami League', 'slug' => 'awami-league'],
            ['name' => 'Bangladesh Nationalist Party', 'slug' => 'bangladesh-nationalist-party'],
            ['name' => 'Jatiya Party (Ershad)', 'slug' => 'jatiya-party-ershad'],
            ['name' => 'Gono Forum', 'slug' => 'gono-forum'],
            ['name' => 'Workers Party of Bangladesh', 'slug' => 'workers-party-of-bangladesh'],
        ];

        foreach ($parties as $party) {
            PoliticalParty::updateOrCreate(
                ['slug' => $party['slug']],
                ['name' => $party['name']]
            );
        }
    }
} 