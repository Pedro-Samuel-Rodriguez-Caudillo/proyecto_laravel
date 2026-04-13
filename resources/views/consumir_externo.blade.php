<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Consumiendo API Externa en Render') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Datos recibidos desde Render:</h3>
                    
                    @if(isset($datos['error']))
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                            {{ $datos['error'] }} (Código: {{ $datos['status'] }})
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 border rounded shadow-sm bg-gray-50">
                                <p><strong>Proyecto:</strong> {{ $datos['proyecto'] }}</p>
                                <p><strong>Autor:</strong> {{ $datos['autor'] }}</p>
                                <p><strong>Estado:</strong> {{ $datos['estado'] }}</p>
                                <p><strong>Mensaje:</strong> {{ $datos['mensaje'] }}</p>
                            </div>
                            
                            <div class="p-4 border rounded shadow-sm bg-gray-50">
                                <p><strong>Tecnologías:</strong></p>
                                <ul class="list-disc ml-5">
                                    @foreach($datos['tecnologias'] as $tecnologia)
                                        <li>{{ $tecnologia }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="mt-6">
                        <a href="/json-publico" target="_blank" class="text-blue-500 underline">
                            Ver el JSON original (ruta local)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
