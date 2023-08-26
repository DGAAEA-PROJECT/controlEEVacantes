<div  id="view-modal{{$vacante->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-0 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="view-modal{{$vacante->id}}">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="mt-2 text-center">
  {{--              <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>--}}
                <h3 class="mb-5 top:5 text-lg font-normal text-gray-500 dark:text-gray-400">Experiencia Educativa: {{$vacante->nombreMateria}}</h3>
            </div>
            <div class="pt-0 px-6 text-justify">

                    <div class="col-span-6">
                        <label class="labelForms">Periodo: {{$vacante->periodo}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Clave Periodo: {{$vacante->clavePeriodo}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">
                            Zona: {{$vacante->numZona}} -
                            {{DB::table('zona__dependencia__programas')->where('id_zona','=',$vacante->numZona)->value('nombre_zona') }}
                        </label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">
                            Número de dependencia: {{$vacante->numDependencia}} -
                            {{DB::table('zona__dependencia__programas')->where('clave_dependencia','=',$vacante->numDependencia)->value('nombre_dependencia') }}
                        </label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Número de área: {{$vacante->numArea}} Económico Administrativa</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">
                            Número de programa: {{$vacante->numPrograma}} -
                            {{DB::table('zona__dependencia__programas')->where('clave_programa','=',$vacante->numPrograma)->value('nombre_programa') }}
                        </label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Número de plaza: {{$vacante->numPlaza}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Número de horas: {{$vacante->numHoras}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Código de materia: {{$vacante->numMateria}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">NRC: {{$vacante->grupo}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Sub Grupo: {{$vacante->subGrupo}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">
                            Motivo: {{$vacante->numMotivo}} -
                            {{DB::table('motivos')->where('numeroMotivo','=',$vacante->numMotivo)->value('nombre') }}
                        </label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Tipo de asignación: {{$vacante->tipoAsignacion}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Tipo de contratación: {{$vacante->tipoContratacion}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Número y nombre del docente: {{$vacante->numPersonalDocente}} - {{$vacante->nombreDocente}}</label>
                    </div>

                    <div class="col-span-6">
                        <label class="labelForms">Plan: {{$vacante->plan}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Fecha de aviso: {{$vacante->fechaAviso}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Fecha de asignación: {{$vacante->fechaAsignacion}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Fecha de apertura: {{$vacante->fechaApertura}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Fecha de cierre: {{$vacante->fechaCierre}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Fecha de renuncia: {{$vacante->fechaRenuncia}}</label>
                    </div>
                    <div class="col-span-6">
                        <label class="labelForms">Observaciones: {{$vacante->observaciones}}</label>
                    </div>
                    <div class="col-span-6">

                        <p class="truncate text-sm text-gray-700 dark:text-black-400">Documento(s):  </p>
                        <?php
                        $path = "vac-{$vacante->id}";
                        $disk = Storage::disk('azure');
                        $files = $disk->files($path);
                        $filesList = array();
                        foreach ($files as $file){
                            $filename = "$file";
                            $item = array(
                                'name' => $filename,
                            );
                            array_push($filesList,$item);
                        }
                        ?>
                        @foreach ($filesList as $file)
                            ●
                            <a class="font-medium text-sm text-blue-600 underline dark:text-blue-500 hover:no-underline"
                               target="_blank"
                               href="https://filesdgaaea.blob.core.windows.net/files/{{$file["name"]}}">{{$file["name"]}}</a>
                            <br>
                        @endforeach

                    </div>


            </div>
            <div class="p-2 text-center">
                <button data-modal-toggle="view-modal{{$vacante->id}}" type="button" class="text-white bg-gray-700 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Regresar</button>
            </div>

        </div>
    </div>
</div>
