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
        $absence -> time = '2A';
        $absence -> comment = "falto a segunda hora por motivos personales";
        $absence -> user_id = 2;
        $absence -> save();
        
    }
}
