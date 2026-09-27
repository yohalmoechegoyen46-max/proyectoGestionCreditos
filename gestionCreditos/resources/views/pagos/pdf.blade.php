<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Pago #{{ $pago->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 10px; font-size: 12px; color: #333; }
        .ticket { border: 1px solid #198754; border-radius: 6px; padding: 15px; }
        .header { background-color: #198754; color: #fff; text-align: center; padding: 8px; font-size: 16px; font-weight: bold; border-radius: 4px; }
        .monto-container { text-align: center; margin: 15px 0; }
        .monto-title { color: #6c757d; font-size: 11px; }
        .monto { font-size: 24px; color: #198754; font-weight: bold; margin: 5px 0; }
        .fecha { background-color: #6c757d; color: white; padding: 2px 8px; font-size: 10px; border-radius: 4px; display: inline-block; }
        .row { margin-bottom: 8px; }
        .label { font-weight: bold; }
        .divider { border-top: 1px dashed #ccc; margin: 12px 0; }
    </style>
</head>
<body>

@php
    // Obtener total del crédito
    $totalCredito = $pago->credito->total_credito ?? $pago->credito->monto ?? 0;
    
    // Obtener la suma de todos los pagos realizados hasta este pago inclusive
    $totalAbonado = \App\Models\Pago::where('creditos_id', $pago->creditos_id)
                        ->where('id', '<=', $pago->id)
                        ->sum('monto10');
                        
    // Saldo restante real tras realizar este abono
    $saldoCalculado = max(0, $totalCredito - $totalAbonado);
@endphp

<div class="ticket">
    <div class="header">Comprobante de Pago {{ $pago->numero_ticket ?? '#'.$pago->id }}</div>

    <div class="monto-container">
        <div class="monto-title">Monto Abonado</div>
        <div class="monto">${{ number_format($pago->monto10, 2) }}</div>
        <div class="fecha">Fecha: {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</div>
    </div>

    <div class="divider"></div>

    <div class="row">
        <span class="label">Cliente:</span> 
        {{ $pago->credito->cliente->nombres ?? '' }} {{ $pago->credito->cliente->apellidos ?? '' }}
    </div>
    <div class="row">
        <span class="label">Crédito Asociado:</span> 
        #{{ $pago->creditos_id }}
    </div>
    <div class="row">
        <span class="label">Total del Crédito:</span> 
        ${{ number_format($totalCredito, 2) }}
    </div>
    <div class="row">
        <span class="label">Saldo Restante:</span> 
        ${{ number_format($saldoCalculado, 2) }}
    </div>
    <div class="row">
        <span class="label">Referencia:</span> 
        {{ $pago->referencia ?? 'Efectivo / Ticket Interno' }}
    </div>
    <div class="row">
        <span class="label">Observaciones:</span> 
        {{ $pago->observaciones ?? '-' }}
    </div>
</div>

</body>
</html>