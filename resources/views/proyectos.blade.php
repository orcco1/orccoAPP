@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.datatables.net/v/bs/dt-1.13.5/b-2.4.0/date-1.5.0/r-2.5.0/sc-2.2.0/sb-1.5.0/datatables.css" rel="stylesheet"/>
<script src="https://cdn.datatables.net/v/bs/dt-1.13.5/b-2.4.0/date-1.5.0/r-2.5.0/sc-2.2.0/sb-1.5.0/datatables.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Proyectos') }}
                <a href="#" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#crearProyectoModal">
                Crear Nuevo Proyecto
                </a>
            </div>

                <div class="card-body">
                    @error('id_proyecto')
                         <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <table id="tablita" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Proyecto</th>
                                <th>Cliente</th>
                                <th>Encargado</th>
                                <th>Fecha</th>
                                <th>Ubicacion</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datos as $dato)
                            <tr>
                                <td>{{ $dato->id_proyecto }}</td>
                                <td>{{ $dato->proyecto }}</td>
                                <td>{{ $dato->cliente }}</td>
                                <td>{{ $dato->encargado }}</td>
                                <td>{{ $dato->fecha_inicio }}</td>
                                <td>{{ $dato->ubicacion }}</td>
                                <td>
                                    @if ($dato->activo == 0)
                                        Inactivo
                                    @else
                                        Activo
                                    @endif
                                </td>
                                <td>
                                    <div class="button-container d-flex">
                                        <button class="btn btn-warning btn-sm me-2" onclick="editarProyecto({{ $dato->id_proyecto }})" data-id="{{ $dato->id_proyecto }}">
                                            <i class="fas fa-pencil-alt fa-lg"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm me-2" onclick="eliminarProyecto({{ $dato->id_proyecto }})">
                                            <i class="fas fa-trash-alt fa-lg"></i>
                                        </button>
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#asignarProyectoModal" data-id="{{ $dato->id_proyecto }}">
                                            <i class="fas fa-plus fa-lg"></i>
                                        </button>
                                        
                                    </div>
                                    
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

<!-- Ventana modal para crear nuevo proyecto -->
<div class="modal fade" id="crearProyectoModal" tabindex="-1" aria-labelledby="crearProyectoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearProyectoModalLabel">Crear nuevo proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para introducir información del proyecto -->
                <form action="{{ route('guardar.proyecto') }}" method="POST">
                    
                    @csrf
                    <!-- Campos del formulario -->
                    <div class="mb-3">
                        <label for="id_proyecto" class="form-label">ID del proyecto</label>
                        <input type="text" class="form-control" id="id_proyecto" name="id_proyecto" required>
                    </div>
                    <div class="mb-3">
                        <label for="proyecto" class="form-label">Nombre del proyecto</label>
                        <input type="text" class="form-control" id="proyecto" name="proyecto" required>
                    </div>
                    <div class="mb-3">
                        <label for="cliente" class="form-label">Cliente</label>
                        <input type="text" class="form-control" id="cliente" name="cliente" required>
                    </div>
                    <div class="mb-3">
                        <label for="encargado" class="form-label">Encargado y Num Tel</label>
                        <input type="text" class="form-control" id="encargado" name="encargado" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                    </div>
                    <div class="mb-3">
                        <label for="activo" class="form-label">Estado</label>
                        <select class="form-control" id="activo" name="activo" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Ventana modal para editar proyecto -->
<div class="modal fade" id="editarProyectoModal" tabindex="-1" aria-labelledby="editarProyectoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarProyectoModalLabel">Editar proyecto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editarProyectoForm" action="" method="POST">
          @csrf
          {{-- El ID se rellenará por JS --}}
          <input type="hidden" id="id_proyecto_input" name="id_proyecto">

                    <div class="mb-3">
                        <label for="proyecto_editar" class="form-label">Nombre del proyecto</label>
                        <input type="text" class="form-control" id="proyecto_editar" name="proyecto_editar" required>
                    </div>
                    <div class="mb-3">
                        <label for="cliente_editar" class="form-label">Cliente</label>
                        <input type="text" class="form-control" id="cliente_editar" name="cliente_editar" required>
                    </div>
                    <div class="mb-3">
                        <label for="encargado_editar" class="form-label">Encargado y Num Tel</label>
                        <input type="text" class="form-control" id="encargado_editar" name="encargado_editar" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio_editar" class="form-label">Fecha de inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio_editar" name="fecha_inicio_editar" required>
                    </div>
                    <div class="mb-3">
                        <label for="ubicacion_editar" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacion_editar" name="ubicacion_editar" required>
                    </div>
                    <div class="mb-3">
                        <label for="activo_editar" class="form-label">Estado</label>
                        <select class="form-control" id="activo_editar" name="activo_editar" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Ventana modal para confirmar la eliminación -->
<div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-labelledby="confirmarEliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmarEliminarModalLabel">Confirmar eliminación de proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar el proyecto <span id="proyectoId"></span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                <button  type="button" class="btn btn-danger" id="confirmarEliminarBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de error -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error al registrar proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="errorMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal de seleccion -->
<div class="modal fade" id="asignarProyectoModal" tabindex="-1" aria-labelledby="asignarProyectoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="asignarProyectoModalLabel">Asignar Proyecto a Empleado - ID Proyecto: <span id="proyectoId"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="tablaEmpleados" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se mostrarán los empleados disponibles -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnAsignarProyecto">Asignar Proyecto</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Función para cargar la lista de empleados en la tabla
        function cargarEmpleados() {
            $.ajax({
                url: "{{ route('lista.empleados') }}",
                type: 'GET',
                success: function(response) {
                    // El resto del código para cargar la tabla de empleados
                },
                error: function(xhr) {
                    // Mostrar mensaje de error si hay un error en la petición AJAX
                    toastr.error("Ha ocurrido un error al cargar la lista de empleados");
                }
            });
        }
    
        // Al abrir la ventana modal de asignación de proyectos, cargar la lista de empleados disponibles
        $('#asignarProyectoModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que abrió el modal
            var id_proyecto = button.data('id'); // Extraer el id_proyecto del botón
            var modalTitle = "Asignar Proyecto a Empleado - ID Proyecto: " + id_proyecto; // Texto del encabezado del modal
            var modalHeader = $(this).find('.modal-header'); // Encontrar el encabezado del modal

            // Actualizar el texto del encabezado del modal con el id_proyecto
            modalHeader.find('#proyectoId').text(id_proyecto);

            // Restablecer el contenido del modal para cargar los empleados disponibles
            cargarEmpleados();
        });
    });
</script>


<script>
function editarProyecto(id_proyecto) {
    // 1) Construir y fijar la URL del formulario
    var editarUrl = "{{ route('editar.proyecto', ':id_proyecto') }}"
                    .replace(':id_proyecto', id_proyecto);
    $('#editarProyectoForm').attr('action', editarUrl);

    // 2) Petición AJAX para cargar los datos existentes
    $.get("{{ route('obtener.proyecto', ':id_proyecto') }}"
          .replace(':id_proyecto', id_proyecto), function(response) {
        if (response.success) {
            let p = response.proyecto;
            $('#id_proyecto_input').val(p.id_proyecto);
            $('#proyecto_editar').val(p.proyecto);
            $('#cliente_editar').val(p.cliente);
            $('#encargado_editar').val(p.encargado);
            $('#fecha_inicio_editar').val(p.fecha_inicio);
            $('#ubicacion_editar').val(p.ubicacion);
            $('#activo_editar').val(p.activo);
            $('#editarProyectoModal').modal('show');
        } else {
            toastr.error(response.message);
        }
    }).fail(function() {
        toastr.error("Error al cargar datos del proyecto");
    });
}

</script>


<script>
    function eliminarProyecto(id_proyecto) {
        $('#proyectoId').text(id_proyecto);
        $('#confirmarEliminarModal').modal('show');

        // Desvincular los controladores de eventos click anteriores
        $('#confirmarEliminarBtn').off('click');

        // Agregar el nuevo controlador de eventos click
        $('#confirmarEliminarBtn').on('click', function() {
            // Hacer la petición de eliminación del proyecto utilizando el método DELETE
            $.ajax({
                url: '/proyectos/eliminar/' + id_proyecto,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        // Mostrar el toast de éxito
                        toastr.success("El proyecto ha sido eliminado con éxito");

                        // Actualizar la tabla de proyectos
                        $('#tablita').DataTable().ajax.reload();
                    } else {
                        // Mostrar el toast de error con el mensaje recibido
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    // Mostrar el toast de error
                    toastr.error("Ha ocurrido un error al eliminar el proyecto");
                }
            });

            $('#confirmarEliminarModal').modal('hide');
        });
    }
</script>

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

<script>
    $(document).ready(function() {
        $('#tablita').DataTable({
            lengthMenu: [5, 10, 25, 50]
        });
    });
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

        @if ($errors->any())
        var errorMessage = "{{ $errors->first() }}";
        $('#errorMessage').text(errorMessage);
        $('#errorModal').modal('show');
        @endif
    });
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
        toastr.success("Proyecto registrado con éxito");
        @endif
    });
</script>

<script>
    $(document).ready(function() {
        // Función para cargar la lista de empleados en la tabla
        function cargarEmpleados() {
            $.ajax({
                url: "{{ route('lista.empleados') }}",
                type: 'GET',
                success: function(response) {
                    $('#tablaEmpleados tbody').empty();
                    $.each(response, function(index, empleado) {
                        var row = `
                            <tr>
                                <td>${empleado.id}</td>
                                <td>${empleado.nombre_completo}</td>
                                <td>${empleado.email}</td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="empleadosSeleccionados[]" value="${empleado.email}">
                                    </div>
                                </td>
                            </tr>
                        `;
                        $('#tablaEmpleados tbody').append(row);
                    });
                },
                error: function(xhr) {
                    // Mostrar mensaje de error si hay un error en la petición AJAX
                    toastr.error("Ha ocurrido un error al cargar la lista de empleados");
                }
            });
        }
    
        // Al abrir la ventana modal de asignación de proyectos, cargar la lista de empleados disponibles
        $('#asignarProyectoModal').on('show.bs.modal', function() {
            cargarEmpleados();
        });
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
