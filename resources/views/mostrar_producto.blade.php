<x-app-layout>

    <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 gap-[30px] mt-8">

        @if(session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-blue-100 border border-blue-400 text-blue-700 px-8 py-3 rounded relative m-4" role="alert">
                <span class="block sm:inline">{{ session()->get('message') }}</span>
            </div>
        @endif
        
        <div class="lg:col-span-5 px-2">
            <img src="{{$producto->imagen ? asset('storage/' . $producto->imagen) : asset('images/no_imagen.png')}}" class="rounded-md shadow dark:shadow-gray-700" alt="">

        </div><!--end col-->

        <div class="lg:col-span-7 lg:ml-8 max-w-lg rounded overflow-hidden shadow-lg px-2 relative">
            <div class="absolute top-2 right-1">
                @if ($producto->user->is(auth()->user()))
                <x-dropdown >
                    <x-slot name="trigger">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('productos.edit', $producto)">
                            {{ __('Editar') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('productos.destroy', $producto) }}">
                            @csrf
                            @method('delete')
                            <x-dropdown-link :href="route('productos.destroy', $producto)" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Borrar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endif 
            </div>

            <h2 class="text-heading text-lg md:text-xl lg:text-2xl 2xl:text-3xl font-bold hover:text-black mb-3.5 mt-2 dark:text-white dark:hover:text-purple-200 ">{{$producto->nombre}}</h2>

            <span class=" text-slate-400 block mt-2 dark:text-white">Vendedor: <span class="text-violet-600">@<span>{{$producto->user->name}}</span></span></span>
        
            <p class="text-body text-sm lg:text-base leading-6 lg:leading-8 dark:text-white">{{$producto->descripcion}}</p>
        
            <div class="mt-4">
                <div class="flex items-center mt-5"><div class="text-heading font-bold text-base md:text-xl lg:text-2xl 2xl:text-4xl pe-2 md:pe-0 lg:pe-2 2xl:pe-0 dark:text-white">${{number_format($producto->precio)}}</div></div>
            </div>

            <a href="/checkout/{{$producto->id}}">
                <button class="text-[13px] 
                    md:text-sm 
                    leading-4 
                    inline-flex 
                    items-center 
                    cursor-pointer 
                    transition 
                    ease-in-out 
                    duration-300 
                    font-semibold 
                    font-body 
                    text-center 
                    justify-center 
                    border-0 
                    border-transparent 
                    placeholder-white 
                    focus-visible:outline-none 
                    focus:outline-none 
                    rounded-md  
                    bg-slate-900 
                    text-white 
                    px-5 
                    md:px-6 
                    lg:px-8 
                    py-4 
                    md:py-3.5 
                    lg:py-4 
                    hover:text-white 
                    hover:bg-slate-700
                    hover:shadow-cart 
                    w-full 
                    h-10 
                    md:h-12
                    mt-4
                    mb-4">
                    Comprar
                </button>
            </a>
        </div><!--end col-->
    </div>

</x-app-layout>