<?php

namespace Database\Seeders;

use Database\Factories\SlotFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SlotFactory::new()->count(50)->create();
    }
}
