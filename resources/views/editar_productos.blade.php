<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-input-label for="nombre" :value="__('Nombre')" />
                <x-text-input id="nombre" class="block mt-1 w-full"
                type="text"
                name="nombre"
                required 
                autocomplete="nombre"
                value="{{old('nombre')}}"
                />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />

                <x-input-label class="mt-4" for="nombre" :value="__('Descripcion')" />
                <x-text-area 
                name="descripcion" 
                style="resize: none;"
                value="{{old('descripcion')}}"
                />
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
                value="{{old('precio')}}"
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
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>

                @if(session()->has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-blue-100 border border-blue-400 text-blue-700 px-8 py-3 rounded relative m-4" role="alert">
                    <span class="block sm:inline">{{ session()->get('message') }}</span>
                </div>
                @endif

        </form>
    </div>
</x-app-layout>