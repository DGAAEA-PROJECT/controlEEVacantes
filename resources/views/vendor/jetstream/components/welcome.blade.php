<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div>
        <img src="{{ asset('images/banner_uv.jpg') }}">
        <!--x-jet-application-logo class="block h-12 w-auto" /-->
    </div>

    <div class="mt-8 text-2xl">
        ¡Bienvendo al Sistema de Control de Experiencias Educativas Vacantes!
    </div>

    <div class="mt-6 text-gray-500">
        Que gusto tenerte por aqui, esperamos que el sitio sea de tu agrado y sea de gran utilidad para gestionar las E.E Vacantes, a continuación te proporcionamos el siguiente material de ayuda para sacar el mejor provecho al sistema.
    </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a>Manual de usuario</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                En esta sección encontrarás documentación en la cuál se describe a detalle el funcionamiento del sistema.
            </div>

            @if ( Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin') )

            <a target="_blank" href="https://drive.google.com/file/d/1I7EJW_xLWJZ4B2n_fO6GQIQFU18OFGI2/view?usp=share_link">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                        <div>Explora el manual de usuario</div>

                        <div class="ml-1 text-indigo-500">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                </div>
            </a>

            @else

                <a target="_blank" href="https://drive.google.com/file/d/14MjPauCm6zkTF1ONWBT_ORDJP-Z1rHos/view?usp=share_link">
                    <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                        <div>Explora el manual de usuario</div>

                        <div class="ml-1 text-indigo-500">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>
                </a>

            @endif

        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a>Tutoriales</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                En esta sección encontrarás diversos videos de apoyo sobre el funcionamiento del sistema.
            </div>

            @if ( Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin') )

            <a target="_blank" href="https://youtube.com/playlist?list=PLkQwTdgiXHj6h7KiC7hZ-0h7h4IagCzxE">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                        <div>Ver Videos</div>

                        <div class="ml-1 text-indigo-500">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                </div>
            </a>

            @else

                <a target="_blank" href="https://youtube.com/playlist?list=PLkQwTdgiXHj5o4CIYSaXVx2xOz9XmSzxQ">
                    <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                        <div>Ver Videos</div>

                        <div class="ml-1 text-indigo-500">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>
                </a>

            @endif

        </div>
    </div>

</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1">
    <div class="p-6 border-t border-gray-200">
        <div class="flex items-center">
            <img src="{{ asset('images/developer.png') }}">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a>Desarrolladores</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                En esta sección encontrarás documentación técnica del sistema, información que sin duda sera de gran utilidad para el futuro mantenimiento del sistema.
            </div>

            <a target="_blank" href="https://github.com/DGAAEA-PROJECT/controlEEVacantes">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    <div>Explora la Documentación</div>

                    <div class="ml-1 text-indigo-500">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </a>

        </div>
    </div>
</div>


