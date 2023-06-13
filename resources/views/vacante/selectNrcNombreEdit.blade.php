<div class="col-span-6 sm:col-span-2 lg:col-span-2">
    <label for="numMateria-dropdown" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">NRC</label>
    <select  id="numMateria-dropdown" name="numMateria" class="estiloSelect">
            <option value="{{$vacante->numMateria}}~{{$vacante->nombreMateria}}">{{$vacante->numMateria}}~{{$vacante->nombreMateria}}</option>
            @foreach ($experienciasEducativas as $data)
                <option value="{{$data->nrc}}~{{$data->nombre}}">
                    {{$data->nrc}}~{{$data->nombre}}
                </option>
            @endforeach
    </select>
</div>

<div class="col-span-6 sm:col-span-2 lg:col-span-2">
    <label for="numHoras-dropdown" class="block mb-2 text-sm  text-gray-900 dark:text-gray-400" >Número de horas</label>
    <select id="numHoras-dropdown" class="estiloSelect" name="numHoras">
        <option value="{{$vacante->numHoras}}">{{$vacante->numHoras}}</option>
    </select>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#numMateria-dropdown').on('change', function () {
            var materiaCompleta = this.value;
            var materiaPartes = materiaCompleta.split('~');
            var nrcMateriaSeleccionada = materiaPartes[0];
            $("#nombreMateria-dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-horasExperienciaEducativa')}}",
                type: "POST",
                data: {
                    nrc: nrcMateriaSeleccionada,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $.each(result.horasExperienciaEducativa, function (key, value) {
                        $("#numHoras-dropdown").html('<option value="' + value.horas + '">' + value.horas + '</option>');
                    });
                }
            });
        });
    });
</script>


