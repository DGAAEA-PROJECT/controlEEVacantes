<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Periodos</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
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
            <p class="text-2xl font-bold">Lista de Periodos</p>
        </div>
        <div class="w-1/4 flex flex-col items-end">
            <a href="{{ route('periodo.create') }}" class="text-white bg-azul-royal hover:bg-azul-royal-hover focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Añadir Nuevo</a>
        </div>
    </div>

    <form action="{{route('periodo.index')}}" method="GET" value="{{$search}}">
        <div class="flex shadow-md sm:rounded-lg md:mt-5 md:mx-10 md:my-10">

            <button id="dropdownBgHoverButton" data-dropdown-toggle="dropdownBgHover" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Filtrar <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>

            <!-- Dropdown menu -->
            <div id="dropdownBgHover" class="hidden z-10 w-48 bg-white rounded shadow dark:bg-gray-700">
                <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownBgHoverButton">

                    <li>
                        <div class="flex items-center">
                            <input id="nPeriodo" type="radio" value="nPeriodo" name="tipo" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="nPeriodo" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">N° de Periodo</label>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <input id="clavePeriodo" type="radio" value="clavePeriodo" name="tipo" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="clavePeriodo" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Clave de Periodo</label>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <input id="descripcion" type="radio" value="descripcion" name="tipo" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="descripcion" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descripción</label>
                        </div>
                    </li>

                </ul>
            </div>

            <div class="relative w-full">
                <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Ingresa tu búsqueda, recuerda que puedes aplicar los filtros que desees" name="search">
                <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span class="sr-only">Buscar</span>
                </button>
            </div>
        </div>

    </form>

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg md:mt-10 md:mx-10 md:my-10">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    N° de periodo
                </th>
                <th scope="col" class="py-3 px-6">
                    Clave de periodo
                </th>
                <th scope="col" class="py-3 px-6">
                    Descripción
                </th>
                <th scope="col" class="py-3 px-6">
                    Periodo Actual
                </th>
                <th scope="col" class="py-3 px-6">

                </th>
                <th scope="col" class="py-3 px-6">

                </th>
            </tr>
            </thead>
            <tbody>

            @if(count($periodos)<=0)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="py-4 px-6">
                        No se han encontrado periodos
                    </td>
                </tr>
            @else
                @foreach($periodos as $periodo)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$periodo->nPeriodo}}
                        </th>

                        <td class="py-4 px-6">
                            {{$periodo->clavePeriodo}}
                        </td>

                        <td class="py-4 px-6">
                            {{$periodo->descripcion}}
                        </td>

                        @if($periodo->actual)

                            <td class="py-4 px-6">
                                <form id="formPeriodoActual" action="{{ route('periodo.updatePA',$periodo->id) }}" method="POST">
                                    @csrf
                                    <input checked onchange="this.form.submit()" type="checkbox" id="cbActual" name="actual" value="False" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </form>
                            </td>

                        @else

                            <td class="py-4 px-6">
                                <form id="formPeriodoActual" action="{{ route('periodo.updatePA',$periodo->id) }}" method="POST">
                                    @csrf
                                    <input onchange="this.form.submit()" type="checkbox" id="cbActual" name="actual" value="True" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </form>
                            </td>

                        @endif

                        <td class="py-4 px-6 text-right">
                            <a href="{{route('periodo.edit',$periodo->id)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar</a>
                        </td>

                        <td class="py-4 px-6 text-right">
                            <button type="button"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                    data-modal-toggle="delete-modal{{$periodo->id}}">Eliminar</button>
                        </td>

                    </tr>
                    @include('periodo.modalConfirmacionEliminar')
                @endforeach
            @endif
            </tbody>
        </table>
        {{ $periodos->links() }}
    </div>

</div>

</body>
</html>
