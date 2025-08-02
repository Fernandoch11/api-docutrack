<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\requests;
use App\Models\requests_status;

class requestsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function createrequest(Request $request){

        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:255',
        ]);

        $file = $request->file('image');
        $filename = uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path('imgs'), $filename);

        $status = \App\Models\requests_status::where('default', 'Y')->first();
        
        $sol = requests::create([
            'userid' =>$request->userid,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'emitido' => '1970-01-01',
            'status' => $status->status,
            'file_route' => $filename
        ]);


        
        return response()->json([
            "id" => $sol->id
        ]);
        
    }
    
}
