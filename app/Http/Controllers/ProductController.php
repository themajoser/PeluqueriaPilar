<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
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

        $Product = Product::create($request->all());

        return redirect()->route('products.edit', compact('Product'))->with('flash', 'El producto ha sido creado correctamente');
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
           'description' => 'required | max:45',

        ], [
            'name.required' => 'El nombre del producto es requerido',
            'name.max' => 'Tamaño invalido (maximo 45 caracteres)',
            'description.max' => 'Tamaño de la descripcion invalido (maximo 100 caracteres)'
        ]);

        $Product->updater = auth()->user()->id;

        $Product->update($request->all());

        return redirect()->route('products.index', compact('Product'))->with('flash', 'El producto ' . $Product->name . ' ha sido actualizado correctamente');
    }

    public function destroy(Product $Product)
    {


        $Product->delete();
        return redirect()->route('products.index')->with('flash', 'El producto ' . $Product->name . ' ha sido borrado correctamente');
    }
}
