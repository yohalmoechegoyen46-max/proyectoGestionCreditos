@extends('layouts.app')

@section('title', 'Listado de Clientes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Clientes</h2>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">Nuevo Cliente</a>
</div>

<!-- Buscador -->
<div class="card shadow-sm border-0 mb-3">
    <div class="card-body">
        <form action="{{ route('clientes.index') }}" method="GET" class="row g-2">
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-text bg-white text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="buscar" class="form-control" 
                           placeholder="Buscar cliente por nombre, documento o correo..." 
                           value="{{ request('buscar') }}">
                </div>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100 fw-semibold">
                    Buscar
                </button>
                @if(request('buscar'))
                    <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary" title="Limpiar filtro">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Documento</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nombres }} {{ $cliente->apellidos }}</td>
                        <td>{{ $cliente->documento_identidad }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->correo }}</td>
                        <td>
                            <span class="badge {{ $cliente->estado == 'activo' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($cliente->estado) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-info btn-sm text-white">Ver</a>
                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning btn-sm text-white">Editar</a>
                            
                            @if($cliente->estado == 'activo')
                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Desea desactivar este cliente?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            @else
                                <form action="{{ route('clientes.activar', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Desea reactivar este cliente?');">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-sm">Activar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay clientes registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $clientes->appends(['buscar' => request('buscar')])->links() }}
        </div>
    </div>
</div>
@endsection