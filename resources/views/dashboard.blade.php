<x-app-layout>

    @if(session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-blue-100 border border-blue-400 text-blue-700 px-8 py-3 rounded relative m-4" role="alert">
                <span class="block sm:inline">{{ session()->get('message') }}</span>
            </div>
    @endif

    @if(session()->has('message_delete'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-red-100 border border-red-400 text-red-700 px-8 py-3 rounded relative m-4 text-center" role="alert">
                <span class="block sm:inline">{{ session()->get('message_delete') }}</span>
            </div>
    @endif

    <!-- Start -->
    <section class="relative md:py-24 py-16 px-2">
        <div class="container">
            <div class="grid grid-cols-1 text-center">
                <h3 class="md:text-[30px] text-[26px] font-semibold dark:text-white">Articulos</h3>
            </div><!--end grid-->

            
            <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 mt-10 gap-[30px] ">
                @foreach ($productos as $producto)
                    <div class="group relative overflow-hidden p-2 rounded-lg bg-white dark:bg-slate-900 border border-gray-100 dark:border-gray-800 hover:shadow-md dark:shadow-md hover:dark:shadow-gray-700 transition-all duration-500 hover:-mt-2 h-fit">
                        <a href="/producto/{{$producto->id}}">
                        <div class="relative overflow-hidden">
                            <div class="relative overflow-hidden rounded-lg max-h-56">
                                <img src="{{$producto->imagen ? asset('storage/' . $producto->imagen) : asset('images/no_imagen.png')}}" class="rounded-lg shadow-md dark:shadow-gray-700 group-hover:scale-110 transition-all duration-500 " alt="Imagen producto">
                            </div>

                            <div class="absolute -bottom-20 group-hover:bottom-1/2 group-hover:translate-y-1/2 right-0 left-0 mx-auto text-center transition-all duration-500">
                                <a href="/producto/{{$producto->id}}" class="bg-slate-900 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-full"><i class="fa-solid fa-sack-dollar"></i> Comprar</a>                                
                            </div>

                        </div>

                        <div class="mt-3">
                            <div class="flex ">
                                <a href="creator-profile.html" class="ml-2 text-[15px] font-medium text-slate-400 hover:text-violet-600 dark:text-white">@ {{$producto->user->name}}</a>
                            </div>

                            <div class="flex mb-4">
                                <div class="m-auto">
                                    <a href="/producto/{{$producto->id}}" class="font-semibold hover:text-violet-600 dark:text-white text-lg">{{Str::limit($producto->nombre, '50')}}</a>
                                </div>
                                
                            </div>

                            <div class="flex p-2 bg-gray-50 dark:bg-slate-800 rounded-lg shadow dark:shadow-gray-700">
                                <div class="m-auto">
                                    <span class="text-[16px] text-2xl  text-slate-400 dark:text-white">{{number_format($producto->precio, 2)}}<i class="fa-solid fa-tag"></i></span>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div><!--end content-->
                @endforeach
            </div><!--end grid-->
            

            

    </section> <!--end section-->

    <!-- End -->
</x-app-layout>
