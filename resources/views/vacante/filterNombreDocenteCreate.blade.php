<div class="col-span-6 sm:col-span-2 lg:col-span-2">
    <label for="nombre-dropdown" class="block mb-0 text-sm  text-gray-900 dark:text-gray-400" >Inicial nombre</label>
    <select id="nombre-dropdown" class="estiloSelect" name="filterNombre">
        <option value="">Selecciona una opción</option>
        <option value="a-z">Todos</option>
        <option value="a-c">A - B - C</option>
        <option value="d-f">D - E - F</option>
        <option value="g-i">G - H - I</option>
        <option value="j-l">J - K - L</option>
        <option value="m-ñ">M - N - Ñ</option>
        <option value="o-q">O - P - Q</option>
        <option value="r-t">R - S - T</option>
        <option value="u-w">U - V - W</option>
        <option value="x-z">X - Y - Z</option>
    </select>
</div>

<div class="col-span-6 sm:col-span-2 lg:col-span-2">
    <label for="apellido-dropdown" class="block mb-0 text-sm  text-gray-900 dark:text-gray-400" >Inicial apellido</label>
    <select id="apellido-dropdown" class="estiloSelect" name="filterApellido">
        <option value="a-z">Todos</option>
        <option value="a-c">A - B - C</option>
        <option value="d-f">D - E - F</option>
        <option value="g-i">G - H - I</option>
        <option value="j-l">J - K - L</option>
        <option value="m-ñ">M - N - Ñ</option>
        <option value="o-q">O - P - Q</option>
        <option value="r-t">R - S - T</option>
        <option value="u-w">U - V - W</option>
        <option value="x-z">X - Y - Z</option>
    </select>
</div>

<div class="col-span-6 sm:col-span-2 lg:col-span-2">
    <label for="numPersonalDocente" class="block mb-0 text-sm font-medium text-gray-900 dark:text-gray-400">Docente</label>
    <select  id="numPersonalDocente-dropdowm" name="numPersonalDocente" class="estiloSelect">
        <option value="">Selecciona al docente</option>
        @foreach ($docentes as $data)
            <option value="{{$data->nombre}} {{$data->apellidoPaterno}} {{$data->apellidoMaterno}}-{{$data->nPersonal}}">
                {{$data->nombre}} {{$data->apellidoPaterno}} {{$data->apellidoMaterno}}-{{$data->nPersonal}}
            </option>
        @endforeach
    </select>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        $('#nombre-dropdown').on('change', function () {
            var filtroNombreSeleccionado = this.value;
            var filtroApellidoSeleccionado = document.getElementById("apellido-dropdown").value;
            console.log(filtroApellidoSeleccionado);
            $("#numPersonalDocente-dropdowm").html('');
            $.ajax({
                url: "{{url('api/fetch-filtroNombre')}}",
                type: "POST",
                data: {
                    rangoLetrasNombre: filtroNombreSeleccionado,
                    rangoLetrasApellido: filtroApellidoSeleccionado,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $.each(result.filtroNombre, function (key, value) {
                        if(value.nPersonal == null && value.apellidoMaterno == null){
                            value.nPersonal = " ";
                            value.apellidoMaterno = " ";
                            $("#numPersonalDocente-dropdowm").append('<option value="' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '">' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '</option>');
                        }
                        else if(value.nPersonal == null){
                            value.nPersonal = " ";
                            $("#numPersonalDocente-dropdowm").append('<option value="' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '">' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '</option>');
                        }
                        else if(value.apellidoMaterno == null){
                            value.apellidoMaterno = " ";
                            $("#numPersonalDocente-dropdowm").append('<option value="' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '">' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '</option>');
                        }
                        else{
                            $("#numPersonalDocente-dropdowm").append('<option value="' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '">' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '</option>');
                        }
                    });
                }
            });
        });

    });

</script>

<script>
    $(document).ready(function () {

        $('#apellido-dropdown').on('change', function () {
            var filtroApellidoSeleccionado = this.value;
            var filtroNombreSeleccionado = document.getElementById("nombre-dropdown").value;
            $("#numPersonalDocente-dropdowm").html('');
            $.ajax({
                url: "{{url('api/fetch-filtroNombre')}}",
                type: "POST",
                data: {
                    rangoLetrasNombre: filtroNombreSeleccionado,
                    rangoLetrasApellido: filtroApellidoSeleccionado,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $.each(result.filtroNombre, function (key, value) {
                        if(value.nPersonal == null && value.apellidoMaterno == null){
                            value.nPersonal = " ";
                            value.apellidoMaterno = " ";
                            $("#numPersonalDocente-dropdowm").append('<option value="' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '">' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '</option>');
                        }
                        else if(value.nPersonal == null){
                            value.nPersonal = " ";
                            $("#numPersonalDocente-dropdowm").append('<option value="' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '">' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '</option>');
                        }
                        else if(value.apellidoMaterno == null){
                            value.apellidoMaterno = " ";
                            $("#numPersonalDocente-dropdowm").append('<option value="' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '">' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '</option>');
                        }
                        else{
                            $("#numPersonalDocente-dropdowm").append('<option value="' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '">' + value.nombre +" "+ value.apellidoPaterno + " " + value.apellidoMaterno + "-" + value.nPersonal + '</option>');
                        }
                    });
                }
            });
        });

    });

</script>



