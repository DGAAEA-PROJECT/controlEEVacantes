<?php

namespace App\Http\Controllers;

use App\Models\ExperienciaEducativa;
use App\Http\Requests\StoreExperienciaEducativaRequest;
use App\Http\Requests\UpdateExperienciaEducativaRequest;
use App\Providers\LogUserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExperienciaEducativaController extends Controller
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

        $experienciasEducativas = DB::table('experiencia_educativas')
            ->select('id','numMateria','nrc','nombre','horas')
            ->where('numMateria','LIKE','%'.$search.'%')
            ->orWhere('nrc','LIKE','%'.$search.'%')
            ->orWhere('nombre','LIKE','%'.$search.'%')
            ->orWhere('horas','LIKE','%'.$search.'%')
            ->orderBy('nombre','asc')
            ->paginate(15);

        if(isset($radioButton)){

            switch ($radioButton){

                case "numMateria":
                    $experienciasEducativas = DB::table('experiencia_educativas')
                    ->select('id','numMateria','nrc','nombre','horas')
                    ->where('numMateria','LIKE','%'.$search.'%')
                    ->orderBy('numMateria', 'asc')
                    ->paginate(15)
                    ;
                break;

                case "nrc":
                    $experienciasEducativas = DB::table('experiencia_educativas')
                    ->select('id','numMateria','nrc','nombre','horas')
                    ->where('nrc','LIKE','%'.$search.'%')
                    ->orderBy('nrc', 'asc')
                    ->paginate(15)
                    ;
                break;

                case "nombre":
                    $experienciasEducativas = DB::table('experiencia_educativas')
                    ->select('id','numMateria','nrc','nombre','horas')
                    ->where('nombre','LIKE','%'.$search.'%')
                    ->orderBy('nombre', 'asc')
                    ->paginate(15)
                    ;
                break;

                case "horas":
                    $experienciasEducativas = DB::table('experiencia_educativas')
                    ->select('id','numMateria','nrc','nombre','horas')
                    ->where('horas','LIKE','%'.$search.'%')
                    ->orderBy('horas', 'asc')
                    ->paginate(15)
                    ;
                break;

                default:
                    $experienciasEducativas = DB::table('experiencia_educativas')
                    ->select('id','numMateria','nrc','nombre','horas')
                        ->where('numMateria','LIKE','%'.$search.'%')
                    ->orWhere('nrc','LIKE','%'.$search.'%')
                    ->orWhere('nombre','LIKE','%'.$search.'%')
                    ->orWhere('horas','LIKE','%'.$search.'%')
                    ->orderBy('nombre','asc')
                    ->paginate(15)
                    ;
            }

        }

        return view('experienciaEducativa.index', compact('experienciasEducativas','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('experienciaEducativa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExperienciaEducativaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExperienciaEducativaRequest $request)
    {

        $ee = new ExperienciaEducativa();
        $ee->numMateria = $request->numMateria;
        $ee->nrc = $request->nrc;
        $ee->nombre = $request->nombre;
        $ee->horas = $request->horas;

        $ee->save();

        $user = Auth::user();
        $data = $request->numMateria ." " . $request->nrc ." ". $request->nombre ." ". $request->horas;
        event(new LogUserActivity($user,"Creación de Experiencia Educativa",$data));

        return redirect()->route('experienciaEducativa.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExperienciaEducativa  $experienciaEducativa
     * @return \Illuminate\Http\Response
     */
    public function show(ExperienciaEducativa $experienciaEducativa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExperienciaEducativa  $experienciaEducativa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //$experienciaEducativa = ExperienciaEducativa::where('nrc',$nrc)->firstOrFail();
        $experienciaEducativa = ExperienciaEducativa::findOrFail($id);
        return view('experienciaEducativa.edit', compact('experienciaEducativa'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExperienciaEducativaRequest  $request
     * @param  \App\Models\ExperienciaEducativa  $experienciaEducativa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExperienciaEducativaRequest $request, $id)
    {
        //$docente = ExperienciaEducativa::where('nrc',$nrc)->firstOrFail();
        $experienciaEducativa = ExperienciaEducativa::findOrFail($id);
        $numMateria = $request->numMateria;
        $nrc = $request->nrc;
        $nombre = $request->nombre;
        $horas = $request->horas;

        $experienciaEducativa->update([
            'numMateria' => $numMateria,
            'nrc' => $nrc,
            'nombre' => $nombre,
            'horas' => $horas,
        ]);

        $user = Auth::user();
        $data = $request->numMateria ." ".$request->nrc ." ". $request->nombre ." ". $request->horas;
        event(new LogUserActivity($user,"Actualización de Experiencia Educativa ID: $request->nrc",$data));

        return redirect()->route('experienciaEducativa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExperienciaEducativa  $experienciaEducativa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$ee = ExperienciaEducativa::where('nrc',$nrc)->firstOrFail();
        $ee = ExperienciaEducativa::findOrFail($id);
        $ee->delete();

        $user = Auth::user();
        $data = "Eliminación de la Experiencia Educativa ID: $id";
        event(new LogUserActivity($user,"Eliminación de la Experiencia Educativa ID $id",$data));

        return redirect()->route('experienciaEducativa.index');

    }

}
