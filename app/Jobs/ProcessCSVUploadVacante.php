<?php

namespace App\Jobs;

use App\Models\Vacante;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCSVUploadVacante implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = array_map('str_getcsv',file($this->file));

        foreach ($data as $row){

            Vacante::updateOrCreate(
                [
                    'periodo' => $row[0],
                    'clavePeriodo' => $row[1],
                    'numZona' => $row[2],
                    'numDependencia' => $row[3],
                    'numArea' => $row[4],
                    'numPrograma' => $row[5],
                    'numPlaza' => $row[6],
                    'numHoras' => $row[7],
                    'numMateria' => $row[8],
                    'nombreMateria' => $row[9],
                    'grupo' => $row[10],
                    'subGrupo' => $row[11],
                    'numMotivo' => $row[12]/*,
                    'tipoContratacion' => $row[13],
                    'tipoAsignacion' => $row[14],
                    'numPersonalDocente' => $row[15],
                    'nombreDocente' => $row[16],
                    'plan' => $row[17],
                    'observaciones' => $row[18],
                    'fechaAviso' => $row[19],
                    'fechaAsignacion' => $row[20],
                    'fechaApertura' => $row[21],
                    'fechaCierre' => $row[22],
                    'fechaRenuncia' => $row[23],*/
                ],

            );

        }
        unlink($this->file);

    }
}
