<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeriodoRequest;
use App\Http\Requests\UpdatePeriodoRequest;
use App\Models\Periodo;
use App\Providers\LogUserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeriodoController extends Controller
{

    public function index(Request $request)
    {

        $search = trim($request->get('search'));
        $radioButton = $request->get('tipo');

        $periodos = DB::table('periodos')
            ->select('id','nPeriodo', 'clavePeriodo','descripcion','actual')
            ->where('nPeriodo','LIKE','%'.$search.'%')
            ->orWhere('clavePeriodo','LIKE','%'.$search.'%')
            ->orWhere('descripcion','LIKE','%'.$search.'%')
            ->paginate(10)
            ->withQueryString()
            ;

        if(isset($radioButton)){

            switch ($radioButton){

                case "nPeriodo":
                    $periodos = DB::table('periodos')
                        ->select('id','nPeriodo', 'clavePeriodo','descripcion')
                        ->where('nPeriodo','LIKE','%'.$search.'%')
                        ->orderBy('nPeriodo', 'desc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
                    break;

                case "clavePeriodo":
                    $periodos = DB::table('periodos')
                        ->select('id','nPeriodo', 'clavePeriodo','descripcion','actual')
                        ->where('clavePeriodo','LIKE','%'.$search.'%')
                        ->orderBy('clavePeriodo', 'desc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
                    break;

                case "descripcion":
                    $periodos = DB::table('periodos')
                        ->select('id','nPeriodo', 'clavePeriodo','descripcion','actual')
                        ->where('descripcion','LIKE','%'.$search.'%')
                        ->orderBy('descripcion', 'desc')
                        ->paginate(10)
                        ->withQueryString()
                        ;
                    break;

                default:
                    $periodos = DB::table('periodos')
                        ->select('id','nPeriodo', 'clavePeriodo','descripcion','actual')
                        ->where('nPeriodo','LIKE','%'.$search.'%')
                        ->orWhere('clavePeriodo','LIKE','%'.$search.'%')
                        ->orWhere('descripcion','LIKE','%'.$search.'%')
                        ->paginate(10)
                        ->withQueryString()
                        ;

            }

        }

        return view('periodo.index',compact('periodos','search'));

    }
    public function create()
    {
        return view ('periodo.create');
    }

    public function store(StorePeriodoRequest $request)
    {
        $periodo = new Periodo();
        $periodo->nPeriodo = $request->nPeriodo;
        $periodo->clavePeriodo = $request->clavePeriodo;
        $periodo->descripcion = $request->descripcion;

        $periodo->save();

        $user = Auth::user();
        $data = $request->nPeriodo ." ". $request->clavePeriodo ." ". $request->descripcion . " ";
        event(new LogUserActivity($user,"Creación de Periodo",$data));

        return redirect()->route('periodo.index');

    }

    public function show(Periodo $periodo)
    {

    }
    public function edit($id)
    {
        $periodo = Periodo::where('id',$id)->firstOrFail();
        return view('periodo.edit', compact('periodo'));
    }

    public function update(UpdatePeriodoRequest $request, $id)
    {
        $periodo = Periodo::where('id', $id)->firstOrFail();
        $nPeriodo = $request->nPeriodo;
        $clavePeriodo = $request->clavePeriodo;
        $descripcion = $request->descripcion;

        $periodo->update([
           'nPeriodo'=>$nPeriodo,
           'clavePeriodo'=>$clavePeriodo,
           'descripcion'=>$descripcion,
        ]);

        $user = Auth::user();
        $data = $nPeriodo ." ". $clavePeriodo ." ". $descripcion . " ";
        event(new LogUserActivity($user,"Actualización de Periodo ID: $request->nPeriodo",$data));

        return redirect()->route('periodo.index');

    }

    public function updatePA(Request $request, $id)
    {
        $periodo = Periodo::where('id', $id)->firstOrFail();

        $actual = $request->actual;
        $valBo = false;
        if($actual){
            //$valBo = true;
            $periodo->update([
                //'actual'=>$actual,
                'actual'=>true,
            ]);

            $periodoID = DB::table('periodos')
                ->select('id')
                ->where('id','=',$id)
                ->value('id')
            ;

            $aPeriodo = str_split($periodoID);

            $otrosPeriodos = Db::table('periodos')
                ->whereNotIn('id',$aPeriodo)
                ->update([
                    'actual' => false,
                ])

            ;

        }else{
            //$valBo = false;
            $periodo->update([
                //'actual'=>$actual,
                'actual'=>false,
            ]);

        }

/*        $periodo->update([
            //'actual'=>$actual,
            'actual'=>$valBo,
        ]);*/

/*        $periodoID = DB::table('periodos')
            ->select('id')
            ->where('id','=',$id)
            ->value('id')
            ;*/

        //dd($periodoID);
        //$aPeriodo = str_split($periodoID);
        //$iPeriodo = (integer) $periodoID;

/*        $otrosPeriodos = Db::table('periodos')
                         ->whereNotIn('id',$aPeriodo)
                         ->update([
                             'actual' => false,
                         ])

                         ;*/


        $user = Auth::user();
        $data = $periodo->nPeriodo . " " . $periodo->descripcion;
        event(new LogUserActivity($user,"Se fijo como periodo actual Actualización de Periodo ID: $periodo->clavePeriodo",$data));

        return redirect()->route('periodo.index');

    }


    public function destroy($id)
    {
        //
        $periodo = Periodo::where('id',$id)->firstOrFail();
        $periodo->delete($id);

        $user = Auth::user();
        //$data = $request->nPersonal ." ". $request->nombre ." ". $request->apellidoPaterno ." ". $request->apellidoMaterno ." ".$request->email;
        $data = "Eliminación de Periodo ID: $id";
        event(new LogUserActivity($user,"Eliminación de periodo ID $id",$data));

        return redirect()->route('periodo.index');
    }

}
