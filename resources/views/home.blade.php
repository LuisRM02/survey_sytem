@extends('layouts.app')

@section('title', 'Página de Inicio')

@section('content')
    <h1>Sistema de Encuestas Anónimas</h1>
    <div class="mt-4">
        <a href="{{ route('vehicles.index') }}" class="btn btn-success">Ver Vehículos</a>
        <a href="{{ route('clients.index') }}" class="btn btn-primary">Ver Clientes</a>

        <a href="{{ route('vehicles.create') }}" class="btn btn-info">Agregar Vehículo</a>
        <a href="{{ route('clients.create') }}" class="btn btn-warning">Agregar Cliente</a>
        
    </div>
@endSection

