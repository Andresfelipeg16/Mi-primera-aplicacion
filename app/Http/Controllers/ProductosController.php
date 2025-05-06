<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductosController extends Controller
{

    public function index()
    {
        $productos = Productos::all();
        return view("product", compact("productos"));

    }

    public function edit($id)
    {
        $producto = Productos::findOrFail($id);
        return response()->json($producto);
    }
    public function eliminar($id)
    {
        $producto = Productos::find($id);
        return $producto->delete($id);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric|min:0',
        ]);
        Productos::create([
            'name' => $request->nombre,
            'precio' => (int) $request->precio,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }
    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric|min:0',
        ]);

        $producto = Productos::findOrFail($id);

        $producto->update([
            'name' => $request->nombre,
            'precio' => (int) $request->precio,
            'descripcion' => $request->descripcion,
        ]);

        return response()->json(['message' => 'Producto actualizado exitosamente']);
    }
};
