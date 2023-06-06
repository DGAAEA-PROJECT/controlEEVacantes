<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de EE vacantes</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
    <!-- <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('node_modules/flowbite/dist/flowbite.js')
    @livewireStyles
</head>
<body>

<div class="fondo">
    <!--Menu-->
    @livewire('navigation-menu')

    <div class="flex sm:rounded-lg md:mt-5 md:mx-10 md:my-0">
        <div class="w-3/4">
            <p class="text-2xl font-bold">Lista de Experiencias Educativas Vacantes</p>
        </div>

        <div class="w-1/4 flex flex-col items-end">
            <a href="{{ route('vacante.create') }}" class="text-white bg-azul-royal hover:bg-azul-royal-hover focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Añadir Nueva</a>
        </div>

    </div>

    <div >
    @if ( Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin') )
        @include('vacante.filterZonaDependenciaPrograma')
    @else
        @include('vacante.filterZonaDependenciaProgramaEditor')
    @endif
    </div>

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg md:mt-10 md:mx-10 md:my-10">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Programa
                </th>
                <th scope="col" class="py-3 px-6">
                    Experiencia Educativa
                </th>
                <th scope="col" class="py-3 px-6">
                    Horas
                </th>
                <th scope="col" class="py-3 px-6">
                    Contratación
                </th>
                <th scope="col" class="py-3 px-6">
                    Docente
                </th>
                <th scope="col" class="py-3 px-6">
                    Archivo
                </th>
                <th scope="col" class="py-3 px-6">
                    <span class="sr-only">Ver Información</span>
                </th>
                <th scope="col" class="py-3 px-6">
                    <span class="sr-only">Editar</span>
                </th>

                @if ( Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin') )

                    <th scope="col" class="py-3 px-6">
                        <span class="sr-only">Eliminar</span>
                    </th>

                @endif
            </tr>
            </thead>
            <tbody>

            @if(count($vacantes)<=0)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="py-4 px-6">
                        No se han encontrado vacantes
                    </td>
                </tr>
            @else
                @foreach($vacantes as $vacante)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$vacante->numPrograma}} -
                            {{DB::table('zona__dependencia__programas')->where('clave_programa','=',$vacante->numPrograma)->value('nombre_programa') }}
                        </th>

                        <td class="py-4 px-6">
                            {{$vacante->nombreMateria}}
                        </td>

                        <td class="py-4 px-6">
                            {{$vacante->numHoras}}
                        </td>
                        <td class="py-4 px-6">
                            {{$vacante->tipoContratacion}}
                        </td>

                        <td class="py-4 px-6">
                            {{$vacante->nombreDocente}}
                        </td>

                        <td class="py-4 px-6">

                            @if( $vacante->archivo != "Inexistente" )


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

                                    @if(count($file)<=0))

                                    Inexistente

                                    @else

                                    <a target="_blank" href="https://gestionvacantes.blob.core.windows.net/files/{{$file["name"]}}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                                        <img src="{{asset('images/file.png')}}" alt="{{$file["name"]}}" title="{{$file["name"]}}">
                                    </a>
                                    <br>

                                    @endif

                                @endforeach

                            @else

                                Inexistente

                            @endif

                        </td>

                        @if ( Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin') )

                            @if($isDeleted)

                                <td class="py-4 px-2 text-right">
                                    <button type="button"
                                            class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-900"
                                            data-modal-toggle="view-modal{{$vacante->id}}">Ver Info</button>
                                </td>

                            @else

                                <td class="py-4 px-2 text-right">
                                    <button type="button"
                                            class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-900"
                                            data-modal-toggle="view-modal{{$vacante->id}}">Ver Info</button>
                                </td>

                                <td class="py-4 px-2 text-right">
                                    <a href="{{route('vacante.edit',$vacante->id)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar</a>
                                </td>

                                <td class="py-4 px-2 text-right">
                                    <button type="button"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                            data-modal-toggle="delete-modal{{$vacante->id}}">Cerrar EE</button>
                                </td>

                            @endif

                        @else

                            @if($isDeleted)

                                <td class="py-4 px-2 text-right">
                                    <button type="button"
                                            class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-900"
                                            data-modal-toggle="view-modal{{$vacante->id}}">Ver Info</button>
                                </td>

                            @else

                                <td class="py-4 px-2 text-right">
                                    <button type="button"
                                            class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-900"
                                            data-modal-toggle="view-modal{{$vacante->id}}">Ver Info</button>
                                </td>

                                <td class="py-4 px-2 text-right">
                                    <a href="{{route('vacante.edit',$vacante->id)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar</a>
                                </td>

                            @endif

                        @endif

                    </tr>
                    @include('vacante.modalConfirmacionEliminar')
                    @include('vacante.modalVisualizarVacante')
                @endforeach
            @endif
            </tbody>
        </table>

        @if( $zona ==="" )
            {{ $vacantes->links() }}
        @else
            <div>
                <p class="text-sm text-gray-700 leading-5">
                    Mostrando
                    <span class="font-medium">{{ $countVacantes }}</span>
                    Resultados
                </p>
            </div>
        @endif

    </div>

</div>

</body>
</html>
