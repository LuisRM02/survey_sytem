@extends('layouts.app')

@section('title', 'Registrar un cliente')

@section('content')

<form action="{{ route('clients.store') }}" method="POST">
    @csrf
    <table>
        <tr>
            <th>Tipo de Documento</th>
            <td>
                <select name="document_type">
                    <option selected>Dni</option>
                    <option>Ruc</option>
                    <option>Carnet de Extranjeria</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Nro de Documento</th>
            <td><input type="text" name="document_number" required></td>
        </tr>
        <tr>
            <th>Nombres</th>
            <td><input type="text" name="first_name" required></td>
        </tr>
        <tr>
            <th>Apellidos</th>
            <td><input type="text" name="last_name" required></td>
        </tr>
        
        <tr>
            <th>Email</th>
            <td><input type="email" name="email" required></td>
        </tr>
        <tr>
            <th>Telefono</th>
            <td><input type="text" name="phone_number" required></td>
        </tr>
    </table>

    <button type="submit">Guardar</button>
    <button type="reset">Limpiar</button>
    
</form>

<button
        onclick="window.location.href='{{ route('clients.index') }}'"
>
    Salir
</button>

@endSection