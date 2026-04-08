<?php

namespace Database\Seeders;

use App\Models\CityEvent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        CityEvent::factory(30)->create();
    }
}
