@extends('layouts.app')

@section('title', 'Lista de Vehiculos')

@section('content')
<h1>Lista de Vehiculos</h1>
@if(session('success'))
    <div style="padding:10px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
@endif

<button
    onclick="window.location.href='{{ route('vehicles.create') }}'"
>
    Nuevo Vehiculo
</button>

<table>
    <tr>
        <th>Placa</th>
        <th>Modelo</th>
        <th>Año</th>
        <th>Cliente</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Acciones</th>
    </tr>
    @foreach ($vehicles as $vehicle)
        <tr>
            <td>{{ $vehicle->plate }}</td>
            <td>{{ $vehicle->model }}</td>
            <td>{{ $vehicle->manufacturing_year }}</td>
            <td>{{ $vehicle->client->document_number }}</td>
            <td>{{ $vehicle->client->first_name }}</td>
            <td>{{ $vehicle->client->last_name }}</td>
            <td> 
                <button 
                    onclick="window.location.href='{{ route('vehicles.edit', $vehicle->id) }}'"
                >
                    Editar
                </button>
                <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" 
                    onsubmit="return confirm('¿Estas seguro de eliminar a {{ $vehicle->palte }} - {{ $vehicle->model }}?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

{{ $vehicles->links('pagination::simple-bootstrap-4') }}

@endSection