<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department = new Department();
        $department-> name = "administracion";
        $department-> save();
        $department1 = new Department();
        $department1-> name = "informatica";
        $department1-> save(); 
    }
}
