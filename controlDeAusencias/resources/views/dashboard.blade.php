<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @role('boss')
    <p>Esto es una prueba para el rol de jefe de estudios</p>
    @livewire("control-panel")
    @endrole
    @role('teacher')
    @livewire("show-absence")
    @endrole

</x-app-layout>
