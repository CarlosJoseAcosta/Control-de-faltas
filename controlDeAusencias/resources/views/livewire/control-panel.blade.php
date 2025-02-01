<div>
    <div class = "mx-24 grid grid-cols-6 flex justify-items-center">
        <label for=""> Elija el departamento que desea buscar: </label>
        <input type="date" name="" id="" wire:model = "busquedaFech">
        <label for="" class="mx-2"> o elije la hora que quiere filtrar:</label>
        <select name="" id="" wire:model="busquedaHora">
            <option value="">Elija una opcion</option>
            <option value="1º mañana">1º mañana</option>
            <option value="2º mañana">2º mañana</option>
            <option value="3º mañana">3º mañana</option>
            <option value="recreo mañana">recreo mañana</option>
            <option value="4º mañana">4º mañana</option>
            <option value="5º mañana">5º mañana</option>
            <option value="6º mañana">6º mañana</option>
            <option value="1º tarde">1º tarde</option>
            <option value="2º tarde">2º tarde</option>
            <option value="3º tarde">3º tarde</option>
            <option value="recreo tarde">recreo tarde</option>
            <option value="4º tarde">4º tarde</option>
            <option value="5º tarde">5º tarde</option>
            <option value="6º tarde">6º tarde</option>
        </select>
        <button wire:click="filter"class="px-4 bg-gray-500 text-white mx-3">Enviar</button>
        <button wire:click="clean" class="px-4 bg-gray-500 text-white mx-3">Limpiar filtro</button>
    </div>
    <div class="mx-24 my-5 grid grid-cols-3">
        <button class="px-4 bg-gray-500 text-white mx-3" wire:click ="modalUsuario">Crear usuarios</button>
        <button class = "px-4 bg-green-500 text-white mx-3" wire:click = "modalAusencias">Crear faltas</button>
    </div>
    <div class="mx-24 flex justify-items-center">
        <table class="text-left table-auto min-w-full">
            <thead class="bg-black text-white py-4">
                <tr class = "flex w-full mb-4">
                    <td class="p-4 w-1/4">Profesor</td>
                    <td class="p-4 w-1/4">Departamento</td>
                    <td class="p-4 w-1/4">Fecha</td>
                    <td class="p-4 w-1/4">Hora</td>
                    <td class="p-4 w-1/4">Motivo</td>
                    <td class="p-4 w-1/4"></td>
                    <td class="p-4 w-1/4"></td>
                </tr>
            </thead>
            <tbody class="bg-gray-400" >
            @foreach($ausencias as $x)
                <tr class="flex w-full mb-4 bg-grey">
                    <td class="p-4 w-1/4">{{ $x->profesor }}</td>
                    <td class="p-4 w-1/4">{{ $x->departamento }}</td>
                    <td class="p-4 w-1/4">{{ $x->fecha }}</td>
                    <td class="p-4 w-1/4">{{ $x->hora }}</td>
                    <td class="p-4 w-1/4">{{ $x->comentario }}</td>
                    <td class="p-4 w-1/4"><button wire:click = "modalAct({{$x->idAusencia}})">Actualizar</button></td>
                    <td class="p-4 w-1/4"><button wire:click = "eliminarAusencia({{$x->idAusencia}})">Eliminar</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($modal)
        <div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
            <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
              <div class="w-full">
                <div class="m-8 my-20 max-w-[400px] mx-auto">
                  <div class="mb-8">
                    <h1 class="mb-4 text-3xl font-extrabold">Creacion de nuevo usuario</h1>
                    <label for="">Nombre del profesor/a que desea registrar</label><br>
                    <input type="text" name="" id="" wire:model = "nameUser"><br>
                    <label for="">Correo electronico del profesor: </label><br>
                    <input type="email" name="" id="" wire:model = "email"><br>
                    <label for="">Introduzca el departamento que pertenezca el profesor/a</label><br>
                    <select name="" id="" wire:model = "idDepartamento"><br>
                        <option selected value="">Elija un departamento</option>
                        @foreach($departamentos as $x)
                        <option value={{$x->id}}>{{$x-> name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="space-y-4">
                    <button class="p-3 bg-black rounded-full text-white w-full font-semibold" wire:click = "nuevoUsuario">Registrar usuario</button>
                    <button class="p-3 bg-white border rounded-full w-full font-semibold" wire:click = "adiosModalUsuario">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif
        @if($modal1)
        <div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
            <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
              <div class="w-full">
                <div class="m-8 my-20 max-w-[400px] mx-auto">
                  <div class="mb-8" style="text-align: center;">
                    <h1 class="mb-4 text-3xl font-extrabold">Crear faltas</h1>
                    <label for="">Elija la fecha en la que va a faltar: </label>
                    <input type="date" name="" id="" wire:model = "insertDate"><br>
                    <label for="">En que hora va a faltar</label><br>
                    <input type="checkbox" wire:model = "insertTime" value = "1º mañana" name="" id="1"><label for="1">1º hora mañana</label> 
                    <input type="checkbox" wire:model = "insertTime" value = "2º mañana" name="" id="2"><label for="2">2º hora mañana</label> <br>
                    <input type="checkbox" wire:model = "insertTime" value = "3º mañana" name="" id="3"><label for="3">3º hora mañana</label> 
                    <input type="checkbox" wire:model = "insertTime" value = "recreo mañana" name="" id="4"><label for="4">recreo mañana <br></label>
                    <input type="checkbox" wire:model = "insertTime" value = "4º mañana" name="" id="5"><label for="5">4º hora mañana</label> 
                    <input type="checkbox" wire:model = "insertTime" value = "5º mañana" name="" id="6"><label for="6">5º hora mañana</label> <br>
                    <input type="checkbox" wire:model = "insertTime" value = "6º mañana" name="" id="7"><label for="7">6º hora mañana</label> 
                    <input type="checkbox" wire:model = "insertTime" value = "1º tarde" name="" id="8"><label for="8">1º hora tarde</label><br>
                    <input type="checkbox" wire:model = "insertTime" value = "2º tarde" name="" id="9"><label for="9">2º hora tarde</label>
                    <input type="checkbox" wire:model = "insertTime" value = "3º tarde" name="" id="10"><label for="10">3º hora tarde</label><br>
                    <input type="checkbox" wire:model = "insertTime" value = "recreo tarde" name="" id="11"><label for="11">recreo tarde </label>
                    <input type="checkbox" wire:model = "insertTime" value = "4º tarde" name="" id="12"><label for="12">4º hora tarde</label><br>
                    <input type="checkbox" wire:model = "insertTime" value = "5º tarde" name="" id="13"><label for="13">5º hora tarde</label>
                    <input type="checkbox" wire:model = "insertTime" value = "6º tarde" name="" id="14"><label for="14">6º hora tarde</label><br>
                    <label for="">Introduzca la razon de la falta: </label><br>
                    <textarea name="" id="" cols="30" rows="10" wire:model = "insertComment"></textarea><br>
                    <label for="">Seleccione el profesro de la falta</label>
                    <select name="" id="" wire:model = "idUserAbs">
                      <option selected value="">Elija una opcion</option>
                      @foreach($todosUser as $x)
                      <option value={{$x->id}}>{{$x->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="space-y-4">
                    <button class="p-3 bg-black rounded-full text-white w-full font-semibold" wire:click = "nuevaAusencia">Allow notifications</button>
                    <button class="p-3 bg-white border rounded-full w-full font-semibold" wire:click = "adiosModalAusencias">Cerrar ventana</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif

        @if($modal2)
<div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
  <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
    <div class="w-full">
      <div class="m-8 my-20 max-w-[400px] mx-auto">
        <div class="mb-8">
          <h1 class="mb-4 text-3xl font-extrabold">Turn on notifications</h1>
          <label for="">Introduzca la nueva razon: </label><br>
          <textarea name="" id="" cols="30" rows="10" wire:model = "editarComment"></textarea>
        </div>
        <div class="space-y-4">
          <button class="p-3 bg-black rounded-full text-white w-full font-semibold" wire:click = "actualizarAusencias">Actualizar</button>
          <button class="p-3 bg-white border rounded-full w-full font-semibold" wire:click = "adiosModalAct">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>
        @endif

    </div>
</div>

