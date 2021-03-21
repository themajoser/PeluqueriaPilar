@extends('layouts.app')

@section('title',  'Peluquería Pilar | Productos')

@section('header')
    Productos
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('partials.message')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lista de productos</h4>
                </div>
                <div class="card-body">
                    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                      <i class="fas fa-search" aria-hidden="true"></i>
                      <input class="form-control form-control-sm ml-3 w-75" aria-controls="photographies-table" id="search" type="text" placeholder="Search"
                        aria-label="Search">
                    </form>
                    <div class="table-responsive">
                        <table id='product-table' class="table">
                            <thead class="text-primary">
                            <th class="text-center">Creado:</th>
                            <th>Nombre</th>
                            <th class="text-center">Marca</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Stock</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($Products as $product)
                                <tr class="">
                                    <td class="text-center">{{ $product->created_at }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td class="text-center">{{ $product->brand }}</td>
                                    <td class="text-center {{ $product->state == "above"? "table-danger":"table-success"  }}">{{ $product->state == "above"? "Crítico" : "Suficiente" }}</td>
                                    <td class="text-center">{{ $product->stock }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                        <a href="{{ route('products.show', $product) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm">
                                            <i class="now-ui-icons location_pin"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $product) }}" rel="tooltip" class="btn btn-success btn-icon btn-sm">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
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

    <script type="text/javascript" src="/js/datatables.min.js"></script>
    <script src="/js/plugins/sweetalert2.min.js"></script>
    <script>
        $(function () {
            var table =    $('#product-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                'order': [[ 0, "desc" ]]
            });
            $('#search').on( 'keyup', function () {
                        table.search( this.value ).draw();
                    } );
            $('#product-table_filter').hide();
        });
    </script>
    <script>
        $(document).ready(function () {
            let dtable = $('.table');
            dtable.on('click', '.delete', function (e) {
                e.preventDefault();
                swal({
                    title: 'Borrar producto',
                    text: "¿Estas seguro que quieres eliminar este producto?",
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
