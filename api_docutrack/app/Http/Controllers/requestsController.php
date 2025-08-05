<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\requests;
use App\Models\requests_status;
use Illuminate\Support\Facades\DB;

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

    public function listrequests(Request $request){

        $data = $request->only('userid', 'from', 'to');

        $list = DB::table('requests')
            ->join('requests_status', 'requests.status', '=', 'requests_status.status')
            ->select('requests.id', 'requests.nombre', 'requests.apellido', 'requests.cedula', 'requests.status', 'requests.file_route', 'requests.created_at', 'requests_status.progress', 'requests.emitido', 'requests.comment')
            ->where('requests.userid', $data['userid'])
            //para implementar paginación
            //->skip($data['from'])
            //->take($data['to'])
            ->get();

            if($list->count() == 0){
                return response()->json([
                    "rows" => 0
                ]);
            }
        return response()->json([
            "rows" => $list
        ]);

    }

    public function listrequestsAdmin(){
        $list = DB::table('requests')
        ->join('requests_status', 'requests.status', '=', 'requests_status.status')
        ->select('requests.id', 'requests.nombre', 'requests.apellido', 'requests.cedula', 'requests.status', 'requests.file_route', 'requests.created_at', 'requests_status.progress', 'requests.emitido')
        ->where('requests.status', 'Recibido')
        ->orWhere('requests.status', 'En Validacion')
        ->orWhere('requests.status', 'Corregido')
        ->get();

        if($list->count() == 0){
            return response()->json([
                "rows" => $list
            ]);
        }

        return response()->json([
            "rows" => $list
        ]);
    }

    public function updateStatus(Request $request){

        $request->validate([
            'id' => 'required|integer|min:1|max:50',
            'status' => 'required|string|max:15',
        ]);

        $data = $request->only('id', 'status', 'comment');

        $update = requests::where('id', $data['id'])->update([
            'status' => $data['status'],
        ]);

        if($update === 0){
            return response()->json([
                "rows" => 0
            ]);
        }

        return response()->json([
            "rows" => 1
        ]);
    }

    public function updateStatusComment(Request $request){

        if(isset($request->comment)){
            $falg = true;
        }else{
            $falg = false;
        }

        if($falg){
            $request->validate([
                'id' => 'required|integer|min:1|max:50',
                'status' => 'required|string|max:15',
                'comment' => 'required|string|max:255',
            ]);

            $data = $request->only('id', 'status', 'comment');
        }else{
            $request->validate([
                'id' => 'required|integer|min:1|max:50',
                'status' => 'required|string|max:15',
            ]);

            $data = $request->only('id', 'status');
        }


        if($falg){
            $update = requests::where('id', $data['id'])->update([
                'status' => $data['status'],
                'comment' => $data['comment']
            ]);
        }else{
            if($data['status'] === 'Emitido'){
                $update = requests::where('id', $data['id'])->update([
                    'status' => $data['status'],
                    'emitido' => now()
                ]);
            }else{
                $update = requests::where('id', $data['id'])->update([
                    'status' => $data['status'],
                ]);
            }
        }

        if($update === 0){
            return response()->json([
                "rows" => 0
            ]);
        }

        return response()->json([
            "rows" => 1
        ]);
    }


    public function searchrequest(Request $request){
        $request->validate([
            'id' => 'required|integer|min:1|max:50'
        ]);

        $data = \App\Models\requests::where('id', $request->id)->first();

        return response()->json([
            "rows" => $data
        ]);
    }



    public function editrequest(Request $request){
        $request->validate([
            'id' => 'required|integer|min:1|max:50',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'status' => 'required|string|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $file = $request->file('image');
        $filename = uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path('imgs'), $filename);

        $update = requests::where('id', $request->id)->update([
            'status' => $request->status,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'file_route' => $filename
        ]);

        if($update === 0){
            return response()->json([
                "rows" => 0
            ]);
        }

        return response()->json([
            "rows" => 1
        ]);


    }




}
