<?php

namespace App\Http\Controllers;

use App\Models\Motivo;
use App\Http\Requests\StoreMotivoRequest;
use App\Http\Requests\UpdateMotivoRequest;
use App\Providers\LogUserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MotivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search'));
        $radioButton = $request->get('tipo');

        $motivos = DB::table('motivos')
            ->select('id','numeroMotivo','nombre','concepto')
            ->where('numeroMotivo','LIKE','%'.$search.'%')
            ->orWhere('nombre','LIKE','%'.$search.'%')
            ->orWhere('concepto','LIKE','%'.$search.'%')
            ->orderBy('numeroMotivo','asc')
            ->paginate(10)
            ->withQueryString()
            ;

        if(isset($radioButton)){

            switch ($radioButton){

                case "numeroMotivo":
                    $motivos = DB::table('motivos')
                        ->select('id','numeroMotivo','nombre','concepto')
                        ->where('numeroMotivo','LIKE','%'.$search.'%')
                        ->orderBy('numeroMotivo', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
                    break;

                case "nombre":
                    $motivos = DB::table('motivos')
                        ->select('id','numeroMotivo','nombre','concepto')
                        ->where('nombre','LIKE','%'.$search.'%')
                        ->orderBy('nombre', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
                    break;

                case "concepto":
                    $motivos = DB::table('motivos')
                        ->select('id','numeroMotivo','nombre','concepto')
                        ->where('concepto','LIKE','%'.$search.'%')
                        ->orderBy('concepto', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
                    break;

                default:
                    $motivos = DB::table('motivos')
                        ->select('id','numeroMotivo','nombre','concepto')
                        ->where('numeroMotivo','LIKE','%'.$search.'%')
                        ->orWhere('nombre','LIKE','%'.$search.'%')
                        ->orWhere('concepto','LIKE','%'.$search.'%')
                        ->orderBy('numeroMotivo','asc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
            }

        }

        return view('motivo.index', compact('motivos','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('motivo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMotivoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMotivoRequest $request)
    {
        $motivo = new Motivo();
        $motivo->numeroMotivo = $request->numeroMotivo;
        $motivo->nombre = $request->nombre;
        $motivo->concepto = $request->concepto;

        $motivo->save();

        $user = Auth::user();
        $data = $request->numeroMotivo ." ". $request->nombre ." ". $request->concepto;
        event(new LogUserActivity($user,"Creación de Motivo",$data));

        return redirect()->route('motivo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function show(Motivo $motivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $motivo = Motivo::where('id',$id)->firstOrFail();
        return view('motivo.edit', compact('motivo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMotivoRequest  $request
     * @param  \App\Models\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMotivoRequest $request, $id)
    {
        //
        $motivo = Motivo::where('id',$id)->firstOrFail();
        $numeroMotivo = $request->numeroMotivo;
        $nombre = $request->nombre;
        $concepto = $request->concepto;

        $motivo->update([
            'numeroMotivo' => $numeroMotivo,
            'nombre' => $nombre,
            'concepto' => $concepto,
        ]);

        $user = Auth::user();
        $data = $request->numeroMotivo ." ". $request->nombre ." ". $request->concepto;
        event(new LogUserActivity($user,"Actualización del Motivo ID: $request->id",$data));

        return redirect()->route('motivo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $motivo = Motivo::where('id',$id)->firstOrFail();
        $motivo->delete($id);

        $user = Auth::user();
        $data = "Eliminación del Motivo N°: $id";
        event(new LogUserActivity($user,"Eliminación del Motivo ID $id",$data));

        return redirect()->route('motivo.index');
    }
}
