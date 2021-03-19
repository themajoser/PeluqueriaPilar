<div class="modal fade" id="createProducts" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="{{ route('products.store','#product') }}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Crear producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre del producto: </label>
                        <input type="text" id="products-title" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Introduce un nombre para el producto" required>
                        {!! $errors->first('name', '<span class="form-text text-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        if (window.location.hash === '#product') {
            $('#createProducts').modal('show');
        }
        $('#createProducts').on('hide.bs.modal', function () {
            window.location.hash = '#';
        });
        $('#createProducts').on('shown.bs.modal', function () {
            $('#products-title').focus();
            window.location.hash = '#product';
        });
    </script>
@endpush
