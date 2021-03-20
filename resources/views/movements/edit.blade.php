@extends('layouts.app')

@section('title', 'Guia | Puntos de interés | Editar')

@section('header')
    Editar Punto de interés
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('partials.message')
            <form action="{{route('products.update', $Product)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modificar Producto</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-label">
                                    <label for="name">Nombre:</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe un nombre" value="{{ old('name', $Product->name)  }}">
                                    {!! $errors->first('name', '<span class="form-text text-danger">:message</span>') !!}
                                </div>


                                <div class="form-group has-label">
                                    <label for="brand">Marca:</label>
                                    <input type="text" name="brand" class="form-control {{ $errors->has('brand') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe la marca del producto" value="{{ old('brand', $Product->brand) }}">
                                    {!! $errors->first('brand','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="min">Cantidad mínima de stock:</label>
                                    <input type="number" name="min" step="1" class="form-control {{ $errors->has('min') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe la cantidad mínimo del producto" value="{{ old('min', $Product->min) }}">
                                    {!! $errors->first('min','<span class="form-text text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-label">
                                    <label for="min">Stock:</label>
                                    <input type="number" name="stock" step="1" class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe la cantidad de stock del producto" value="{{ old('min', $Product->stock) }}">
                                    {!! $errors->first('stock','<span class="form-text text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group has-label">
                                    <label for="price">Precio:</label>
                                    <input type="number" name="price"  min="0.00" step="0.01" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe el precio del producto" value="{{ old('price', $Product->price) }}">
                                    {!! $errors->first('price','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="description">Descripcion:</label>
                                    <textarea name="description"
                                              class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                              placeholder="Escribe una descripcion del producto">{{ old("description", $Product->description) }}</textarea>
                                    {!! $errors->first('description','<span class="form-text text-danger">:message</span>') !!}
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-check text-center">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/js/plugins/bootstrap-selectpicker.js"></script>
@endpush
