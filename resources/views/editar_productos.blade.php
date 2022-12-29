<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('productos.update', $producto) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="nombre" :value="__('Nombre')" />
                <x-text-input id="nombre" class="block mt-1 w-full"
                type="text"
                name="nombre"
                required 
                autocomplete="nombre"
                value="{{old('nombre', $producto->nombre)}}"
                />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />

                <x-input-label class="mt-4" for="nombre" :value="__('Descripcion')" />

                <textarea 
                name="descripcion" 
                style="resize: none;"
                class = "
                    form-control
                    block
                    px-3
                    w-full
                    py-1.5
                    border-gray-300 
                    dark:border-gray-700 
                    dark:bg-gray-900 
                    dark:text-gray-300 
                    focus:border-indigo-500 
                    dark:focus:border-indigo-600 
                    focus:ring-indigo-500 
                    dark:focus:ring-indigo-600 
                    rounded-md shadow-sm">{{$producto->descripcion}}</textarea>

                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />

                <x-input-label class="mt-4" for="precio" :value="__('Precio')" />
                <x-text-input  
                id="precio" 
                class="block mt-1 w-full"
                type="number"
                name="precio"
                required autocomplete="precio"
                min="1" 
                step="any"
                value="{{old('nombre', $producto->precio)}}"
                />

                <img
                class=" mb-6 mt-6"
                src="{{$producto->imagen ? asset('storage/' . $producto->imagen) : asset('images/no_imagen.png')}}"
                alt="imagen edicion"
            />
                <x-input-error :messages="$errors->get('precio')" class="mt-2" />   
                    
                    
                    <x-input-label class="mt-4" for="precio" :value="__('Imagen')" />
                        <input
                            type="file"
                            class="p-3 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            name="imagen"
                        />
                        <x-input-error :messages="$errors->get('imagen')" class="mt-2" />     

            </div>


                <div class="flex justify-end mt-4">
                    <x-primary-button>
                        {{ __('Actualizar') }}
                    </x-primary-button>
                </div>
        </form>
    </div>
</x-app-layout>