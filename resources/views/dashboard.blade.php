<x-app-layout>


    <!-- Start -->
    <section class="relative md:py-24 py-16">
        <div class="container">
            <div class="grid grid-cols-1 text-center">
                <h3 class="md:text-[30px] text-[26px] font-semibold dark:text-white">Discover Items</h3>
            </div><!--end grid-->

            
            <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 mt-10 gap-[30px]">
                @foreach ($productos as $producto)
                <div class="group relative overflow-hidden p-2 rounded-lg bg-white dark:bg-slate-900 border border-gray-100 dark:border-gray-800 hover:shadow-md dark:shadow-md hover:dark:shadow-gray-700 transition-all duration-500 hover:-mt-2 h-fit">
                    <div class="relative overflow-hidden">
                        <div class="relative overflow-hidden rounded-lg">
                            <img src="https://shreethemes.in/giglink/layouts/assets/images/items/1.jpg" class="rounded-lg shadow-md dark:shadow-gray-700 group-hover:scale-110 transition-all duration-500" alt="">
                        </div>

                        <div class="absolute -bottom-20 group-hover:bottom-1/2 group-hover:translate-y-1/2 right-0 left-0 mx-auto text-center transition-all duration-500">
                            <a href="item-detail.html" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Comprar</a>                                
                        </div>

                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-all duration-500">
                            <a href="javascript:void(0)" class="btn btn-icon btn-sm rounded-full bg-violet-600 hover:bg-violet-700 border-violet-600 hover:border-violet-700 text-white"><i class="mdi mdi-plus"></i></a>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="flex ">
                            <img src="https://shreethemes.in/giglink/layouts/assets/images/items/1.jpg" class="rounded-full h-8 w-8" alt="">
                            <a href="creator-profile.html" class="ml-2 text-[15px] font-medium text-slate-400 hover:text-violet-600 dark:text-white">@StreetBoy</a>
                        </div>

                        <div class="flex mb-4">
                            <div class="m-auto">
                                <a href="item-detail.html" class="font-semibold hover:text-violet-600 dark:text-white text-2xl">{{$producto->nombre}}</a>
                            </div>
                            
                        </div>

                        <div class="flex p-2 bg-gray-50 dark:bg-slate-800 rounded-lg shadow dark:shadow-gray-700">
                            <div class="m-auto">
                                <span class="text-[16px] text-2xl  text-slate-400 dark:text-white">{{$producto->precio}}<i class="fa-solid fa-tag"></i></span>
                            </div>
                        </div>
                    </div>
                </div><!--end content-->
                @endforeach
                
            </div><!--end grid-->

            

    </section> <!--end section-->

    <!-- End -->
</x-app-layout>
