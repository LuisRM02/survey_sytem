@extends('layouts.app')

@section('title', 'Registrar un vehiculo')

@section('content')

<form action="{{ route('vehicles.store') }}" method="POST">
    @csrf
    <table>
        <tr>
            <th>Placa</th>
            <td><input type="text" name="plate" required></td>
        </tr>
        <tr>
            <th>Model</th>
            <td><input type="text" name="model" required></td>
        </tr>
        <tr>
            <th>Año de Creación</th>
            <td><input type="number" name="manufacturing_year" required></td>
        </tr>
        <tr>
            <th>Cliente</th>
            <td><input type="number" name="client_id" required></td>
        </tr>
    </table>

    <button type="submit">Guardar</button>
    <button type="reset">Limpiar</button>
    
</form>

<button
        onclick="window.location.href='{{ route('vehicles.index') }}'"
>
    Salir
</button>

@endSection