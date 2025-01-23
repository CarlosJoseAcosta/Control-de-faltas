<div>
    <div class = "mx-24 flex justify-items-center">
        <label for=""> Elija el departamento que desea buscar: </label>
        <select name="" id="">
            @foreach($ausencias as $x)
            <option value="{{ $x->departamento }}">{{ $x->departamento }}</option>
            @endforeach
        </select>
        <label for=""> o elije la hora que quiere filtrar:</label>
        <select name="" id="">
            @foreach($ausencias as $x)
            <option value="{{ $x->hora }}">{{ $x->hora }}</option>
            @endforeach
        </select>
    </div>
    <div class="mx-24 flex justify-items-center">
        <table class="text-left table-auto min-w-full">
            <thead class="bg-black text-white py-4">
                <tr class = "flex w-full mb-4">
                    <td class="p-4 w-1/4">Profesor</td>
                    <td class="p-4 w-1/4">Departamento</td>
                    <td class="p-4 w-1/4">Hora</td>
                    <td class="p-4 w-1/4">Motivo</td>
                </tr>
            </thead>
            <tbody class="bg-gray-400" >
            @foreach($ausencias as $x)
                <tr class="flex w-full mb-4 bg-grey">
                    <td class="p-4 w-1/4">{{ $x->profesor }}</td>
                    <td class="p-4 w-1/4">{{ $x->departamento }}</td>
                    <td class="p-4 w-1/4">{{ $x->hora }}</td>
                    <td class="p-4 w-1/4">{{ $x->comentario }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>

