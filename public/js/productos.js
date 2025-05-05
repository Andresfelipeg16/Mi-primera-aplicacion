document.addEventListener('DOMContentLoaded', function() {

    function openEditModal(id) {
        fetch(`/${id}`)
            .then(response => response.json())
            .then(producto => {
                document.getElementById('edit_product_id').value = producto.id;
                document.getElementById('edit_nombre').value = producto.name;
                document.getElementById('edit_precio').value = producto.precio;
                document.getElementById('edit_descripcion').value = producto.descripcion;
                
                
                const modal = new bootstrap.Modal(document.getElementById('editProductModal'));
                modal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: '¡Error!',
                    text: 'Error al cargar los datos del producto',
                    icon: 'error',
                    draggable: true
                });
            });
    }

    document.getElementById('editProductForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const id = document.getElementById('edit_product_id').value;
        const formData = new FormData(this);

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Quieres guardar los cambios?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar',
            draggable: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/product/put/${id}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errors => Promise.reject(errors));
                    }
                    return response.json();
                })
                .then(data => {
                    bootstrap.Modal.getInstance(document.getElementById('editProductModal')).hide();
                    
                    Swal.fire({
                        title: '¡Guardado!',
                        text: 'Los cambios han sido guardados correctamente',
                        icon: 'success',
                        draggable: true
                    }).then(() => {
                        window.location.reload();
                    });
                })
                .catch(errors => {
                    if (errors.errors) {
                        Object.keys(errors.errors).forEach(field => {
                            const errorDiv = document.getElementById(`${field}-error`);
                            if (errorDiv) {
                                errorDiv.textContent = errors.errors[field][0];
                                document.getElementById(`edit_${field}`).classList.add('is-invalid');
                            }
                        });

                        Swal.fire({
                            title: '¡Error!',
                            text: 'Por favor, verifica los campos del formulario',
                            icon: 'error',
                            draggable: true
                        });
                    }
                });
            }
        });
    });
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            openEditModal(id);
        });
    });
    document.querySelectorAll('form[action*="eliminar"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                draggable: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
}); 