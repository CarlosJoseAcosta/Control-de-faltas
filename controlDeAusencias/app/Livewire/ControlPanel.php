<?php

namespace App\Livewire;

use App\Models\Absence;
use App\Models\Department;
use App\Models\User;
use Livewire\Component;

class ControlPanel extends Component
{

    public $idDepartamento;
    public $ausencias;
    public $departamentos;
    public $hora;
    public $comentario;
    public $profesor;
    public $departamento;
    public $nameUser;
    public $email;
    public $password;
    public $modal = false;
    public $modal1 = false;
    public $busquedaFech;
    public $busquedaHora;
    public $todosUser;
    public $insertTime=[];
    public $insertDate;
    public $insertComment;
    public $idUserAbs;

    public function render()
    {
        return view('livewire.control-panel');
    }

    public function mount(){
        $fecha = date("Y-m-d");
        $this->ausencias = Absence::select('absences.id as idAusencia','users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario', 'absences.date as fecha')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->where("absences.date","=", $fecha)->get();
        $this->departamentos = Department::where('id','!=','1')->get();
        $this->todosUser = User::all();
    }

    public function limpiezaUsuario(){
        $this->nameUser="";
        $this->email="";
        $this->password="";
        $this->idDepartamento="";
    }

    public function limpiezaAusencia(){
        $this->insertDate = "";
        $this->insertTime = [];
        $this->insertComment = "";
        $this->idUserAbs = "";
    }

    public function modalUsuario(){
        $this->limpiezaUsuario();
        $this->modal = true;
    }

    public function modalAusencias(){
        $this->modal1 = true;
    }

    public function adiosModalUsuario(){
        $this->mount();
        $this->modal = false;
    }

    public function adiosModalAusencias(){
        $this->mount();
        $this->modal1 = false;
    }

    public function nuevoUsuario(){
        if(($this->idDepartamento == "") || ($this->idDepartamento == null)){

        }else{
            $user = new User();
            $user-> name = $this->nameUser;
            $user -> email = $this->email;
            $user -> password = "password";
            $user -> department_id = $this->idDepartamento;
            $user -> save();
            $this-> limpiezaUsuario();
            $this-> adiosModalUsuario();
        }
    }

    public function nuevaAusencia(){
        foreach($this->insertTime as $x => $y){
        $ausencia = new Absence();
        $ausencia -> date = $this->insertDate;
            $ausencia -> time = $y;
            $ausencia -> comment = $this->insertComment;
            $ausencia -> user_id = $this->idUserAbs;
            $ausencia -> save();
            $this->mount();
            $this->adiosModalAusencias();
        }
        $this->limpiezaAusencia();
    }

    public function eliminarAusencia(Absence $absences){
        $absences->delete();
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
