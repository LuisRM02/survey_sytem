@extends('layouts.app')

@section('title', 'Registrar un cliente')

@section('content')
<form action="{{ route('clients.update', $client->id) }}" method="POST">
    @csrf
    @method('PUT')
    <table>
        <tr>
            <th>Tipo de Documento</th>
            <td>
                <select name="document_type">
                    <option {{ $client->document_type == 'Dni' ? 'selected' : '' }}>Dni</option>
                    <option {{ $client->document_type == 'Ruc' ? 'selected' : '' }}>Ruc</option>
                    <option {{ $client->document_type == 'Carnet de Extranjeria' ? 'selected' : '' }}>Carnet de Extranjeria</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Nro de Documento</th>
            <td><input type="text" name="document_number" value="{{ $client->document_number }}" required></td>
        </tr>
        <tr>
            <th>Nombres</th>
            <td><input type="text" name="first_name" value="{{ $client->first_name }}" required></td>
        </tr>
        <tr>
            <th>Apellidos</th>
            <td><input type="text" name="last_name" value="{{ $client->last_name }}" required></td>
        </tr>
        
        <tr>
            <th>Email</th>
            <td><input type="email" name="email" value="{{ $client->email }}" required></td>
        </tr>
        <tr>
            <th>Telefono</th>
            <td><input type="text" name="phone_number" value="{{ $client->phone_number }}" required></td>
        </tr>
    </table>

    <button type="submit">Actualizar</button>
    
</form>

<button 
    onclick="window.location.href='{{ route('clients.index') }}'"
>
        Salir
</button>

@endSection