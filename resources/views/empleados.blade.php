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
            <div class="card">
                <div class="card-header">{{ __('Empleados') }}
                    <a href="#" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#crearEmpleadoModal">
                         Nuevo empleado
                    </a>
                </div>

                <div class="card-body">


                    <table id="tablita" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Salario</th>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datos as $dato)
                            <tr>
                                <td>{{ $dato->id}}</td>
                                <td>{{ $dato->nombre_completo }}</td>
                                <td>{{ $dato->email }}</td>
                                <td>{{ $dato->telefono }}</td>
                                <td>{{ $dato->salario }}</td>
                                <td>{{ $dato->activo }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Ventana modal para crear nuevo empleado -->
<div class="modal fade" id="crearEmpleadoModal" tabindex="-1" aria-labelledby="crearEmpleadoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearEmpleadoModalLabel">Crear nuevo empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para introducir información del empleado -->
                <form action="{{ route('empleados.guardar') }}" method="POST">
                    @csrf

                    <!-- Campos del formulario -->
                    <div class="mb-3">
                        <label for="nombre_completo" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono_emergencia" class="form-label">Teléfono de emergencia</label>
                        <input type="text" class="form-control" id="telefono_emergencia" name="telefono_emergencia" required>
                    </div>

                    <div class="mb-3">
                        <label for="salario" class="form-label">Salario</label>
                        <input type="number" class="form-control" id="salario" name="salario" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_registro" class="form-label">Fecha de registro</label>
                        <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" required>
                    </div>

                    <div class="mb-3">
                        <label for="activo" class="form-label">Activo</label>
                        <select class="form-control" id="activo" name="activo" required>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
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

@endsection
