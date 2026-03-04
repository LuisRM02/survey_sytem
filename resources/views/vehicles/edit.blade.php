@extends('layouts.app')

@section('title', 'Editar Vehiculo')

@section('content')

<form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
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
    @method('PUT')
    <table>
        <tr>
            <th>Placa</th>
            <td><input type="text" name="plate" value="{{ $vehicle->plate }}" required></td>
        </tr>
        <tr>
            <th>Modelo</th>
            <td><input type="text" name="model" value="{{ $vehicle->model }}" required></td>
        </tr>
        <tr>
            <th>Año de Creación</th>
            <td><input type="number" name="manufacturing_year" value="{{ $vehicle->manufacturing_year }}" required></td>
        </tr>

        {{-- Hidden client_id --}}
        <tr>
            <td><input type="number" name="client_id" id="client_id" value="{{ $vehicle->client_id }}" hidden required></td>
        </tr>

        <tr>
            <th>Tipo de Documento</th>
            <td>
                <select name="client_document_type" id="client_document_type">
                    <option value="Dni" {{ $vehicle->client->document_type == 'Dni' ? 'selected' : '' }}>Dni</option>
                    <option value="Ruc" {{ $vehicle->client->document_type == 'Ruc' ? 'selected' : '' }}>Ruc</option>
                    <option value="Carnet de Extranjeria" {{ $vehicle->client->document_type == 'Carnet de Extranjeria' ? 'selected' : '' }}>Carnet de Extranjeria</option>
                </select>
            </td>
        </tr>

        <tr>
            <th>Nro de Documento</th>
            <td style="position: relative;">
                <input type="text" id="client_document_number" name="client_document_number"
                       value="{{ $vehicle->client->document_number }}" required autocomplete="off">
                <div id="suggestions" style="
                    position: absolute;
                    top: 0;
                    left: 105%;
                    width: 250px;
                    background: white;
                    border: 1px solid #ccc;
                    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                    max-height: 200px;
                    overflow-y: auto;
                    z-index: 1000;
                "></div>
            </td>
        </tr>

        <tr>
            <th>Nombres</th>
            <td><input type="text" id="client_first_name" name="client_first_name" value="{{ $vehicle->client->first_name }}" readonly required></td>
        </tr>
        <tr>
            <th>Apellidos</th>
            <td><input type="text" id="client_last_name" name="client_last_name" value="{{ $vehicle->client->last_name }}" readonly required></td>
        </tr>

        <tr>
            <th>Email</th>
            <td><input type="email" id="client_email" name="client_email" value="{{ $vehicle->client->email }}" readonly required></td>
        </tr>
        <tr>
            <th>Telefono</th>
            <td><input type="text" id="client_phone_number" name="client_phone_number" value="{{ $vehicle->client->phone_number }}" readonly required></td>
        </tr>
    </table>

    <button type="submit">Actualizar</button>
</form>

<br>
<button onclick="window.location.href='{{ route('vehicles.index') }}'">Salir</button>

@endsection

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
                        window.location.href = url;
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