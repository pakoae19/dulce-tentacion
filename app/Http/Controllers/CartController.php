<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CartController extends Controller
{
    // Mostrar la vista principal del carrito
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Agregar producto al carrito vía AJAX
    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:productos,id',
            'cantidad' => 'nullable|integer|min:1'
        ]);

        $producto = Producto::findOrFail($request->id);
        $cart = session()->get('cart', []);
        $cantidad = (int) $request->get('cantidad', 1);

        if (isset($cart[$producto->id])) {
            $cart[$producto->id]['cantidad'] += $cantidad;
        } else {
            $cart[$producto->id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => (float) $producto->precio,
                'imagen' => $producto->imagen,
                'cantidad' => $cantidad
            ];
        }

        session()->put('cart', $cart);
        session()->save(); // Persistir inmediatamente en la sesión de Laravel

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'totalItems' => array_sum(array_column($cart, 'cantidad'))
        ]);
    }

    // Actualizar cantidad de un producto
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'cantidad' => 'required|integer|min:0'
        ]);

        $cart = session()->get('cart', []);
        $id = $request->id;
        $cantidad = (int) $request->cantidad;

        if (isset($cart[$id])) {
            if ($cantidad > 0) {
                $cart[$id]['cantidad'] = $cantidad;
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
            session()->save();
        }

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'totalItems' => array_sum(array_column($cart, 'cantidad'))
        ]);
    }

    // Eliminar producto del carrito
    public function remove(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $cart = session()->get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            session()->save();
        }

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'totalItems' => array_sum(array_column($cart, 'cantidad'))
        ]);
    }
}