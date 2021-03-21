<?php

namespace App\Http\Controllers;
use App\Product;
use App\Movement;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovementsController extends Controller
{



    public function index()
    {
        $Movements = Movement::all();
        $products= Product::all();
        $operations= Movement::OPERATIONS;

        return view('movements.index', compact('Movements','products','operations'));
    }


    public function store(Request $request)
    {


        $this->validate($request, [
            'product_id' => 'required ',
            'operation'=>'required ',
            'quantity' => 'required | min:1'

        ], [
            'product_id.required' => 'El producto requerido',
            'operation.required' => 'La operación es requerida',
            'quantity.required' => 'La cantidad es requerida',
            'quantity.min'   => 'La cantidad no puede ser 0'
        ]);

        $Movement = Movement::create($request->all());

        return redirect()->route('movements.index', compact('Movement'))->with('flash', 'El movimiento ' . $Movement->name . ' ha sido creado correctamente');
    }

    public function show(Movement $Movement)
    {
        return view('movements.show', compact('Movement'));
    }

    public function edit(Movement $Movement)
    {

        $Movement_relation = Movement::get();
        return view('movements.edit', compact('Movement'));
    }




    public function destroy(Movement $Movement)
    {
        $Movement->delete();
        return redirect()->route('movements.index')->with('flash', 'El Movemento ' . $Movement->name . ' ha sido borrado correctamente');
    }
}
