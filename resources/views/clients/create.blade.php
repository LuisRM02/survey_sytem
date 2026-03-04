@extends('layouts.app')

@section('title', 'Registrar un cliente')

@section('content')

<form action="{{ route('clients.store') }}" method="POST">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @csrf
    <table>
    <tr>
    <th>Tipo de Documento</th>
    <td>
        <select name="document_type">
            <option value="Dni" {{ old('document_type') == 'Dni' ? 'selected' : '' }}>Dni</option>
            <option value="Ruc" {{ old('document_type') == 'Ruc' ? 'selected' : '' }}>Ruc</option>
            <option value="Carnet de Extranjeria" {{ old('document_type') == 'Carnet de Extranjeria' ? 'selected' : '' }}>Carnet de Extranjeria</option>
        </select>
    </td>
    </tr>
    <tr>
        <th>Nro de Documento</th>
        <td><input type="text" name="document_number" value="{{ old('document_number') }}" required></td>
    </tr>
    <tr>
        <th>Nombres</th>
        <td><input type="text" name="first_name" value="{{ old('first_name') }}" required></td>
    </tr>
    <tr>
        <th>Apellidos</th>
        <td><input type="text" name="last_name" value="{{ old('last_name') }}" required></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><input type="email" name="email" value="{{ old('email') }}" required></td>
    </tr>
    <tr>
        <th>Telefono</th>
        <td><input type="text" name="phone_number" value="{{ old('phone_number') }}" required></td>
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