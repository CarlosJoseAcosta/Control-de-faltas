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
        $arayHoras = array(
            "1º mañana" => "8:55",
            "2º mañana" => "9:50",
            "3º mañana" => "10:45",
            "recreo mañana" => "11:15",
            "4º mañana" => "12:10",
            "5º mañana" => "13:05",
            "6º mañana" => "14:00",
            "1º tarde" => "14:55",
            "2º tarde" => "15:50",
            "3º tarde" => "16:45",
            "recreo tarde" => "17:15",
            "4º tarde" => "18:10",
            "5º tarde" => "19:05",
            "6º tarde" => "20:00",
        );
        /*falta añadir el array exclusivo para el martes*/
        /*select que muestra todas las faltas de la fecha actual*/
        // $this->ausencias = Absence::select('users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where('absences.created_at','like',$fechaAct)->get();
        /*select que muestra todas las faltas*/
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
