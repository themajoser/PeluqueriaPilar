
@extends('layouts.app')

@section('title', 'Historial')

@section('header')
    Historial
@endsection


@section('content')
@include('movements.create',['products'=>$products,'operations'=>$operations])
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Historial</h4>
                </div>
                <div class="card-body">

                    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                      <i class="fas fa-search" aria-hidden="true"></i>
                      <input class="form-control form-control-sm ml-3 w-75" aria-controls="movements-table" id="search" type="text" placeholder="Search"
                        aria-label="Search">
                    </form>
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
                            @foreach($Movements as $movement)
                                <tr class="">
                                    <td class="text-center">{{ $movement->id }}</td>
                                    <td class="text-center">{{ $movement->product->name }}</td>
                                    <td class="text-center">{{ $movement->operation == "add" ? "+" : "-" }}{{ $movement->quantity }}</td>
                                    <td class="text-center"> {{ $movement->stock_after   }}</td>
                                    <td class="text-center">{{ $movement->date_create }}</td>
                                    <td>
                                        <a href="{{ route('movements.show', $movement) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm">
                                            <i class="now-ui-icons location_pin"></i>
                                        </a>
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
                "lengthChange": false,
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
