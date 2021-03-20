{{-- @extends('layouts.app')

@section('title', 'Historial')

@section('header')
    Historial
@endsection


@section('content')
--}}
    <div class="row">
        <div class="col-md-12">
            @include('partials.message')
            <div class="card">

                <div class="card-body">

                    <form action="{{ route('movements.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Crear movimiento</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group has-label">
                                            <label for="product_id">Producto:</label>
                                            <select name="product_id" class="selectpicker form-control"
                                                data-style="btn btn-info btn-round">
                                                <option value="">Elige un producto</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('product_id', '<span class="form-text text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">


                                        <div class="form-group has-label">
                                            <label for="min">Cantidad:</label>
                                            <input type="number" name="quantity" step="1"
                                                class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}"
                                                placeholder="Escribe la cantidad  del producto" value="">
                                            {!! $errors->first('quantity', '<span class="form-text text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group has-label">
                                            <label for="operation">Operación:</label>
                                            <select name="operation" class="selectpicker form-control"
                                                data-style="btn btn-info btn-round">
                                                <option value="">Elige un producto</option>
                                                @foreach ($operations as $operation)
                                                    <option value="{{ $operation }}">{{ ($operation=="add"? 'Añadir': 'Quitar') }}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('product_id', '<span class="form-text text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                        </div>

                    </form>
                </div>


                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </div>
    </div>

    {{-- @endsection --}}
