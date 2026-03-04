@extends('layouts.app')

@section('title', 'Registrar un vehiculo')

@section('content')

<form action="{{ route('vehicles.store') }}" method="POST">
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
            <th>Placa</th>
            <td><input type="text" name="plate" value="{{ old('plate') }}" required></td>
        </tr>
        <tr>
            <th>Model</th>
            <td><input type="text" name="model" value="{{ old('model') }}" required></td>
        </tr>
        <tr>
            <th>Año de Creación</th>
            <td><input type="number" name="manufacturing_year" value="{{ old('manufacturing_year') }}" required></td>
        </tr>
        <tr>
            <td><input type="number" name="client_id" id="client_id" value="{{ old('client_id') }}" required hidden></td>
        </tr>
        
        <tr>
        <th>Tipo de Documento</th>
        <th>
            <select name="client_document_type" id="client_document_type">
                <option value="Dni" {{ old('client_document_type') == 'Dni' ? 'selected' : '' }}>Dni</option>
                <option value="Ruc" {{ old('client_document_type') == 'Ruc' ? 'selected' : '' }}>Ruc</option>
                <option value="Carnet de Extranjeria" {{ old('client_document_type') == 'Carnet de Extranjeria' ? 'selected' : '' }}>Carnet de Extranjeria</option>
            </select>
        </th>
        </tr>
        <tr>
            <th>Nro de Documento</th>
            <td>
                <input type="text" id="client_document_number" name="client_document_number" required autocomplete="off" value="{{ old('client_document_number') }}">
                <div id="suggestions" style="border:1px solid #ccc;"></div>
            </td>
        </tr>
        <tr>
            <th>Nombres</th>
            <td><input type="text" id="client_first_name" name="client_first_name" readonly required value="{{ old('client_first_name') }}"></td>
        </tr>
        <tr>
            <th>Apellidos</th>
            <td><input type="text" id="client_last_name" name="client_last_name" readonly required value="{{ old('client_last_name') }}"></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><input type="email" id="client_email" name="client_email" readonly required value="{{ old('client_email') }}"></td>
        </tr>
        <tr>
            <th>Telefono</th>
            <td><input type="text" id="client_phone_number" name="client_phone_number" readonly required value="{{ old('client_phone_number') }}"></td>
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


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    let input = document.getElementById('client_document_number');
    let suggestions = document.getElementById('suggestions');

    input.addEventListener('keyup', function () {

        let documentNumber = this.value.trim();
        let documentType = document.getElementById('client_document_type').value;

        if (documentNumber.length < 2) {
            suggestions.innerHTML = '';
            return;
        }

        fetch(`/clients/search?document_type=${documentType}&document_number=${documentNumber}`)
            .then(response => response.json())
            .then(data => {

                suggestions.innerHTML = '';

                if (data.length === 0) {
                    
                    let div = document.createElement('div');
                    div.textContent = "Cliente no encontrado, registrar cliente";
                    div.style.padding = "5px";
                    div.style.cursor = "pointer";
                    div.style.backgroundColor = "#f8d7da";
                    div.style.color = "#721c24";
                    div.style.border = "1px solid #f5c6cb";
                    div.onclick = function () {
                        
                        let url = `/clients/create?document_type=${documentType}&document_number=${documentNumber}`;
                        window.open(url, '_blank');
                    };
                    suggestions.appendChild(div);
                    return;
                }

                data.forEach(client => {
                    let div = document.createElement('div');
                    div.textContent = client.document_number + ' - ' + client.first_name + ' ' + client.last_name;
                    div.style.padding = "5px";
                    div.style.cursor = "pointer";
                    div.style.borderBottom = "1px solid #eee";

                    div.onclick = function () {
                        document.getElementById('client_id').value = client.id;
                        document.getElementById('client_document_number').value = client.document_number;
                        document.getElementById('client_first_name').value = client.first_name;
                        document.getElementById('client_last_name').value = client.last_name;
                        document.getElementById('client_email').value = client.email;
                        document.getElementById('client_phone_number').value = client.phone_number;

                        suggestions.innerHTML = '';
                    };

                    suggestions.appendChild(div);
                });

            })
            .catch(error => console.error('Error:', error));
    });

});
</script>
@endpush