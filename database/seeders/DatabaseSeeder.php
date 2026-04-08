<?php

namespace Database\Seeders;

use App\Models\CityEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        CityEvent::factory(30)->create();
    }
}
