<?php

namespace App\Livewire;

use App\Models\Absence;
use App\Models\Department;
use App\Models\User;
use Livewire\Component;

class ShowAbsence extends Component
{
    public $hora;
    public $comentario;
    public $profesor;
    public $departamento;
    public $ausencias;
    public $busquedaHora;
    public $busquedaFech;
    public $todosDep;
    public $modal = false;
    public $modal1 = false;
    public $todosUser;
    public $insertTime=[];
    public $insertDate;
    public $insertComment;
    public $idUserAbs;
    public $mostrarBoton = true;
    public $editarComment;
    public $idAuxiliar;

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
        $arrayMartes = array(
            "1º mañana" => "8:55",
            "2º mañana" => "9:50",
            "3º mañana" => "10:45",
            "recreo mañana" => "11:15",
            "4º mañana" => "12:10",
            "5º mañana" => "13:05",
            "6º mañana" => "14:00",
            "1º tarde" => "15:45",
            "2º tarde" => "16:30",
            "3º tarde" => "17:15",
            "recreo tarde" => "17:45",
            "4º tarde" => "18:30",
            "5º tarde" => "19:15",
            "6º tarde" => "20:00",

        );
        /*falta añadir el array exclusivo para el martes*/
        /*select que muestra todas las faltas de la fecha actual*/
        // $this->ausencias = Absence::select('users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where('absences.created_at','like',$fechaAct)->get();
        /*select que muestra todas las faltas*/
        $horaActual = date("H:i");
        $dia = date('w');
        $fechaActual = date("Y-m-d");
         //dd($horaActual);
        $this->todosUser = User::all();
        if($dia == 2){
            $i = 0;
            foreach($arrayMartes as $x => $valor){
                if((strtotime($horaActual) < strtotime($valor)) && ($i == 0)){
                    $this->ausencias = Absence::select('absences.id as idAusencia','users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario', 'absences.date as fecha')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where('absences.time', '=', $x)->where("absences.date","=", $fechaActual)->get();
                    $i++;
                }
            }
        }else{
            $i = 0;
            $this->ausencias = Absence::select('absences.id as idAusencia','users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario', 'absences.date as fecha')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where("absences.date","=", $fechaActual)->get();
            foreach($arayHoras as $x => $valor){
                if((strtotime($horaActual) < strtotime($valor)) && ($i == 0)){
                    // $this->ausencias = Absence::select('absences.id as idAusencia','users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario', 'absences.date as fecha')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where('absences.time', '=', $x)->where("absences.date","=", $fechaActual)->get();
                    $i++;
                }
            }
        }
        // dd($this->ausencias);
        $this->todosDep = Department::select('name')->where('id','!=','1')->get();
    }

    public function modalAusencias(){
        $this->modal = true;
        
    }

    public function modalAct(Absence $id){
        $this->modal1 = true;
        $this->idAuxiliar = $id;
        // dd($this->idAuxiliar);
    }

    public function adiosModalAct(){
        $this->mount();
        $this->modal1 = false;
    }

    public function adiosModalAusencias(){
        $this->mount();
        $this->modal = false;
    }

    public function limpiezaAusencia(){
        $this->insertDate = "";
        $this->insertTime = [];
        $this->insertComment = "";
        $this->idUserAbs = "";
    }

    public function nuevaAusencia(){
        // dd($this->insertTime);
        foreach($this->insertTime as $x => $y){
        $ausencia = new Absence();
        $ausencia -> date = $this->insertDate;
            $ausencia -> time = $y;
            $ausencia -> comment = $this->insertComment;
            $ausencia -> user_id = auth()->user()->id;
            $ausencia -> save();
            $this->mount();
            $this->adiosModalAusencias();
        }
        $this->limpiezaAusencia();
    }

    public function eliminarAusencia($absences){
        $absences->delete();
        $this->mount();
    }

    public function actualizarAusencias(){
        // dd($this->idAuxiliar);
        $ausenciaAct = Absence::find($this->idAuxiliar->id);
        $ausenciaAct->comment = $this->editarComment;
        $ausenciaAct->save();
        $this->adiosModalAct();
        $this->mount();
    }

    public function filter(){

        // dd($this->busquedaHora);
        if(($this->busquedaFech == "") && ($this->busquedaHora != "")){
            $this->ausencias = Absence::select('users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where("absences.time", "=", $this->busquedaHora)->get();
        }elseif(($this->busquedaFech != "") && ($this->busquedaHora == "")){
            $this->ausencias = Absence::select('users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where("absences.date", "=", $this->busquedaFech)->get();
        }
    }

    public function limpiar(){
        $this->mount();
    }
}
