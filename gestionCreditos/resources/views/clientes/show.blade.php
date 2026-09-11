@extends('layouts.app')

@section('title', 'Detalle de Cliente')

@section('content')
<!-- Información del Cliente -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-person-vcard me-2"></i>Información del Cliente</h5>
        <span class="badge {{ $cliente->estado == 'activo' ? 'bg-success' : 'bg-secondary' }} px-3 py-2 rounded-pill">
            {{ ucfirst($cliente->estado) }}
        </span>
    </div>
    <div class="card-body p-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <p class="mb-2"><strong>ID:</strong> <span class="text-muted">#{{ $cliente->id }}</span></p>
                <p class="mb-2"><strong>Nombres:</strong> {{ $cliente->nombres }}</p>
                <p class="mb-2"><strong>Apellidos:</strong> {{ $cliente->apellidos }}</p>
                <p class="mb-2"><strong>Documento de Identidad:</strong> {{ $cliente->documento_identidad }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-2"><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                <p class="mb-2"><strong>Correo Electrónico:</strong> {{ $cliente->correo }}</p>
                <p class="mb-2"><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning text-dark fw-semibold">
                Editar Cliente
            </a>
            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary fw-semibold">
                Volver al Listado
            </a>
        </div>
    </div>
</div>

<!-- Tabla de Créditos Asociados -->
<h4 class="fw-bold mb-3 text-secondary"><i class="bi bi-credit-card me-2"></i>Créditos Asociados</h4>
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3">ID Crédito</th>
                        <th>Fecha</th>
                        <th>Monto Total</th>
                        <th>Cuota Est.</th>
                        <th>N° Cuotas</th>
                        <th class="text-center">Estado / Tipo</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($cliente->creditos as $credito)
                    @php
                        // Obtenemos el plazo o número de cuotas registrado
                        $plazo = $credito->plazo ?? $credito->ncuotas ?? 0;
                        // Calculamos el valor de cada cuota
                        $montoCuota = ($plazo > 0) ? ($credito->monto / $plazo) : 0;
                    @endphp
                    <tr>
                        <td class="ps-3 fw-bold text-primary">#{{ $credito->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($credito->fecha_otorgamiento ?? $credito->fecha)->format('d/m/Y') }}</td>
                        <td class="fw-semibold">${{ number_format($credito->monto, 2) }}</td>
                        <td class="fw-bold text-dark">${{ number_format($montoCuota, 2) }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $plazo }} cuotas</span></td>
                        <td class="text-center">
                            @php
                                $estado = strtolower($credito->estado ?? $credito->tipo ?? 'activo');
                            @endphp
                            <span class="badge {{ $estado == 'activo' ? 'bg-success' : ($estado == 'pagado' ? 'bg-info' : 'bg-secondary') }} rounded-pill px-3">
                                {{ ucfirst($estado) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Este cliente no posee créditos registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tabla de Historial de Pagos -->
<h4 class="fw-bold mb-3 text-secondary"><i class="bi bi-receipt me-2"></i>Historial de Pagos Realizados</h4>
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3">ID Pago</th>
                        <th>ID Crédito</th>
                        <th>Fecha de Pago</th>
                        <th>Monto Abonado</th>
                        <th>Referencia</th>
                        <th>Observaciones</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $pagosCliente = $cliente->creditos->pluck('pagos')->flatten();
                    @endphp

                    @forelse($pagosCliente as $pago)
                        <tr>
                            <td class="ps-3 fw-bold">#{{ $pago->id }}</td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                                    Crédito #{{ $pago->creditos_id }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                            <td class="fw-bold text-success fs-6">
                                ${{ number_format($pago->monto10, 2) }}
                            </td>
                            <td>
                                <span class="badge bg-light text-secondary border">
                                    {{ $pago->referencia ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="text-muted small">{{ $pago->observaciones ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('pagos.show', $pago->id) }}" class="btn btn-sm btn-outline-primary fw-semibold" title="Ver Comprobante">
                                    Ver Recibo
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Este cliente no registra abonos ni pagos realizados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection