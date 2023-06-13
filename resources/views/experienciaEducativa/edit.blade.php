<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar Experiencia Educativa</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Actualizar Experiencia Educativa</h3>
                    <p class="mt-1 text-sm text-gray-600">Por favor ingresa los datos solicitados.</p><br>
                    <p><b>Recuerda que los datos obligatiorios son:</b></p>
                    <li>Número de Materia</li>
                    <li>NRC</li>
                    <li>Nombre</li>
                    <li>Horas</li>
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

                <form action="{{ route('experienciaEducativa.update',$experienciaEducativa->id) }}" method="POST">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                @csrf

                                <div class="col-span-6">
                                    <label for="numMateria" class="labelForms">Número de Materia</label>
                                    <input type="number" name="numMateria" id="numMateria" class="inputForms"
                                           required value="{{old('numMateria',$experienciaEducativa->numMateria)}}">
                                </div>
                                {{--
                                <div class="col-span-6">
                                    <label for="nrc" class="labelForms">NRC</label>
                                    <input type="number" name="nrc" id="nrc" class="inputForms"
                                           value="{{old('nrc',$experienciaEducativa->nrc)}}">
                                </div>
                                --}}
                                <div class="col-span-6">
                                    <label for="nombre" class="labelForms">Nombre de la Experiencia Educativa</label>
                                    <input type="text" name="nombre" id="nombre" class="inputForms"
                                           value="{{old('nombre',$experienciaEducativa->nombre)}}" required>
                                </div>

                                <div class="col-span-6">
                                    <label for="horas" class="labelForms">Horas</label>
                                    <input type="number" name="horas" id="horas" class="inputForms"
                                           value="{{old('horas',$experienciaEducativa->horas)}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit" class="btnGuardar">Actualizar Experiencia Educativa</button>
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
