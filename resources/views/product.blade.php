<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">acciones</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($productos as $producto)
                <tr>
                    <td> <strong>{{ $producto->name }}</strong><br></td>
                    <td> Precio: ${{ $producto->precio }}<br></td>
                    <td> Descripción: {{ $producto->descripcion }}</td>
                    <td>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary">Editar</a>
                        <!-- Formulario para eliminar el producto -->
                        <form action="{{ route('productos.eliminar', $producto->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE') <!-- Esto simula una solicitud DELETE -->
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                            <form>
                                <div>

                                </div>
                               
                            </form>

                        </form>
                    </td>

                </tr>
            @endforeach
            <form action="{{ route('productos.create') }}" method="POST">
                @csrf 
                
                <div class="input-group mb-3">
                    <span class="input-group-text" id="nombre">Nombre</span>
                    <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre" name="nombre" required>
                </div>      

                <div class="input-group mb-3">
                    <span class="input-group-text" id="precio">Precio</span>
                    <input type="number" class="form-control" placeholder="Precio" aria-label="Precio" name="precio" required>
                    <span class="input-group-text">.00</span>
                </div>
            
            
                <div class="input-group mb-3">
                    <span class="input-group-text" id="descripcion">Descripción</span>
                    <input type="text" class="form-control" placeholder="Descripción" aria-label="Descripción" name="descripcion" required>
                </div>
            
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
            

            </div>

        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>
