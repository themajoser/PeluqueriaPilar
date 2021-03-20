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
                    <div class="table-responsive">
                        <table id='movement-table' class="table">
                            <thead class="text-primary">
                            <th class="text-center">Id</th>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Operación</th>
                            <th class="text-center">Valor Posterior</th>
                            <th class="text-center">Fecha</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($Product->movements as $movement)
                                <tr class="">
                                    <td class="text-center">{{ $movement->id }}</td>
                                    <td class="text-center">{{ $movement->product->name }}</td>
                                    <td class="text-center">{{ $movement->operation == "add" ? "+" : "-" }}{{ $movement->quantity }}</td>
                                    <td class="text-center"> {{ $movement->stock_after   }}</td>
                                    <td class="text-center">{{ $movement->date_create }}</td>
                                    <td>
                                        <form action="{{ route('movements.destroy', $movement) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon btn-sm delete">
                                                <i class="now-ui-icons ui-1_simple-remove"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="/js/plugins/bootstrap-selectpicker.js"></script>
    <script type="text/javascript" src="/js/datatables.min.js"></script>
    <script src="/js/plugins/sweetalert2.min.js"></script>
    <script>
        $(function () {
            var table =    $('#movement-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
            $('#search').on( 'keyup', function () {
                        table.search( this.value ).draw();
                    } );
            $('#movement-table_filter').hide();
        });
    </script>
    <script>
        $(document).ready(function () {
            let dtable = $('.table');
            dtable.on('click', '.delete', function (e) {
                e.preventDefault();
                swal({
                    title: 'Borrar movimiento',
                    text: "¿Estas seguro que quieres eliminar este movimiento?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Borrar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonClass: 'btn btn-danger',
                    cancelButtonClass: 'btn btn-info',
                    buttonsStyling: false
                }).then(function () {
                    e.currentTarget.parentElement.submit();
                }, function (dismiss) {
                    if (dismiss === 'cancel') {
                        swal(
                            'Cancelado la operacion',
                        )
                    }
                });
            });
        });
    </script>
@endpush
