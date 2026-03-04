<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;


class ClientController extends Controller
{
    public function index(){
        //$objClient = new Client();
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function show(){
        return "hey hey, mas despacio";
    }

    public function create(){
        return view('clients.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'document_type' => 'required|in:Dni,Ruc,Carnet de Extranjeria',
            'document_number' => 'required|regex:/^[A-Za-z0-9]{8,12}$/',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:140',
            'phone_number' => 'required|regex:/^[0-9]{6,9}$/',
        ]);

        Client::create($validated);
        return redirect()->route('clients.index');
        //echo "ya recibi los datos";
    }

    public function edit($id){
       $client = Client::findOrFail($id);
       return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id){
        $client = Client::findOrFail($id);
        //$client->update($request->all());
        return redirect()->route('clients.index');
    }

    public function destroy($id){
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index');
    }
}
