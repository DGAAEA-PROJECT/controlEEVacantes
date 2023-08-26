<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar EE Vacante</title>
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
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Registrar nueva Experiencia Educativa Vacante</h3>
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
                        Si necesitas dar de alta a un Docente, Experiencia Educativa, puedes hacerlo con los siguientes enlaces.

                        <div class="flex flex-col items-center mt-3">
                            <button data-modal-target="docente-modal" data-modal-toggle="docente-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                Crear Docente
                            </button>
                        </div>

                        <div class="flex flex-col items-center mt-3">
                            <button data-modal-target="ee-modal" data-modal-toggle="ee-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                Crear Experiencia Educativa
                            </button>
                        </div>

                        @include('vacante.createDocente')
                        @include('vacante.createEE')
                    </div>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0 md:mr-5">

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Error</span>
                                <div>
                                    <span class="font-medium"> {{$error}} </span>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <form action="{{ route('vacante.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    @csrf

                                    <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                        <label for="periodo" class="block text-sm font-medium text-gray-900 dark:text-gray-400">Periodo</label>
                                        <select  id="periodo" name="periodo" class="estiloSelect">
                                            <option value="">Selecciona el periodo</option>
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
                                               value="3 ECONOMICO ADMINISTRATIVA">
                                    </div>

                                    <div class="col-span-6 sm:col-span-2 lg:col-span-2 ">
                                        <label for="numZona" class="labelForms">Número de zona</label>
                                        <select id="numZona" class="estiloSelect" name="numZona">
                                            <option value="{{$numeroZonaUsuario}}">{{$numeroZonaUsuario}}~{{$nombreZonaUsuario}}</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                        <label for="numDependencia" class="labelForms">Número de dependencia</label>
                                        <select id="numDependencia" class="estiloSelect" name="numDependencia">
                                            <option value="{{$numeroDependenciaUsuario}}">{{$numeroDependenciaUsuario}}~{{$nombreDependenciaUsuario}}</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                        <label for="numPrograma" class="block text-sm font-medium text-gray-900 dark:text-gray-400">Programa</label>
                                        <select  id="numPrograma" name="numPrograma" class="estiloSelect">
                                            <option value="">Selecciona el programa</option>
                                            @foreach ($programas as $data)
                                                <option value="{{$data->clave_programa}}">
                                                    {{$data->clave_programa}}~{{$data->nombre_programa}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="numPlaza" class="labelForms">Número de plaza</label>
                                        <input type="number" name="numPlaza" id="numPlaza" class="inputForms"
                                               placeholder="Ej. 1523" required>
                                    </div>

                                    @include('vacante.selectNrcNombreCreate')

                                    <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                        <label for="grupo" class="labelForms">NRC</label>
                                        <input type="text" name="grupo" id="grupo" class="inputForms"
                                               placeholder=""
                                               required>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="numMotivo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Motivo</label>
                                        <select  id="numMotivo" name="numMotivo" class="estiloSelect">
                                            <option value="">Selecciona el motivo</option>
                                            @foreach ($motivos as $data)
                                                <option value="{{$data->numeroMotivo}}">
                                                    {{$data->numeroMotivo}} {{$data->nombre}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                        <label for="tipoContratacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Tipo de Contratación</label>
                                        <select  id="tipoContratacion" name="tipoContratacion" class="estiloSelect">
                                            <option value="">Selecciona el tipo de contratación</option>
                                            <option value="IOD">Planta</option>
                                            <option value="IOD">Contratación IOD</option>
                                            <option value="IPP">Contratación IPP</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                        <label for="tipoAsignacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Tipo de Asignación</label>
                                        <select  id="tipoAsignacion" name="tipoAsignacion" class="estiloSelect">
                                            <option value="">Selecciona el tipo de asignación</option>
                                            @foreach ($tiposAsignacion as $data)
                                                <option value="{{$data->tipo}}">
                                                    {{$data->tipo}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="numPersonalDocente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Docente</label>
                                        <select  id="numPersonalDocente" name="numPersonalDocente" class="estiloSelect">
                                            <option value="">Selecciona al docente</option>
                                            @foreach ($docentes as $data)
                                                <option value="{{$data->nombre}} {{$data->apellidoPaterno}} {{$data->apellidoMaterno}}-{{$data->nPersonal}}">
                                                    {{$data->nombre}} {{$data->apellidoPaterno}} {{$data->apellidoMaterno}}-{{$data->nPersonal}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="plan" class="labelForms">Plan</label>
                                        <input type="number" name="plan" id="plan" class="inputForms" placeholder="Ej. ">
                                    </div>

                                    <div class="col-span-6">
                                        <label for="observaciones" class="labelForms">Observaciones</label>
                                        <div class="mt-1">
                                        <textarea id="observaciones" name="observaciones" rows="3"
                                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                  placeholder="Ej. Alguna observación"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-6">
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
                                                   placeholder="Selecciona la fecha" id="fechaAviso"
                                                   name="fechaAviso">
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 lg:col-span-3">
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
                                                   placeholder="Selecciona la fecha" id="fechaAsignacion"
                                                   name="fechaAsignacion">
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 lg:col-span-3">
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
                                                   placeholder="Selecciona la fecha" id="fechaApertura"
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
                                                   placeholder="Selecciona la fecha" id="fechaCierre"
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
                                            <input datepicker type="text"
                                                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                   placeholder="Selecciona la fecha" id="fechaRenuncia"
                                                   name="fechaRenuncia">
                                        </div>
                                    </div>

                                    <div class="col-span-6">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file">Documento</label>
                                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file" type="file" accept=".pdf" name="files[]" multiple>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Formato permitido: PDF Tamaño maximo de archivos 2 MBs</p>
                                    </div>

                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                <button type="submit" class="btnGuardar">Registar Vacante</button>
                            </div>
                        </div>
                    </form>
                </div>
                    </form>
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
