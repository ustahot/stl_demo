<?php

namespace Database\Seeders;

use App\Models\HoldStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HoldStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table = DB::table(app(HoldStatus::class)->getTable());

        $table->insert([
            'code' => 'held',
            'title' => 'Зарезервировано',
        ]);
        $table->insert([
            'code' => 'confirmed',
            'title' => 'Подтверждено',
        ]);
        $table->insert([
            'code' => 'conflict',
            'title' => 'Конфликт',
        ]);
        $table->insert([
            'code' => 'canceled',
            'title' => 'Отменен',
        ]);
    }
}
