<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editProductForm">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <input type="hidden" id="edit_product_id" name="id">
                    
                    <div class="form-group">
                        <label for="edit_nombre">Nombre</label>
                        <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                        <div class="invalid-feedback" id="nombre-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="edit_precio">Precio</label>
                        <input type="number" class="form-control" id="edit_precio" name="precio" required>
                        <div class="invalid-feedback" id="precio-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="edit_descripcion">Descripción</label>
                        <textarea class="form-control" id="edit_descripcion" name="descripcion" required></textarea>
                        <div class="invalid-feedback" id="descripcion-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="saveBtn" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div> 