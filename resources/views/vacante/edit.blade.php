<!doctype html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar EE Vacante</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('node_modules/flowbite/dist/flowbite.js')
    @vite('node_modules/flowbite/dist/datepicker.js')
    @livewireStyles
</head>
<body>

<div class="fondo">
    <!--Menu-->
    @livewire('navigation-menu')

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-5">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Actualizar Experiencia Educativa
                        Vacante</h3>
                    <p class="mt-1 text-sm text-gray-600">Por favor ingresa los datos solicitados.</p><br>
                    <p><b>Recuerda que los datos obligatiorios son:</b></p>
                    <li>Periodo</li>
                    <li>Zona</li>
                    <li>Dependencia</li>
                    <li>Programa educativo</li>
                    <li>Experiencia Educativa</li>
                    <li>Horas</li>
                    <li>Grupo</li>
                    <li>SubGrupo</li>
                    <li>Número de plaza</li>
                    <li>Motivo</li>
                    <li>Tipo de contratación</li>
                    <li>Tipo de asignación</li>
                    <li>Docente</li>
                    <br>

                    <div class="hidden sm:block" aria-hidden="true">
                        <div class="py-5">
                            <div class="border-t border-gray-200"></div>
                        </div>
                    </div>

                    Si necesitas dar de alta a un Docente, Experiencia Educativa, puedes hacerlo con los siguientes
                    enlaces.

                    <div class="flex flex-col items-center mt-3">
                        <button data-modal-target="docente-modal" data-modal-toggle="docente-modal"
                                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">
                            Crear Docente
                        </button>
                    </div>

                    <div class="flex flex-col items-center mt-3">
                        <button data-modal-target="ee-modal" data-modal-toggle="ee-modal"
                                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">
                            Crear Experiencia Educativa
                        </button>
                    </div>

                    <div class="hidden sm:block" aria-hidden="true">
                        <div class="py-5">
                            <div class="border-t border-gray-200"></div>
                        </div>
                    </div>


                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-medium">Documento(s)
                        actual(es)</label>

                    @foreach ($files as $file)
                        <div class="gap-6">
                            <a class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline"
                               target="_blank"
                               href="https://gestionvacantes.blob.core.windows.net/files/{{$file["name"]}}">{{$file["name"]}}
                            </a>
                                <?php
                                $archivo = $file["name"];
                                $archivoPartes = explode("/", $archivo);
                                $vacanteArchivo = $archivoPartes[0];
                                $nombreArchivo = $archivoPartes[1];
                                ?>

                            <form
                                action="{{ route('vacante.deleteFile',['id' =>$vacanteArchivo,'file' => $nombreArchivo ]) }}"
                                method="POST">
                                @csrf
                                <button type="submit"
                                        class="px-6 font-medium text-red-600 underline dark:text-blue-500 hover:no-underline">
                                    Eliminar
                                </button>
                            </form>

                            <br>
                        </div>
                    @endforeach



                    @include('vacante.createDocente')
                    @include('vacante.createEE')

                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0 md:mr-5">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div
                            class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                            role="alert">
                            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Error</span>
                            <div>
                                <span class="font-medium"> {{$error}} </span>
                            </div>
                        </div>
                    @endforeach
                @endif

                <form action="{{ route('vacante.update',$vacante->id) }}" method="POST" enctype="multipart/form-data">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                @csrf

                                <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                    <label for="periodo"
                                           class="block text-sm font-medium text-gray-900 dark:text-gray-400">Periodo</label>
                                    <select id="periodo" name="periodo" class="estiloSelect">
                                        <option
                                            value="{{$vacante->periodo}}-{{$vacante->clavePeriodo}}">{{$vacante->periodo}}
                                            -{{$vacante->clavePeriodo}}</option>
                                        @foreach ($periodos as $data)
                                            <option value="{{$data->nPeriodo}}-{{$data->clavePeriodo}}">
                                                {{$data->nPeriodo}}-{{$data->clavePeriodo}}-{{$data->descripcion}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                    <label for="numArea" class="labelForms">Número de área</label>
                                    <input type="text" name="numArea" id="numArea" class="inputForms" disabled
                                           value="3 ECONÓMICO ADMINISTRATIVA" readonly="readonly">
                                </div>

                                @include('vacante.selectZonaDependenciaProgramaEdit')

                                @include('vacante.selectNrcNombreEdit')


                                <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                    <label for="grupo" class="labelForms">NRC</label>
                                    <input type="text" name="grupo" id="grupo" class="inputForms"
                                           required
                                           value="{{$vacante->grupo}}">
                                </div>

                                {{--
                                <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                    <label for="subGrupo" class="labelForms">Sub Grupo</label>
                                    <input type="text" name="subGrupo" id="subGrupo" class="inputForms"
                                           readonly="readonly"
                                           value="0">
                                </div>
                                --}}
                                <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                    <label for="numPlaza" class="labelForms">Número de plaza</label>
                                    <input type="number" name="numPlaza" id="numPlaza" class="inputForms"
                                           required value="{{$vacante->numPlaza}}">
                                </div>

                                <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                    <label for="plan" class="labelForms">Plan</label>
                                    <input type="number" name="plan" id="plan" class="inputForms"
                                           value="{{$vacante->plan}}">
                                </div>

                                <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                    <label for="numMotivo"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Motivo</label>
                                    <select id="numMotivo" name="numMotivo" class="estiloSelect" required>
                                        <option value="{{$vacante->numMotivo}}">{{$vacante->numMotivo}}</option>
                                        @foreach ($motivos as $data)
                                            <option value="{{$data->numeroMotivo}}">
                                                {{$data->numeroMotivo}} {{$data->nombre}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                    <label for="tipoContratacion"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Tipo
                                        de Contratación</label>
                                    <select id="tipoContratacion" name="tipoContratacion" class="estiloSelect">
                                        <option
                                            value="{{$vacante->tipoContratacion}}">{{$vacante->tipoContratacion}}</option>
                                        <option value="IOD">Planta</option>
                                        <option value="IOD">Contratación IOD</option>
                                        <option value="IPP">Contratación IPP</option>
                                    </select>
                                </div>

                                <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                    <label for="tipoAsignacion"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Tipo
                                        de Asignación</label>
                                    <select id="tipoAsignacion" name="tipoAsignacion" class="estiloSelect">
                                        <option
                                            value="{{$vacante->tipoAsignacion}}">{{$vacante->tipoAsignacion}}</option>
                                        @foreach ($tiposAsignacion as $data)
                                            <option value="{{$data->tipo}}">
                                                {{$data->tipo}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @include('vacante.filterNombreDocenteEdit')

                                <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                    <div class="md:w-3/3 flex flex-col items-center">
                                        <label for="numPersonalDocente"
                                               class="block mb-0 text-sm font-medium text-gray-900 dark:text-gray-400">Docentes
                                            anteriores</label>
                                    </div>


                                    <div class="md:w-3/3 flex flex-col items-center">
                                        <button id="dropdownDocentesButton"
                                                data-dropdown-toggle="dropdownDocentes{{$vacante->id}}"
                                                class="items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400"
                                                type="button">
                                            <svg class="w-40 h-14 mx-1.5" aria-hidden="true" fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                @include('vacante.dropdownDocentesHistorico')

                                <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                    <label for="fechaAviso" class="labelForms">Fecha de aviso</label>
                                    <div class="relative">
                                        <div
                                            class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                 fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input datepicker datepicker-format="dd/mm/yyyy" type="text"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               value="{{$vacante->fechaAviso}}" id="fechaAviso"
                                               name="fechaAviso">
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                    <label for="fechaAsignacion" class="labelForms">Fecha de asignación</label>
                                    <div class="relative">
                                        <div
                                            class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                 fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input datepicker datepicker-format="dd/mm/yyyy" type="text"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               value="{{$vacante->fechaAsignacion}}" id="fechaAsignacion"
                                               name="fechaAsignacion">
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                    <label for="fechaApertura" class="labelForms">Fecha de apertura</label>
                                    <div class="relative">
                                        <div
                                            class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                 fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input datepicker datepicker-format="dd/mm/yyyy" type="text"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               value="{{$vacante->fechaApertura}}" id="fechaApertura"
                                               name="fechaApertura">
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                    <label for="fechaCierre" class="labelForms">Fecha de cierre</label>
                                    <div class="relative">
                                        <div
                                            class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                 fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input datepicker datepicker-format="dd/mm/yyyy" type="text"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               value="{{$vacante->fechaCierre}}" id="fechaCierre"
                                               name="fechaCierre">
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                    <label for="fechaRenuncia" class="labelForms">Fecha de renuncia</label>
                                    <div class="relative">
                                        <div
                                            class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                 fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input datepicker datepicker-format="dd/mm/yyyy" type="text"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               value="{{$vacante->fechaRenuncia}}" id="fechaRenuncia"
                                               name="fechaRenuncia">
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <label for="observaciones" class="labelForms">Observaciones</label>
                                    <div class="mt-1">
                                        <textarea id="observaciones" name="observaciones" rows="3"
                                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                  placeholder="Ej. Alguna observación">{{$vacante->observaciones}}</textarea>
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                           for="file">Documento(s) actual(es)</label>

                                    @foreach ($files as $file)
                                        <div class="gap-6">
                                            <a class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline"
                                               target="_blank"
                                               href="https://gestionvacantes.blob.core.windows.net/files/{{$file["name"]}}">{{$file["name"]}}
                                            </a>
                                            <br>
                                        </div>
                                    @endforeach
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="file_input_help" id="file" type="file" accept=".pdf"
                                        name="files[]" multiple>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
                                        Formato permitido: PDF Tamaño maximo de archivos 2 MBs</p>
                                </div>

                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit" class="btnGuardar">Actualizar Vacante</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="hidden sm:block" aria-hidden="true">
    <div class="py-5">
    </div>
</div>

</div>

</body>
</html>
