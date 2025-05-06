<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-4">Lista de Productos</h2>
        
       
        <div class="table-loading">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Cargando tabla...</span>
            </div>
            <p class="mt-2">Cargando tabla de productos...</p>
        </div>

        <table class="table" id="productosTable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td><strong>{{ $producto->name }}</strong></td>
                        <td>${{ $producto->precio }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm btn-action btn-edit" data-id="{{ $producto->id }}">Editar</button>
                            <form action="{{ route('productos.eliminar', $producto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-action">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <h3>Agregar Nuevo Producto</h3>
            <form action="{{ route('productos.create') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text">Nombre</span>
                    <input type="text" class="form-control" name="nombre" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Precio</span>
                    <input type="number" class="form-control" name="precio" required>
                    <span class="input-group-text">.00</span>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Descripción</span>
                    <input type="text" class="form-control" name="descripcion" required>
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>

    @include('components.edit-modal')
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/productos.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            $(document).on('init.dt', function() {
                $('.table-loading').hide();
            });
        });
    </script>
</body>
</html>
