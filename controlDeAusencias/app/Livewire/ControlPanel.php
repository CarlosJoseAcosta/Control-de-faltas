<?php

namespace App\Livewire;

use App\Models\Absence;
use App\Models\Department;
use App\Models\User;
use Livewire\Component;

class ControlPanel extends Component
{

    public $ausencias;
    public $departamentos;
    public $hora;
    public $comentario;
    public $profesor;
    public $departamento;
    public $nameUser;
    public $email;
    public $password;
    public $department_id;
    public $modal = false;
    public $busquedaFech;
    public $busquedaHora;

    public function render()
    {
        return view('livewire.control-panel');
    }

    public function mount(){
        $this->ausencias = Absence::select('users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario', 'absences.date as fecha')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->get();
        $this->departamentos = Department::where('id','!=','1')->get();
    }

    public function limpiezaUsuario(){
        $this->nameUser="";
        $this->email="";
        $this->password="";
        $this->department_id="";
    }

    public function modalUsuario(){
        $this->limpiezaUsuario();
        $this->modal = true;
    }

    public function adiosModalUsuario(){
        $this->mount();
        $this->modal = false;
    }

    public function nuevoUsuario(){
        $user = new User();
        $user->name = $this->nameUser;
        $user -> email = $this->email;
        $user -> password = "password";
        $user -> department_id = $this->department_id;
        $user -> save();
    }

    public function filter(){

        //  dd($this->busquedaFech);
        if(($this->busquedaFech == "") && ($this->busquedaHora != "")){
            $this->ausencias = Absence::select('users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario', 'absences.date as fecha')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where("absences.time", "=", $this->busquedaHora)->get();
        }elseif(($this->busquedaFech != "") && ($this->busquedaHora == "")){
            $this->ausencias = Absence::select('users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario', 'absences.date as fecha')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where("absences.date", "=", $this->busquedaFech)->get();
        }elseif($this->busquedaFech != "" && $this->busquedaHora != ""){
            $this->ausencias = Absence::select('users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario', 'absences.date as fecha')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where("absences.date", "=", $this->busquedaFech)->where("absences.time", "=", $this->busquedaHora)->get();

        }else{
            $this->mount();
        }
    }

    public function clean(){
        $this->mount();
    }
}
