<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultados de Búsqueda</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #06b6d4;
            --dark: #0f172a;
            --darker: #020617;
            --glass: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --text-muted: #64748b;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            font-weight: 400;
            line-height: 1.5;
            color: var(--text-primary);
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/images/parque-caldas.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Exclusive background pattern */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                radial-gradient(circle at 25% 25%, var(--primary) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, var(--secondary) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, var(--accent) 0%, transparent 50%);
            opacity: 0.03;
            z-index: 0;
        }

        /* Floating particles */
        .particles {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: var(--text-secondary);
            border-radius: 50%;
            opacity: 0.3;
            animation: float 8s infinite linear;
        }

        .particle:nth-child(1) { left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { left: 20%; animation-delay: 1s; }
        .particle:nth-child(3) { left: 30%; animation-delay: 2s; }
        .particle:nth-child(4) { left: 40%; animation-delay: 3s; }
        .particle:nth-child(5) { left: 50%; animation-delay: 4s; }
        .particle:nth-child(6) { left: 60%; animation-delay: 5s; }
        .particle:nth-child(7) { left: 70%; animation-delay: 6s; }
        .particle:nth-child(8) { left: 80%; animation-delay: 7s; }
        .particle:nth-child(9) { left: 90%; animation-delay: 8s; }

        @keyframes float {
            0% { transform: translateY(100vh) scale(0); opacity: 0; }
            10% { opacity: 0.3; }
            90% { opacity: 0.3; }
            100% { transform: translateY(-100px) scale(1); opacity: 0; }
        }

        /* Main container */
        .container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            padding: 0.5rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Glass effect cards */
        .glass-card {
            background: var(--glass);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            box-shadow:
                0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.05);
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        }

        /* Header */
        .header {
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid var(--glass-border);
        }

        .header-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            background: linear-gradient(135deg, var(--text-primary), var(--text-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.01em;
        }

        .header-subtitle {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 400;
        }

        /* Content sections */
        .content-section {
            padding: 1rem;
            border-bottom: 1px solid var(--glass-border);
        }

        .content-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .section-icon {
            width: 16px;
            height: 16px;
            color: var(--primary);
        }

        /* Info grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .info-item {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 6px;
            padding: 0.75rem;
        }

        .info-label {
            font-size: 0.65rem;
            font-weight: 500;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.2rem;
        }

        .info-value {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Contract cards */
        .contract-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .contract-card:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .contract-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .contract-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .contract-date {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .contract-amount {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
        }

        /* Status badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.2);
            color: #fbbf24;
        }

        .status-completed {
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            color: #a5b4fc;
        }

        /* Progress bar */
        .progress-container {
            margin: 1rem 0;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .progress-text {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        /* Table styles */
        .payment-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 8px;
            overflow: hidden;
        }

        .payment-table th {
            background: rgba(255, 255, 255, 0.05);
            padding: 0.75rem;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .payment-table td {
            padding: 0.75rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.875rem;
            color: var(--text-primary);
        }

        .payment-table tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-primary);
            border: 1px solid var(--glass-border);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0.75rem;
            }

            .header {
                padding: 1.5rem 1rem;
            }

            .content-section {
                padding: 1rem;
            }

            .contract-card {
                padding: 1rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .contract-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <!-- Floating particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Main container -->
    <div class="container">
        <div class="max-w-6xl mx-auto">
            <!-- Main card -->
            <div class="glass-card animate-slide-in">
                <!-- Header -->
                <div class="header">
                    <div class="flex items-center justify-center mb-1">
                        <div class="w-4 h-4 bg-gradient-to-br from-blue-500 to-indigo-600 rounded flex items-center justify-center shadow-sm">
                            <svg class="w-2 h-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <h1 class="header-title">Resultados de Búsqueda</h1>
                    <p class="header-subtitle">Información del cliente y contratos</p>
                    <div class="mt-4">
                        <a href="{{ route('public.search') }}" class="btn btn-secondary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                            Volver a la búsqueda
                        </a>
                    </div>
                </div>

                <!-- Información del Cliente -->
                <div class="content-section">
                    <h2 class="section-title">
                        <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Información del Cliente
                    </h2>

                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nombre Completo</div>
                            <div class="info-value">{{ $client->nombre_completo }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Número de Cédula</div>
                            <div class="info-value">{{ $client->cedula }}</div>
                        </div>
                    </div>
                </div>

                <!-- Contratos y Pagos -->
                <div class="content-section">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="section-title">
                            <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Contratos y Pagos
                        </h3>
                        <div class="status-badge status-active">
                            {{ $client->contracts->count() }} contrato{{ $client->contracts->count() !== 1 ? 's' : '' }}
                        </div>
                    </div>

                    @forelse($client->contracts as $contract)
                        <div class="contract-card">
                            <div class="contract-header">
                                <div>
                                    <h4 class="contract-title">Contrato #{{ $contract->id }}</h4>
                                    <p class="contract-date">Inicio: {{ $contract->fecha_inicio->format('d/m/Y') }}</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="contract-amount">${{ number_format($contract->monto_total, 0) }}</div>
                                    <span class="status-badge {{ $contract->estado === 'completado' ? 'status-completed' : ($contract->estado === 'activo' ? 'status-active' : 'status-pending') }}">
                                        {{ ucfirst($contract->estado) }}
                                    </span>
                                </div>
                            </div>

                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Monto Total</div>
                                    <div class="info-value">${{ number_format($contract->monto_total, 0) }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Progreso</div>
                                    <div class="info-value">{{ $contract->cuotas_pagadas }}/{{ $contract->numero_cuotas }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Por Cuota</div>
                                    <div class="info-value">${{ number_format($contract->monto_cuota, 0) }}</div>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="progress-container">
                                <div class="progress-text">
                                    Progreso del contrato: {{ $contract->numero_cuotas > 0 ? round(($contract->cuotas_pagadas / $contract->numero_cuotas) * 100) : 0 }}%
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $contract->numero_cuotas > 0 ? ($contract->cuotas_pagadas / $contract->numero_cuotas) * 100 : 0 }}%"></div>
                                </div>
                            </div>

                            @if($contract->payments->isNotEmpty())
                                <div>
                                    <div class="flex items-center justify-between mb-4">
                                        <h5 class="section-title">
                                            <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                            </svg>
                                            Historial de Pagos
                                        </h5>
                                        <div class="status-badge status-active">
                                            {{ $contract->payments->count() }} pago{{ $contract->payments->count() !== 1 ? 's' : '' }}
                                        </div>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="payment-table">
                                            <thead>
                                                <tr>
                                                    <th>Cuota</th>
                                                    <th>Fecha</th>
                                                    <th>Monto</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($contract->payments as $payment)
                                                    <tr>
                                                        <td>{{ $payment->numero_cuota }} de {{ $contract->numero_cuotas }}</td>
                                                        <td>{{ $payment->fecha_pago->format('d/m/Y') }}</td>
                                                        <td>${{ number_format($payment->monto, 0) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-gray-600 bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8" style="color: var(--text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                    </div>
                                    <p style="color: var(--text-muted);" class="text-sm">No hay pagos registrados para este contrato</p>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-600 bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" style="color: var(--text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium mb-2" style="color: var(--text-primary);">No hay contratos registrados</h3>
                            <p style="color: var(--text-muted);" class="text-sm">Este cliente no tiene contratos asociados en el sistema.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</body>
</html>