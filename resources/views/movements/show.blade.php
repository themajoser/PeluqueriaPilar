@extends('layouts.app')

@section('title', 'Productos | Ver')

@section('header')
    Ver Producto
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header">
                    <h4 class="card-title text-center">Producto: {{  $Product->name  }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-left">
                                <p><span class="font-weight-bold">Nombre:</span> {{ $Product->name }}</p>
                                <p><span class="font-weight-bold">Marca:</span> {{ $Product->brand }}</p>
                                <p><span class="font-weight-bold">Mínimo de stock:</span> {{ $Product->min }}</p>
                                <p><span class="font-weight-bold">Estado:</span> {{ $Product->state }} </p>
                                <p><span class="font-weight-bold">Precio:</span> {{ $Product->price }} </p>
                                <p><span class="font-weight-bold">Descripción:</span> {{ $Product->description }} </p>
                                <p><span class="font-weight-bold">Stock:</span> {{ $Product->stock }} </p>
                                <p><span class="font-weight-bold">Creado :</span>  {{$Product->created_at }}</p>
                                <p><span class="font-weight-bold">Última actualización:</span> {{$Product->updated_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection


