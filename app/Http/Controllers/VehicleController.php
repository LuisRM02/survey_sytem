<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use GuzzleHttp\Client;

class VehicleController extends Controller
{
    public function index(){
        $vehicles = Vehicle::with('client')->paginate(2);
        return view('vehicles.index', compact('vehicles'));
    }

    public function create(){
        return view('vehicles.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'plate' => 'required|string|max:6',
            'model' => 'required|string|max:140',
            'manufacturing_year' => 'required|digits:4|integer',
            'client_id' => 'required|integer|exists:clients,id',
        ]);

        Vehicle::create($validated);
        return redirect()->route('vehicles.index')->with('success', 'vehiculo registrado correctamente');
    }
}
