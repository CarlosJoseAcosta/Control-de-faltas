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
        $rol2 = Role::create(['name'=>'teacher']);
        $usuario = User::find(1);
        $usuario2 = User::where('id','!=','1')->get();
        $usuario->assignRole($rol);
        foreach($usuario2 as $user){
            $user->assignRole($rol2);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
