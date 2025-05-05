<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{

    public function index()
    {
        $productos = Productos::all();
        return view("product", compact("productos"));
        //return view("product",get_defined_vars());
    }

    public function edit($id)
    {
        $producto = Productos::findOrFail($id);
        return $producto;
        // return view('productos.edit', compact('producto'));
    }
    public function eliminar($id)
    {
        $producto = Productos::find($id);
        return $producto->delete($id);
    }

    // Método para almacenar un nuevo producto
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric|min:0',
        ]);


        // Crear el nuevo producto y guardarlo en la base de datos
        Productos::create([
            'name' => $request->nombre,
            'precio' => (int) $request->precio,
            'descripcion' => $request->descripcion,
        ]);
    }
    public function actualizar(Request $request,$id)
    {
        $request->validate([
            'nombre' => 'required|string|',
            'descripcion' => 'required|string|',
            'precio' => 'required|numeric|',
            
        ]);

        Productos::put([
          $producto = Productos::find($id)
        ]);
       
    }
};

// $producto = Producto::find(1);
// $producto->update([
//     'precio' => 1300
// ]);

