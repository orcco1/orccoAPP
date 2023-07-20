@extends('layouts.app')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/bs/dt-1.13.5/b-2.4.0/date-1.5.0/r-2.5.0/sc-2.2.0/sb-1.5.0/datatables.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link href="https://cdn.datatables.net/v/bs/dt-1.13.5/b-2.4.0/date-1.5.0/r-2.5.0/sc-2.2.0/sb-1.5.0/datatables.css" rel="stylesheet"/>



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Clientes') }} 
                    <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#nuevoClienteModal">Registrar Nuevo Cliente</button>
                </div>

                <div class="card-body">


                    <table id="tablita" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Empresa</th>
                                <th>Telefono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datos as $dato)
                            <tr>
                                <td>{{ $dato->id}}</td>
                                <td>{{ $dato->nombre_empresa }}</td>
                                <td>{{ $dato->telefono }}</td>
                                <td>
                                     <button class="btn btn-danger btn-sm me-2" onclick="eliminarCliente({{ $dato->id }})">
                                        <i class="fas fa-trash-alt fa-lg"></i>
                                     </button>
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

<!-- Ventana modal para confirmar la eliminación -->
<div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-labelledby="confirmarEliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmarEliminarModalLabel">Confirmar eliminación de cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar el cliente <span id="Id"></span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                <button  type="button" class="btn btn-danger" id="confirmarEliminarBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de registro de nuevo cliente -->
<div class="modal fade" id="nuevoClienteModal" tabindex="-1" aria-labelledby="nuevoClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoClienteModalLabel">Registrar Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('clientes.guardar') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre_empresa">Nombre de la Empresa</label>
                        <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" name="telefono" id="telefono" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="correo_electronico">Correo Electrónico</label>
                        <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" required>
                    </div>
                    <!-- Agrega más campos según los atributos del modelo clientesDB -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Registrar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
   $(document).ready(function() {
        $('#tablita').DataTable({
            lengthMenu: [5, 10, 25, 50]
        });
    });
    
</script>

<script>
    function eliminarCliente(id) {
        $('#Id').text(id);
        $('#confirmarEliminarModal').modal('show');

        // Desvincular los controladores de eventos click anteriores
        $('#confirmarEliminarBtn').off('click');

        // Agregar el nuevo controlador de eventos click
        $('#confirmarEliminarBtn').on('click', function() {
            // Hacer la petición de eliminación del proyecto utilizando el método DELETE
            $.ajax({
                url: '/clientes/eliminar/' + id,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        // Mostrar el toast de éxito
                        toastr.success("El cliente ha sido eliminado con éxito");

                        // Actualizar la tabla de proyectos
                        $('#tablita').DataTable().ajax.reload();
                    } else {
                        // Mostrar el toast de error con el mensaje recibido
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    // Mostrar el toast de error
                    toastr.error("Ha ocurrido un error al eliminar el cliente");
                }
            });

            $('#confirmarEliminarModal').modal('hide');
        });
    }
</script>

<script>
    $(document).ready(function() {
        toastr.options = {
            positionClass: 'toast-top-left',
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            hideMethod: 'slideUp',
            timeOut: 6000
        };

        @if(session('success'))
        toastr.success("Cliente registrado con éxito");
        @endif
    });
</script>


<style>
    .toast-success {
        color: black !important;
    }
</style>

<style>
    .toast-message {
        color: black;
    }
</style>

<style>
    .dataTables_paginate {
      font-size: 16px; /* Ajusta el tamaño de fuente */
    }

    .dataTables_wrapper .dataTables_paginate {
    float: right; /* Alinea el paginador a la derecha */
  }

    .dataTables_paginate .paginate_button {
      margin: 5px; /* Ajusta el espaciado entre los botones */
    }
</style>

@endsection


