@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<link href="https://cdn.datatables.net/v/bs/dt-1.13.5/b-2.4.0/date-1.5.0/r-2.5.0/sc-2.2.0/sb-1.5.0/datatables.css" rel="stylesheet"/>
 
<script src="https://cdn.datatables.net/v/bs/dt-1.13.5/b-2.4.0/date-1.5.0/r-2.5.0/sc-2.2.0/sb-1.5.0/datatables.js"></script>


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="#" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#crearProyectoModal">
                Crear Nuevo Proyecto
                </a>
            <div class="card">
             
                <div class="card-header">{{ __('Proyectos') }}</div>
              
                    <table id="tablitaConMiAmorcito" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Proyecto</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datos as $dato)
                            <tr>
                                <td>{{ $dato->id_proyecto }}</td>
                                <td>{{ $dato->proyecto }}</td>
                                <td>{{ $dato->cliente }}</td>
                                <td>{{ $dato->fecha_inicio }}</td>
                                <td>
                                    @if ($dato->activo == 0)
                                        Inactivo
                                    @else
                                        Activo
                                    @endif
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

<!-- Ventana modal para crear nuevo proyecto -->
<div class="modal fade" id="crearProyectoModal" tabindex="-1" aria-labelledby="crearProyectoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Formulario para introducir información del proyecto -->
                <form action="{{ route('guardar.proyecto') }}" method="POST">
                    @csrf
                    <!-- Campos del formulario -->
                    <div class="mb-3">
                        <label for="proyecto" class="form-label">Nombre del proyecto</label>
                        <input type="text" class="form-control" id="proyecto" name="proyecto" required>
                    </div>
                    <div class="mb-3">
                        <label for="cliente" class="form-label">Cliente</label>
                        <input type="text" class="form-control" id="cliente" name="cliente" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
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


<script>
    $(document).ready(function() {
        $('#tablitaConMiAmorcito').DataTable({
             lengthMenu: [5,10, 25, 50],
        });
    });

</script>



@endsection
