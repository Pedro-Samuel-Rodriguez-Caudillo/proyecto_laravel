<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Formulario -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ isset($product) ? 'Editar Producto' : 'Nuevo Producto' }}
                </h3>
                <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="POST">
                    @csrf
                    @if(isset($product)) @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="Name" :value="__('Nombre')" />
                            <x-text-input id="Name" class="block mt-1 w-full" type="text" name="Name" :value="old('Name', $product->Name ?? '')" required />
                        </div>
                        <div>
                            <x-input-label for="category_id" :value="__('Categoría')" />
                            <select id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm">
                                <option value="">Seleccione...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id', isset($product) ? $product->categories->first()?->id : '')) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="Price" :value="__('Precio')" />
                            <x-text-input id="Price" class="block mt-1 w-full" type="number" step="0.01" name="Price" :value="old('Price', $product->Price ?? '')" required />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if(isset($product))
                            <a href="{{ route('products.index') }}" class="mr-4 text-sm text-gray-600 dark:text-gray-400">Cancelar</a>
                        @endif
                        <x-primary-button>
                            {{ isset($product) ? __('Actualizar') : __('Guardar') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoría</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($products as $pr)
                            <tr>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $pr->Name }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                    {{ $pr->categories->pluck('name')->implode(', ') }}
                                </td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">${{ $pr->Price }}</td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <a href="{{ route('products.edit', $pr) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                                    <form action="{{ route('products.destroy', $pr) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Borrar?')">Eliminar</button>
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
