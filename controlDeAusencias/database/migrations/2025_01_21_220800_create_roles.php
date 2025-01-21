<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $rol = Role::create(['name'=>'boss']);
        $usuario = User::find(1);
        $usuario->assignRole('boss');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
