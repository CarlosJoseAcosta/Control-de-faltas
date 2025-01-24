<?php

namespace Database\Seeders;

use App\Models\Absence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $absence = new Absence();
        $absence -> date = '2025-01-30';
        $absence -> time = '2º Tarde';
        $absence -> comment = "falto a segunda hora por motivos personales";
        $absence -> user_id = 2;
        $absence -> save();
        $absence1 = new Absence();
        $absence1 -> date = '2025-03-06';
        $absence1 -> time = '1º Mañana';
        $absence1 -> comment = "falto a primera hora por motivos personales";
        $absence1 -> user_id = 2;
        $absence1 -> save();
        
    }
}
