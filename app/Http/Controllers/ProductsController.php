<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Movement;

class ProductsController extends Controller
{
    public $timestamps = true;

    public function index()
    {
        $Products = Product::all();
        return view('products.index', compact('Products'));
    }

    public function store(Request $request)
    {


        $this->validate($request, [
            'name' => 'required | max:45'
        ], [
            'name.required' => 'El nombre del producto es requerido',
            'name.max' => 'Tamaño invalido (maximo 45 caracteres)'
        ]);

        $product = Product::create($request->all());

        return redirect()->route('products.edit', compact("product"))->with('flash', 'El producto ha sido creado correctamente');
    }

    public function show(Product $Product)
    {


        return view('products.show', compact('Product'));
    }

    public function edit(Product $Product)
    {

        $Product_relation = Product::get();
        return view('products.edit', compact('Product'));
    }

    public function update(Request $request, Product $Product)
    {


        $this->validate($request, [
           'name' => 'required | max:45',
           'description' => 'required | max:100',

        ], [
            'name.required' => 'El nombre del producto es requerido',
            'name.max' => 'Tamaño invalido (maximo 45 caracteres)',
            'min.required' => 'El mínimo stock del producto es requerido'
        ]);

        $Product->update($request->all());

        return redirect()->route('products.index', compact('Product'))->with('flash', 'El producto ' . $Product->name . ' ha sido actualizado correctamente');
    }

    public function destroy(Product $Product)
    {


        $Product->delete();
        return redirect()->route('products.index')->with('flash', 'El producto ' . $Product->name . ' ha sido borrado correctamente');
    }
}
