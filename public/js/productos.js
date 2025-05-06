
let dataTableInstance = null;

document.addEventListener('DOMContentLoaded', function() {
   
    $('#productosTable').css('visibility', 'hidden');
    
   
    initializeDataTable();
    
    
    setupEventHandlers();
});

function initializeDataTable() {
    
    if ($.fn.dataTable.isDataTable('#productosTable')) {
        $('#productosTable').DataTable().destroy();
    }
    
   
    $('#productosTable_wrapper').remove();
    
    
    dataTableInstance = $('#productosTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        responsive: true,
        scrollCollapse: true,
        bAutoWidth: false,
        deferRender: true,
        stateSave: false,
        destroy: true,
        
        drawCallback: function() {
            $('#productosTable').css('visibility', 'visible');
        },
      
        processing: true,
        orderClasses: false
    });
    
    return dataTableInstance;
}

function setupEventHandlers() {
    
    $(document).on('click', '.btn-edit', function() {
        const id = $(this).data('id');
        openEditModal(id);
    });
    
    
    document.getElementById('editProductForm').addEventListener('submit', handleEditFormSubmit);
    
  
    $(document).on('submit', 'form[action*="eliminar"]', handleDeleteForm);
}

function openEditModal(id) {
   
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').text('');
    
    
    document.getElementById('edit_product_id').value = '';
    document.getElementById('edit_nombre').value = '';
    document.getElementById('edit_precio').value = '';
    document.getElementById('edit_descripcion').value = '';
    
   
    fetch(`/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar los datos');
            }
            return response.json();
        })
        .then(producto => {
           
            document.getElementById('edit_product_id').value = producto.id;
            document.getElementById('edit_nombre').value = producto.name || '';
            document.getElementById('edit_precio').value = producto.precio || '';
            document.getElementById('edit_descripcion').value = producto.descripcion || '';
            
            
            $('#editProductModal').modal('show');
        })
        .catch(error => {
            console.error('Error:', error);
            
            Swal.fire({
                title: '¡Error!',
                text: 'Error al cargar los datos del producto',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        });
}

function handleEditFormSubmit(e) {
    e.preventDefault();
    
  
    if (!validateEditForm()) {
        return false;
    }
    
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
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            
            const saveBtn = document.getElementById('saveBtn');
            const textoOriginal = saveBtn.innerHTML;
            saveBtn.disabled = true;
            saveBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...';
            
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
           
                $('#editProductModal').modal('hide');
                
               
                Swal.fire({
                    title: '¡Guardado!',
                    text: 'Los cambios han sido guardados correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    
                    window.location.href = window.location.pathname + '?t=' + new Date().getTime();
                });
            })
            .catch(errors => {
              
                saveBtn.disabled = false;
                saveBtn.innerHTML = textoOriginal;
                
            
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
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        }
    });
}

function handleDeleteForm(e) {
    e.preventDefault();
    
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
          
            const submitBtn = $(this).find('button[type="submit"]');
            const originalText = submitBtn.html();
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            
       
            this.submit();
        }
    });
}

function validateEditForm() {
    let isValid = true;
    
    
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').text('');
    
    
    const nombre = document.getElementById('edit_nombre').value.trim();
    if (!nombre) {
        document.getElementById('edit_nombre').classList.add('is-invalid');
        document.getElementById('nombre-error').textContent = 'El nombre es obligatorio';
        isValid = false;
    }
    
   
    const precio = document.getElementById('edit_precio').value.trim();
    if (!precio || isNaN(precio) || parseFloat(precio) <= 0) {
        document.getElementById('edit_precio').classList.add('is-invalid');
        document.getElementById('precio-error').textContent = 'Ingrese un precio válido mayor a 0';
        isValid = false;
    }
    
   
    const descripcion = document.getElementById('edit_descripcion').value.trim();
    if (!descripcion) {
        document.getElementById('edit_descripcion').classList.add('is-invalid');
        document.getElementById('descripcion-error').textContent = 'La descripción es obligatoria';
        isValid = false;
    }
    
    return isValid;
} 