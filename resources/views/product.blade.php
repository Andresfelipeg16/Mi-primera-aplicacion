<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestión de Productos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    
    <div class="container mt-4">
        <h2 class="mb-4">Lista de Productos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td><strong>{{ $producto->name }}</strong></td>
                        <td>Precio: ${{ $producto->precio }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>
                            <button class="btn btn-primary btn-edit" data-id="{{ $producto->id }}">
                                Editar
                            </button>
                            <form action="{{ route('productos.eliminar', $producto->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/productos.js') }}"></script>
</body>

</html>
