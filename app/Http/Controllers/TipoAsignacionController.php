<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoAsignacionRequest;
use App\Http\Requests\UpdateTipoAsignacionRequest;
use App\Models\TipoAsignacion;
use App\Providers\LogUserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TipoAsignacionController extends Controller
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

        $tiposAsignacion = DB::table('tipo_asignacions')
            ->select('id','tipo','descripcion')
            ->where('tipo','LIKE','%'.$search.'%')
            ->orWhere('descripcion','LIKE','%'.$search.'%')
            ->orderBy('tipo','asc')
            ->paginate(10)
            ->withQueryString()
        ;

        if(isset($radioButton)){

            switch ($radioButton){

                case "tipo":
                    $tiposAsignacion = DB::table('tipo_asignacions')
                        ->select('id','tipo','descripcion')
                        ->where('tipo','LIKE','%'.$search.'%')
                        ->orderBy('tipo', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                    ;
                    break;

                case "descripcion":
                    $tiposAsignacion = DB::table('tipo_asignacions')
                        ->select('id','tipo','descripcion')
                        ->where('descripcion','LIKE','%'.$search.'%')
                        ->orderBy('descripcion', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                    ;
                    break;

                default:
                    $tiposAsignacion = DB::table('tipo_asignacions')
                        ->select('id','tipo','descripcion')
                        ->where('tipo','LIKE','%'.$search.'%')
                        ->orWhere('descripcion','LIKE','%'.$search.'%')
                        ->orderBy('tipo','asc')
                        ->paginate(10)
                        ->withQueryString()
                    ;
            }

        }

        return view('tipoAsignacion.index', compact('tiposAsignacion','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipoAsignacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipoAsignacionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoAsignacionRequest $request)
    {

        $tiposAsignacion = new TipoAsignacion();
        $tiposAsignacion->tipo = $request->tipo;
        $tiposAsignacion->descripcion = $request->descripcion;

        $tiposAsignacion->save();

        $user = Auth::user();
        $data = $request->id ." ". $request->tipo ." ". $request->descripcion;
        event(new LogUserActivity($user,"Creación de Tipo de Asignación",$data));

        return redirect()->route('tipoAsignacion.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoAsignacion  $tipoAsignacion
     * @return \Illuminate\Http\Response
     */
    public function show(TipoAsignacion $tipoAsignacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoAsignacion  $tipoAsignacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tiposAsignacion = TipoAsignacion::where('id',$id)->firstOrFail();
        return view('tipoAsignacion.edit', compact('tiposAsignacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoAsignacionRequest  $request
     * @param  \App\Models\TipoAsignacion  $tipoAsignacion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoAsignacionRequest $request, $id)
    {
        $tiposAsignacion = TipoAsignacion::where('id',$id)->firstOrFail();
        $tipo = $request->tipo;
        $descripcion = $request->descripcion;

        $tiposAsignacion->update([
            'tipo' => $tipo,
            'descripcion' => $descripcion,
        ]);

        $user = Auth::user();
        $data = $request->id ." ". $request->tipo ." ". $request->descripcion;
        event(new LogUserActivity($user,"Actualización de Tipo de Asignación ID: $request->id",$data));

        return redirect()->route('tipoAsignacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoAsignacion  $tipoAsignacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tiposAsignacion = TipoAsignacion::where('id',$id)->firstOrFail();
        $tiposAsignacion->delete($id);

        $user = Auth::user();
        //$data = $request->nPersonal ." ". $request->nombre ." ". $request->apellidoPaterno ." ". $request->apellidoMaterno ." ".$request->email;
        $data = "Eliminación de Docente ID: $id";
        event(new LogUserActivity($user,"Eliminación de Tipo de Asignación ID $id",$data));

        return redirect()->route('tipoAsignacion.index');
    }

}
