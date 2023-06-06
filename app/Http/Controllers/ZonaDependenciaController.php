<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZonaDependenciaRequest;
use App\Http\Requests\UpdateZonaDependenciaRequest;
use App\Models\Dependencia;
use App\Models\Periodo;
use App\Models\Vacante;
use Illuminate\Http\Request;
use App\Models\Zona_Dependencia;
use App\Models\Zona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Providers\LogUserActivity;
use Barryvdh\DomPDF\Facade\Pdf;


class ZonaDependenciaController extends Controller
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

        //https://youtu.be/XeYd_kYkUJE
        $dependencias = DB::table('zona__dependencias')
            ->select('id','id_zona','nombre_zona','clave_dependencia','nombre_dependencia')
            ->where('id_zona','LIKE','%'.$search.'%')
            ->orWhere('nombre_zona','LIKE','%'.$search.'%')
            ->orWhere('clave_dependencia','LIKE','%'.$search.'%')
            ->orWhere('nombre_dependencia','LIKE','%'.$search.'%')
            ->orderBy('id_zona','asc')
            ->paginate(10)
            ->withQueryString()
            ;

        if(isset($radioButton)){

            switch ($radioButton){

                case "numeroZona":
                    $dependencias = DB::table('zona__dependencias')
                        ->select('id','id_zona','nombre_zona','clave_dependencia','nombre_dependencia')
                        ->where('id_zona','LIKE','%'.$search.'%')
                        ->orderBy('id_zona', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
                    break;

                case "nombreZona":
                    $dependencias = DB::table('zona__dependencias')
                        ->select('id','id_zona','nombre_zona','clave_dependencia','nombre_dependencia')
                        ->where('nombre_zona','LIKE','%'.$search.'%')
                        ->orderBy('nombre_zona', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
                    break;

                case "claveDependencia":
                    $dependencias = DB::table('zona__dependencias')
                        ->select('id','id_zona','nombre_zona','clave_dependencia','nombre_dependencia')
                        ->where('clave_dependencia','LIKE','%'.$search.'%')
                        ->orderBy('clave_dependencia', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
                    break;

                case "nombreDependencia":
                    $dependencias = DB::table('zona__dependencias')
                        ->select('id','id_zona','nombre_zona','clave_dependencia','nombre_dependencia')
                        ->where('nombre_dependencia','LIKE','%'.$search.'%')
                        ->orderBy('nombre_dependencia', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
                    break;

                default:
                    $dependencias = DB::table('zona__dependencias')
                        ->select('id','id_zona','nombre_zona','clave_dependencia','nombre_dependencia')
                        ->where('id_zona','LIKE','%'.$search.'%')
                        ->orWhere('nombre_zona','LIKE','%'.$search.'%')
                        ->orWhere('clave_dependencia','LIKE','%'.$search.'%')
                        ->orWhere('nombre_dependencia','LIKE','%'.$search.'%')
                        ->orderBy('id_zona','asc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
            }

        }

        return view('zonaDependencia.index', compact('dependencias','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listaZonas = Zona::all();

        $user = auth()->user();

        return view('zonaDependencia.create',
            [
            'user' => $user,
            'zonas' => $listaZonas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreZonaDependenciaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreZonaDependenciaRequest $request)
    {
        $dependencia = new Zona_Dependencia();

        $zonaCompleta = $request->id_zona;
        $zonaPartes = explode("~",$zonaCompleta);

        $dependencia->id_zona = $zonaPartes[0];
        $dependencia->nombre_zona = $zonaPartes[1];
        $dependencia->clave_dependencia = $request->claveDependencia;
        $dependencia->nombre_dependencia = $request->nombreDependencia;

        //dd($dependencia);

        $dependencia->save();

        $user = Auth::user();
        $data = $request->idZona ." ". $request->nombreZona ." ". $request->claveDependencia ." ". $request->nombreDependencia;
        event(new LogUserActivity($user,"Creación de Dependencia",$data));

        return redirect()->route('zonaDependencia.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zona_Dependencia  $dependencia
     * @return \Illuminate\Http\Response
     */
    public function show(Zona_Dependencia $dependencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zona_Dependencia  $dependencia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtener nombre de la zona
        $nombreZona = Zona_Dependencia::where('id',$id)->value('nombre_zona');


        $dependencia = Zona_Dependencia::where('id',$id)->firstOrFail();
        $listaZonas = Zona::all();
        return view('zonaDependencia.edit', ['dependencia' => $dependencia,
                                                  'zonas' => $listaZonas,
                                                  'nombreZona' => $nombreZona
                                                ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateZonaDependenciaRequest  $request
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateZonaDependenciaRequest $request, $id)
    {
        $dependencia = Zona_Dependencia::findOrFail($id);

        $zonaCompleta = $request->id_zona;
        $zonaPartes = explode("~",$zonaCompleta);

        $id_zona = $zonaPartes[0];
        $nombre_zona = $zonaPartes[1];

        $clave_dependencia=$request->claveDependencia;
        $nombre_dependencia=$request->nombreDependencia;

        $dependencia->update([
            'id_zona' => $id_zona ,
            'nombre_zona' => $nombre_zona ,
            'clave_dependencia' => $clave_dependencia ,
            'nombre_dependencia' => $nombre_dependencia ,
        ]);

        $user = Auth::user();
        $data = $request->id_zona ." ". $request->nombre_zona ." ". $request->clave_dependencia . " ". $request->nombre_dependencia;
        event(new LogUserActivity($user,"Actualización de la Dependencia Clave: $request->clave_dependencia",$data));

        return redirect()->route('zonaDependencia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $claveDependenciaSeleccionada = Zona_Dependencia::where('id',$id)->value('clave_dependencia');
        $dependenciaEliminarPrograma = DB::table('zona__dependencia__programas')->where("clave_dependencia",$claveDependenciaSeleccionada)->delete();

        $dependencia = Zona_Dependencia::findOrFail($id);
        $dependencia->delete();

        $user = Auth::user();
        $data = "Eliminación de Dependencia ID: $id";
        event(new LogUserActivity($user,"Eliminación de Dependencia ID: $id",$data));

        return redirect()->route('zonaDependencia.index');
    }
    //

    public function fetchDependencia(Request $request)
    {
        $data['dependencias'] = Zona_Dependencia::where("id_zona", $request->id_zona)
                                ->get(["clave_dependencia","nombre_dependencia"]);

        return response()->json($data);
    }

    public function fetchIdNombreZona(Request $request)
    {
        $data['idNombreZona'] = Zona::where("id", $request->idZona)
            ->get(["id","nombre"]);

        return response()->json($data);
    }

    public function reporte($id)
    {
        $path = base_path('public/images/uv.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $uv = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $periodoActual = Periodo::where('actual','1')->value('clavePeriodo');

        $listaVacantes = Vacante::where('numDependencia',$id)
            ->where(function ($query) use ($periodoActual){
            $query->whereNull('deleted_at')
                ->where('clavePeriodo',$periodoActual);
        })
            ->where(function ($query) {
                //$query->whereNull('numPersonalDocente');
                $query->where('nombreDocente','');
            })
            ->get();

        $dependencia = Zona_Dependencia::where('clave_dependencia',$id)->value('nombre_dependencia');

        $pdf = Pdf::loadView('pdf.templateVacantesPorDependencia', compact(
                'listaVacantes','dependencia', 'uv')
        )->setPaper('a4','landscape');

        $user = Auth::user();
        $data = "Generación de Reporte de Experiencias Vacantes de la dependencia: $id";
        event(new LogUserActivity($user,"Generación de Reporte de Experiencias Educativas",$data));
        return $pdf->stream();

    }

}
