<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ isset($category) ? 'Editar Categoría' : 'Nueva Categoría' }}
                </h3>
                <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="POST">
                    @csrf
                    @if(isset($category)) @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if(isset($category))
                        <div>
                            <x-input-label for="id" :value="__('ID')" />
                            <x-text-input id="id" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700" type="text" :value="$category->id" disabled />
                        </div>
                        @endif
                        <div>
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $category->name ?? '')" required />
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="description" :value="__('Descripción')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description', $category->description ?? '')" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if(isset($category))
                            <a href="{{ route('categories.index') }}" class="mr-4 text-sm text-gray-600 dark:text-gray-400">Cancelar</a>
                        @endif
                        <x-primary-button>
                            {{ isset($category) ? __('Actualizar') : __('Guardar') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Tabla -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($categories as $cat)
                            <tr>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $cat->name }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $cat->description }}</td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <a href="{{ route('categories.edit', $cat) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                                    <form action="{{ route('categories.destroy', $cat) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Eliminar?')">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
