<?php

namespace App\Livewire;

use App\Models\Absence;
use App\Models\Department;
use Livewire\Component;

class ShowAbsence extends Component
{
    public $hora;
    public $comentario;
    public $profesor;
    public $departamento;
    public $ausencias;
    public $busquedaHora;
    public $busquedaDep;
    public $todosDep;
    public function render()
    {
        return view('livewire.show-absence');
    }

    public function mount(){
        $dia = date("d");
        $mes = date("m");
        $anio = date("Y");
        $fechaAct = $anio."-".$mes."-".$dia;
        // $this->ausencias = Absence::select('users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where('absences.created_at','like',$fechaAct)->get();
        $this->ausencias = Absence::select('users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->get();
        $this->todosDep = Department::select('name')->where('id','!=','1')->get();
    }

    public function filter(){

        // dd($this->busquedaHora);
         if(($this->busquedaDep == "") && ($this->busquedaHora != "")){
            $this->ausencias = Absence::select('users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where("absences.time", "=", $this->busquedaHora)->get();
         }elseif(($this->busquedaDep != "") && ($this->busquedaHora == "")){
            $this->ausencias = Absence::select('users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where("absences.time", "=", $this->busquedaDep)->get();
         }
    }
}
