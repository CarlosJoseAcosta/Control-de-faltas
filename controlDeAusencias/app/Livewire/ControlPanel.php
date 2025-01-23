<?php

namespace App\Livewire;

use App\Models\Absence;
use Livewire\Component;

class ControlPanel extends Component
{

    public $hora;
    public $comentario;
    public $profesor;
    public $departamento;
    public $ausencias;

    public function render()
    {
        return view('livewire.control-panel');
    }

    public function mount(){
        $this->ausencias = Absence::select('users.name as profesor','absences.time as hora','departments.name as departamento','absences.comment as comentario')->join('users','users.id','=','absences.user_id')->join('departments','departments.id','=','users.department_id')->get();
    }
}
