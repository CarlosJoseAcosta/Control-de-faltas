<div>
    <div class = "mx-24 flex justify-items-center">
        <label for=""> Elija el departamento que desea buscar: </label>
        <input type="date" name="" id="" wire:model = "busquedaFech">
        </select>
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
    <div class="mx-24 flex justify-items-center">
        <button class="px-4 bg-gray-500 text-white mx-3" wire:click ="modalUsuario">Crear usuarios</button>
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
                </tr>
            @endforeach
            </tbody>
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
                        <input type="email" name="" id="" wire:modal = "email"><br>
                        <label for="">Introduzca el departamento que pertenezca el profesor/a</label><br>
                        <select name="" id="" wire:modal = "departament_id"><br>
                            @foreach($departamentos as $x)
                            <option value="{{$x->id}}">{{$x-> name}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="space-y-4">
                        <button class="p-3 bg-black rounded-full text-white w-full font-semibold">Allow notifications</button>
                        <button class="p-3 bg-white border rounded-full w-full font-semibold" wire:click = "adiosModalUsuario">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
        </table>

    </div>
</div>

