@extends('layouts.app')

@section('title', 'Listado de Clientes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Clientes</h2>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">Nuevo Cliente</a>
</div>

<div class="card shadow-sm">
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
                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Desea eliminar este cliente?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
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

        <!-- Links de paginación generados por $clientes = Cliente::orderBy('id', 'desc')->paginate(10) -->
        <div class="d-flex justify-content-end mt-3">
            {{ $clientes->links() }}
        </div>
    </div>
</div>
@endsection