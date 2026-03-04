@extends('layouts.app')

@section('title', 'Lista de Clientes')

@section('content')

<h1>Lista de clientes</h1>
<button
    onclick="window.location.href=`clients/create`"
>
    Nuevo Cliente
</button>
<table>
    <tr>
        <th>Nro. Identidad</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>
    @foreach ($clients as $client)
        <tr>
            <td>{{ $client->document_number }}</td>
            <td>{{ $client->first_name }}</td>
            <td>{{ $client->last_name }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->phone_number }}</td>
            <td> 
                <button 
                    onclick="window.location.href='{{ route('clients.edit', $client->id) }}'"
                >
                    Editar
                </button>
                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" 
                    onsubmit="return confirm('¿Estas seguro de eliminar a {{ $client->first_name }} - {{ $client->document_number }}?')">
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


@endSection