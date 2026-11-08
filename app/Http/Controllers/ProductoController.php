<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::latest()->get();
        return view('productos.index', compact('productos'));
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_detallada' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'tiempo_entrega' => 'nullable|string|max:50',
            'porciones' => 'nullable|string|max:50',
            'tags' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagenPath = 'assets/recetas/receta1.jpg'; // Imagen por defecto si no sube una

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('postres', 'public');
            $imagenPath = 'storage/' . $path;
        }

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion_corta' => $request->descripcion_corta,
            'descripcion_detallada' => $request->descripcion_detallada,
            'precio' => $request->precio,
            'tiempo_entrega' => $request->tiempo_entrega ?? '20-30 min',
            'porciones' => $request->porciones ?? 'Individual',
            'tags' => strtolower($request->tags),
            'imagen' => $imagenPath,
        ]);

        return redirect()->route('home')->with('success', '¡El nuevo postre ha sido agregado con éxito al catálogo!');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_detallada' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'tiempo_entrega' => 'nullable|string|max:50',
            'porciones' => 'nullable|string|max:50',
            'tags' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('postres', 'public');
            $producto->imagen = 'storage/' . $path;
        }

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion_corta' => $request->descripcion_corta,
            'descripcion_detallada' => $request->descripcion_detallada,
            'precio' => $request->precio,
            'tiempo_entrega' => $request->tiempo_entrega,
            'porciones' => $request->porciones,
            'tags' => strtolower($request->tags),
        ]);

        return redirect()->route('productos.show', $producto->id)->with('success', '¡Postre actualizado con éxito!');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('home')->with('success', 'El postre ha sido eliminado correctamente.');
    }
}