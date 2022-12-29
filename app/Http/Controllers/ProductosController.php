<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\ordenes;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard', [
            'productos' => Productos::with('user')->latest()->get()
        ]);
    }

    public function agregar_productos()
    {

        //Vista de agregar productos
        return view('agregar_productos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Guardar tarea en base de datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required',
        ]);

        if($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('imagenes_productos', 'public');
        }

        //Insertar nueva tarea en la base de datos
        $request->user()->productos()->create($validated);        

        //Redireccionar al usuario a index
        return redirect(route('agregar_productos'))->with('message', 'Producto Añadido con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function show(Productos $productos)
    {
        //
        return view('mostrar_producto', [
            'producto' => $productos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit(Productos $producto)
    {
        //Mostrar la vista editar con los modelos de la clase tarea
        return view('editar_productos', [
            'producto' => $producto,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productos $producto)
    {
        //Make suer logged in user is owner
        if ($producto->user_id != auth()->id()){
            abort(403, 'Upss, parece que no tienes acceso');
        }

        //Guardar tarea en base de datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required',
        ]);


        if($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('imagenes_productos', 'public');
        }

        $producto->update($validated);

        //Redireccionar al usuario a index
        return redirect(route('productos.index'))->with('message', 'Producto actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productos $producto)
    {
        //El usuario que quiere editar el post tiene que ser el dueño
        if ($producto->user_id != auth()->id()){
            abort(403, 'Upss, parece que no tienes acceso');
        }
        
        //Borrar la tarea en base al id
        $producto->delete();
 
        //Redirigir al usuario a index
        return redirect(route('productos.index'))->with('message_delete', 'Producto Eliminado con exito');
    }


    /**
     * Stripe checkout.
    */
    public function checkout(Productos $producto){
        
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [[
              'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                  'name' => $producto->nombre,
                ],
                'unit_amount' => $producto->precio*100,
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('exito', true),
            'cancel_url' => route('fallo', true),
        ]);

        
        return redirect($checkout_session->url);

        
    }

    public function exito(){

        return redirect(route('productos.index'))->with('message', 'Producto Comprado con exito');

    }

    public function fallo(){
        return redirect(route('productos.index'))->with('message_delete', 'No se pudo realizar la compra :(');
    }
}
