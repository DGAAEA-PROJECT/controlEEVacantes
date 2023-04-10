<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use App\Providers\LogUserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreZonaRequest;
use App\Http\Requests\UpdateZonaRequest;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search'));

        $zonas = DB::table('zonas')
            ->select('id','nombre')
            ->where('nombre','LIKE','%'.$search.'%')
            ->orderBy('nombre','asc')
            ->paginate('10')
            ->withQueryString()
            ;

        return view('zona.index', compact('zonas','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zona.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreZonaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreZonaRequest $request)
    {
        $zona = new Zona();
        $zona->nombre = $request->nombre;

        $zona->save();

        $user = Auth::user();
        $data = $request->id ." ". $request->nombre;
        event(new LogUserActivity($user,"Creación de Zona",$data));

        return redirect()->route('zona.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function show(Zona $zona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $zona = Zona::where('id',$id)->firstOrFail();
        return view('zona.edit', compact('zona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateZonaRequest  $request
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateZonaRequest $request, $id)
    {
        //
        $zona = Zona::where('id',$id)->firstOrFail();
        $nombre = $request->nombre;

        $zona->update([
            'nombre' => $nombre,
        ]);

        $user = Auth::user();
        $data = $request->id ." ". $request->nombre;
        event(new LogUserActivity($user,"Actualización de la Zona ID: $request->id",$data));

        return redirect()->route('zona.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zonaEliminarPrograma = DB::table('zona__dependencia__programas')->where("id_zona",$id)->delete();
        $zonaEliminarDependencia = DB::table('zona__dependencias')->where('id_zona',$id)->delete();

        $zona = Zona::where('id',$id)->firstOrFail();
        $zona->delete($id);

        $user = Auth::user();
        $data = "Eliminación de la Zona ID: $id";
        event(new LogUserActivity($user,"Eliminación de la Zona ID $id",$data));

        return redirect()->route('zona.index');
    }
    public static function listaZona()
    {
        $listaZonas = Zona::all();
        return $listaZonas;
    }
}
