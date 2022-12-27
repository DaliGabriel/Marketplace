<?php

namespace App\Http\Controllers;

use App\Models\Productos;
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
            'productos' => Productos::latest()->get()
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
    public function edit(Productos $productos)
    {
        //
        return view('editar_productos');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productos $productos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productos $productos)
    {
                //El usuario que quiere editar el post tiene que ser el dueño
                if ($productos->user_id != auth()->id()){
                    abort(403, 'Upss, parece que no tienes acceso');
                }
                
                //Borrar la tarea en base al id
                $productos->delete();
         
                //Redirigir al usuario a index
                return redirect(route('tareas.index'))->with('message_delete', 'Tarea Eliminada con exito');
    }
}
