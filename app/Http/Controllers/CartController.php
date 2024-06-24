<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $cart = session()->get('cart', []);
        foreach ($cart as &$item) {
            $item['product']  = Product::with('sizes')->findOrFail($item['product_id']);
        }
        return view('cart', ['cart' => $cart]);
    }

    public function add(Request $request) {
        $product_id = $request -> input('product_id');

        $product = Product::with('sizes')->findOrFail($product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {
            $cart[$product_id]['product_quantity'] ++;
        } else {
            $cart[$product_id] = [
                'product_id' => $product -> product_id,
                'size_id' => $request -> input('size_id'),
                'product_quantity' => 1,
            ];
        }

        $this->save($cart);
        return redirect()->back()->with('status', '¡Producto ha sido añadido al carrito!');
    }

    public function delete($product_id) {
        $cart = session()->get('cart', []);
    
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            $this->save($cart);
            return redirect()->back()->with('status', '¡Producto eliminado del carrito!');
        } else {
            return redirect()->back()->with('status', 'El producto no existe en el carrito.');
        }
    }

    public function update(Request $request) {
        $cart = session()->get('cart', []);
    
        $product_id = $request->input('product_id');
        $size_id = $request->input('size_id');
        $product_quantity = $request->input('product_quantity');
    
        if (isset($cart[$product_id])) {
            if ($product_quantity > 0) {
                $cart[$product_id]['size_id'] = $size_id;
                $cart[$product_id]['product_quantity'] = $product_quantity;
                $this->save($cart);
                return redirect()->back()->with('status', '¡Cantidad actualizada en el carrito!');
            } else {
                unset($cart[$product_id]);
                $this->save($cart);
                return redirect()->back()->with('status', '¡Producto eliminado del carrito!');
            }
        } else {
            return redirect()->back()->with('status', 'El producto no existe en el carrito.');
        }
    }

    public function clear() {
        $this->save([]);
        return redirect()->back()->with('status', '¡Carrito vaciado!');
    }
    
    public function save($cart){
        session()->put('cart', $cart);
    }

}
