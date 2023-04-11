<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\UpdateDocenteRequest;
use App\Providers\LogUserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     * Función usada para mostrar los docentes y su respectiva información
     * Usada en la vista docente.index
     * @see resources/views/docente/index.blade.php
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search'));
        $radioButton = $request->get('tipo');

        //https://youtu.be/XeYd_kYkUJE

        $docentes = DB::table('docentes')
            ->select('id','nPersonal','nombre','apellidoPaterno','apellidoMaterno','email')
            ->where('nPersonal','LIKE','%'.$search.'%')
            ->orWhere('nombre','LIKE','%'.$search.'%')
            ->orWhere('apellidoPaterno','LIKE','%'.$search.'%')
            ->orWhere('apellidoMaterno','LIKE','%'.$search.'%')
            ->orWhere('email','LIKE','%'.$search.'%')
            ->orderBy('apellidoPaterno','asc')
            ->paginate('10')
            ->withQueryString()
            ;
        if(isset($radioButton)){

            switch ($radioButton){

                case "numPersonal":
                    $docentes = DB::table('docentes')
                        ->select('id','nPersonal','nombre','apellidoPaterno','apellidoMaterno','email')
                        ->where('nPersonal','LIKE','%'.$search.'%')
                        ->orderBy('nPersonal', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                        ;

                break;

                case "nombre":
                    $docentes = DB::table('docentes')
                        ->select('id','nPersonal','nombre','apellidoPaterno','apellidoMaterno','email')
                        ->where('nombre','LIKE','%'.$search.'%')
                        ->orderBy('nombre', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                       ;

                break;

                case "apellidoPaterno":
                    $docentes = DB::table('docentes')
                        ->select('id','nPersonal','nombre','apellidoPaterno','apellidoMaterno','email')
                        ->where('apellidoPaterno','LIKE','%'.$search.'%')
                        ->orderBy('apellidoPaterno', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
                break;

                case "apellidoMaterno":
                    $docentes = DB::table('docentes')
                        ->select('id','nPersonal','nombre','apellidoPaterno','apellidoMaterno','email')
                        ->where('apellidoMaterno','LIKE','%'.$search.'%')
                        ->orderBy('apellidoMaterno', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
                break;

                case "email":
                    $docentes = DB::table('docentes')
                        ->select('id','nPersonal','nombre','apellidoPaterno','apellidoMaterno','email')
                        ->where('email','LIKE','%'.$search.'%')
                        ->orderBy('email', 'asc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
                break;

                default:
                    $docentes = DB::table('docentes')
                        ->select('id','nPersonal','nombre','apellidoPaterno','apellidoMaterno','email')
                    ->where('nPersonal','LIKE','%'.$search.'%')
                    ->orWhere('nombre','LIKE','%'.$search.'%')
                    ->orWhere('apellidoPaterno','LIKE','%'.$search.'%')
                    ->orWhere('apellidoMaterno','LIKE','%'.$search.'%')
                    ->orWhere('email','LIKE','%'.$search.'%')
                    ->orderBy('nPersonal','asc')
                    ->paginate(10)
                    ->withQueryString()
                    ;
            }

        }

        return view('docente.index', compact('docentes','search'));
    }

    /**
     * Show the form for creating a new resource.
     * Función para mostrar la vista
     * @see resources/views/docente/create.blade.php
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('docente.create');
    }

    /**
     * Store a newly created resource in storage.
     * Si en algún momento se añade un nuevo atributo al Modelo
     * @see Docente
     * @param  \App\Http\Requests\StoreDocenteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocenteRequest $request)
    {
        $docente = new Docente();
        $docente->nPersonal = $request->nPersonal;
        $docente->nombre = $request->nombre;
        $docente->apellidoPaterno = $request->apellidoPaterno;
        $docente->apellidoMaterno = $request->apellidoMaterno;
        $docente->email = $request->email;

        $docente->save();

        $user = Auth::user();
        $data = $request->nPersonal ." ". $request->nombre ." ". $request->apellidoPaterno ." ". $request->apellidoMaterno ." ".$request->email;
        event(new LogUserActivity($user,"Creación de Docente",$data));

        return redirect()->route('docente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * Retorna las variables que se cargarán como apoyo en el formulario
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //$docente = Docente::where('id',$id)->firstOrFail();
        $docente = Docente::findOrFail($id);
        return view('docente.edit', compact('docente'));

    }

    /**
     * Update the specified resource in storage.
     * Actualiza la información del docente
     *
     * @param  \App\Http\Requests\UpdateDocenteRequest  $request
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocenteRequest $request, $id)
    {
        //$docente = Docente::where('nPersonal',$nPersonal)->firstOrFail();
        $docente = Docente::findOrFail($id);
        $noPersonal = $request->nPersonal;
        $nombre = $request->nombre;
        $apellidoPaterno = $request->apellidoPaterno;
        $apellidoMaterno = $request->apellidoMaterno;
        $email = $request->email;


        //$docente->update($request->all());
        $docente->update([
            'nPersonal' => $noPersonal,
            'nombre' => $nombre,
            'apellidoPaterno' => $apellidoPaterno,
            'apellidoMaterno' => $apellidoMaterno,
            'email' => $email,
        ]);

        $user = Auth::user();
        $data = $request->nPersonal ." ". $request->nombre ." ". $request->apellidoPaterno ." ". $request->apellidoMaterno ." ".$request->email;
        event(new LogUserActivity($user,"Actualización de Docente ID: $request->nPersonal",$data));

        return redirect()->route('docente.index');
    }

    /**
     * Remove the specified resource from storage.
     * Elimina al docente
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$docente = Docente::where('nPersonal',$nPersonal)->firstOrFail();
        $docente = Docente::findOrFail($id);
        //$docente->delete($nPersonal);
        $docente->delete();

        $user = Auth::user();
        //$data = $request->nPersonal ." ". $request->nombre ." ". $request->apellidoPaterno ." ". $request->apellidoMaterno ." ".$request->email;
        $data = "Eliminación de Docente ID: $docente->nPersonal";
        event(new LogUserActivity($user,"Eliminación de Docente ID $docente->nPersonal",$data));

        return redirect()->route('docente.index');

    }

}
