<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;

class VehicleController extends Controller
{
    public function index(){
        $vehicles = Vehicle::orderBy('id', 'desc')->with('client')->paginate(10);
        return view('vehicles.index', compact('vehicles'));
    }

    public function create(){
        return view('vehicles.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'plate' => 'required|string|max:6|unique:vehicles,plate',
            'model' => 'required|string|max:140',
            'manufacturing_year' => 'required|digits:4|integer|min:1901|max:' . date('Y'),
            'client_id' => 'required|integer|exists:clients,id',
        ]);

        Vehicle::create($validated);
        return redirect()->route('vehicles.index')->with('success', 'vehiculo registrado correctamente');
    }

    public function edit($id){
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'plate' => 'required|string|max:6|unique:vehicles,plate',
            'model' => 'required|string|max:140',
            'manufacturing_year' => 'required|digits:4|integer|min:1901|max:' . date('Y'),
            'client_id' => 'required|integer|exists:clients,id',
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($validated);
        
        return redirect()->route('vehicles.index')->with('success', 'vehiculo actualizado correctamente');
    }


    public function destroy($id){
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return Redirect()->route('vehicles.index')->with('success', 'vehiculo eliminado correctamente');
    }
}
