<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Resultados de consulta de pagos para {{ $cedula }}">
    <title>Resultados de Búsqueda - {{ $cedula }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            transition: all 0.3s ease;
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
            padding: 0.75rem;
            text-align: center;
            border-bottom: 1px solid var(--glass-border);
        }

        .header-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.125rem;
            background: linear-gradient(135deg, var(--text-primary), var(--text-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.01em;
        }

        .header-subtitle {
            font-size: 0.7rem;
            color: var(--text-primary);
            font-weight: 400;
        }

        /* Content sections */
        .content-section {
            padding: 0.75rem;
            border-bottom: 1px solid var(--glass-border);
        }

        .content-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .section-icon {
            width: 12px;
            height: 12px;
            color: var(--primary);
        }

        /* Info grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .info-item {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 4px;
            padding: 0.4rem;
        }

        .info-label {
            font-size: 0.6rem;
            font-weight: 500;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.1rem;
        }

        .info-value {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Contract cards */
        .contract-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 6px;
            padding: 0.75rem;
            margin-bottom: 0.75rem;
            transition: all 0.3s ease;
        }

        .contract-card:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .contract-header {
            display: flex;
            justify-content: between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .contract-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.125rem;
        }

        .contract-date {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .contract-amount {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
        }

        /* Status badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.125rem 0.375rem;
            border-radius: 8px;
            font-size: 0.65rem;
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
            margin: 0.5rem 0;
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
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
        .table-container {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 10px;
            overflow: hidden;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin: 1.5rem 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .table th {
            background: rgba(255, 255, 255, 0.03);
            color: var(--text-secondary);
            font-weight: 600;
            padding: 1rem;
            text-align: left;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.75px;
            border-bottom: 1px solid var(--glass-border);
        }

        .table td {
            padding: 1rem;
            color: var(--text-primary);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.9rem;
            line-height: 1.5;
            transition: background-color 0.2s ease;
        }

        .table tbody tr:hover td {
            background: rgba(255, 255, 255, 0.02);
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

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
            padding: 0.375rem;
            text-align: left;
            font-size: 0.65rem;
            font-weight: 500;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .payment-table td {
            padding: 0.375rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.75rem;
            color: var(--text-primary);
        }

        .payment-table tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
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

        .btn-success {
            background: rgba(16, 185, 129, 0.1);
            color: #6ee7b7;
            border: 1px solid rgba(16, 185, 129, 0.2);
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

        /* Desktop optimizations */
        @media (min-width: 1024px) {
            .container {
                max-width: 1200px;
                margin: 2rem auto;
                padding: 0;
            }

            .glass-card {
                border-radius: 16px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            }

            .header {
                padding: 2.5rem 3rem;
                border-radius: 16px 16px 0 0;
            }

            .header-title {
                font-size: 2.25rem;
                font-weight: 700;
                margin-bottom: 0.75rem;
                letter-spacing: -0.025em;
            }

            .header-subtitle {
                font-size: 1.125rem;
                opacity: 0.85;
                font-weight: 400;
            }

            .content-section {
                padding: 2.5rem 3rem;
            }

            .section-title {
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 2rem;
                letter-spacing: -0.01em;
            }

            .section-icon {
                width: 24px;
                height: 24px;
            }

            .info-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 2rem;
            }

            .info-item {
                padding: 1.75rem;
                border-radius: 12px;
                transition: all 0.3s ease;
            }

            .info-item:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            }

            .info-label {
                font-size: 0.875rem;
                font-weight: 600;
                margin-bottom: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .info-value {
                font-size: 1.125rem;
                font-weight: 500;
                line-height: 1.4;
            }

            /* Mejoras para tablas en desktop */
            .table-container {
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                margin: 1.5rem 0;
            }

            .table {
                font-size: 0.95rem;
            }

            .table th {
                padding: 1.25rem 1.5rem;
                font-size: 0.875rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.75px;
                background: rgba(255, 255, 255, 0.03);
            }

            .table td {
                padding: 1.5rem 1.5rem;
                font-size: 1rem;
                line-height: 1.5;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }

            .table tbody tr:hover {
                background: rgba(255, 255, 255, 0.02);
                transition: background-color 0.2s ease;
            }

            /* Mejoras para contratos en desktop */
            .contract-card {
                padding: 2.5rem;
                border-radius: 12px;
                margin-bottom: 2rem;
                transition: all 0.3s ease;
            }

            .contract-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
            }

            .contract-header {
                margin-bottom: 2rem;
                gap: 1.5rem;
            }

            .contract-title {
                font-size: 1.375rem;
                font-weight: 600;
                margin-bottom: 0.5rem;
            }

            .contract-meta {
                font-size: 1rem;
                opacity: 0.8;
            }

            /* Mejoras para progress bar en desktop */
            .progress-container {
                margin: 2rem 0;
            }

            .progress-info {
                margin-bottom: 1rem;
                gap: 1rem;
            }

            .progress-info span {
                font-size: 1rem;
                font-weight: 500;
            }

            .progress-bar {
                height: 12px;
                border-radius: 6px;
            }

            /* Mejoras para botones en desktop */
            .btn {
                padding: 1rem 2rem;
                font-size: 1rem;
                font-weight: 500;
                border-radius: 8px;
                transition: all 0.3s ease;
                letter-spacing: 0.025em;
            }

            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            }

            .btn svg {
                width: 18px;
                height: 18px;
                margin-right: 0.75rem;
            }

            .btn-group {
                gap: 1.5rem;
                margin-top: 2rem;
            }
        }

        /* Tablet optimizations */
        @media (min-width: 769px) and (max-width: 1023px) {
            .container {
                margin: 1.5rem;
                padding: 0;
            }

            .header {
                padding: 2rem 2.5rem;
                border-radius: 12px 12px 0 0;
            }

            .header-title {
                font-size: 1.875rem;
                margin-bottom: 0.5rem;
            }

            .header-subtitle {
                font-size: 1rem;
            }

            .content-section {
                padding: 2rem 2.5rem;
            }

            .section-title {
                font-size: 1.25rem;
                margin-bottom: 1.5rem;
            }

            .info-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }

            .info-item {
                padding: 1.5rem;
                border-radius: 10px;
            }

            .table th {
                padding: 1rem 1.25rem;
                font-size: 0.8rem;
            }

            .table td {
                padding: 1.25rem 1.25rem;
                font-size: 0.95rem;
            }

            .contract-card {
                padding: 2rem;
                margin-bottom: 1.5rem;
            }

            .btn {
                padding: 0.875rem 1.5rem;
                font-size: 0.95rem;
            }

            .btn svg {
                width: 16px;
                height: 16px;
            }
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .container {
                padding: 0.5rem;
                margin: 0.5rem;
            }

            .header {
                padding: 1.25rem 1rem;
                border-radius: 8px 8px 0 0;
            }

            .header-title {
                font-size: 1.5rem;
                margin-bottom: 0.5rem;
            }

            .header-subtitle {
                font-size: 0.9rem;
                opacity: 0.9;
            }

            .content-section {
                padding: 1.25rem;
            }

            .contract-card {
                padding: 1.25rem;
                margin-bottom: 1rem;
                border-radius: 8px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .info-item {
                padding: 1rem;
                border-radius: 6px;
            }

            .info-label {
                font-size: 0.75rem;
                margin-bottom: 0.25rem;
            }

            .info-value {
                font-size: 0.95rem;
                line-height: 1.3;
            }

            .btn {
                padding: 0.75rem 1.25rem;
                font-size: 0.9rem;
                border-radius: 6px;
            }

            .btn svg {
                width: 16px;
                height: 16px;
            }

            .contract-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            /* Mejoras para tablas en móvil */
            .table-container {
                margin: 0 -0.25rem;
                border-radius: 6px;
                overflow: hidden;
            }

            .table th {
                padding: 0.75rem 0.5rem;
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .table td {
                padding: 1rem 0.5rem;
                font-size: 0.9rem;
                line-height: 1.4;
            }

            /* Mejoras para progress bar en móvil */
            .progress-container {
                margin: 1rem 0;
            }

            .progress-info {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
            }

            .progress-info span {
                font-size: 0.85rem;
            }

            /* Mejoras para secciones en móvil */
            .section-title {
                font-size: 1.1rem;
                margin-bottom: 1rem;
            }

            .section-title svg {
                width: 18px;
                height: 18px;
            }

            /* Espaciado entre secciones */
            .content-section + .content-section {
                margin-top: 0.5rem;
            }

            /* Mejoras para botones en móvil */
            .btn-group {
                flex-direction: column;
                gap: 0.75rem;
                width: 100%;
            }

            .btn-group .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Custom SweetAlert2 */
        .swal2-popup {
            background: rgba(15, 23, 42, 0.95) !important;
            backdrop-filter: blur(20px) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 12px !important;
            color: var(--text-primary) !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4) !important;
        }

        .swal2-title {
            color: var(--text-primary) !important;
            font-size: 1.25rem !important;
            font-weight: 600 !important;
        }

        .swal2-html-container {
            color: var(--text-secondary) !important;
            font-size: 0.9rem !important;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;
            border: none !important;
            border-radius: 6px !important;
            font-weight: 600 !important;
            font-size: 0.875rem !important;
            padding: 0.5rem 1.5rem !important;
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
                    <h1 class="header-title">Información de Pagoss</h1>
                    <p class="header-subtitle">Cédula: {{ $cedula }}</p>
                    <div class="mt-3">
                        <a href="{{ route('public.search') }}" class="btn btn-secondary">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                            Volver
                        </a>
                    </div>
                </div>

                <!-- Información del Cliente -->
                <div class="content-section">
                    <h2 class="section-title">
                        <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Información Personal
                    </h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nombre Completo</div>
                            <div class="info-value">{{ $client->nombre_completo }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Cédula</div>
                            <div class="info-value">{{ $client->cedula }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Teléfono</div>
                            <div class="info-value">{{ $client->telefono ?? 'No registrado' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $client->email ?? 'No registrado' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Lista de Contratos -->
                <div class="content-section">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="section-title">
                            <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Contratos
                        </h2>
                        <div class="status-badge status-active">
                            Total: {{ $contracts->count() }}
                        </div>
                    </div>

                    @if($contracts->count() > 0)
                        @foreach($contracts as $contract)
                            <div class="contract-card">
                                <div class="contract-header">
                                    <div>
                                        <div class="flex items-center gap-3 mb-2">
                                            <h3 class="contract-title">Contrato #{{ $contract->id }}</h3>
                                            <span class="status-badge {{ $contract->estado_formateado['clase'] == 'text-green-800 bg-green-100' ? 'status-active' : ($contract->estado_formateado['clase'] == 'text-yellow-800 bg-yellow-100' ? 'status-pending' : 'status-completed') }}">
                                                {{ $contract->estado_formateado['texto'] }}
                                                @if($contract->estado_formateado['dias'])
                                                    ({{ $contract->estado_formateado['dias'] }})
                                                @endif
                                            </span>
                                        </div>
                                        <p class="contract-date">
                                            Fecha de inicio: {{ date('d/m/Y', strtotime($contract->fecha_inicio)) }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <div class="info-label">Monto Total</div>
                                        <div class="contract-amount">${{ number_format($contract->monto_total, 2) }}</div>
                                    </div>
                                </div>

                                <!-- Progreso de pago -->
                                <div class="progress-container">
                                    <div class="progress-text">
                                        Progreso de pago: {{ round(($contract->cuotas_pagadas / $contract->numero_cuotas) * 100) }}%
                                        ({{ $contract->cuotas_pagadas }} de {{ $contract->numero_cuotas }} cuotas)
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: {{ ($contract->cuotas_pagadas / $contract->numero_cuotas) * 100 }}%"></div>
                                    </div>
                                </div>

                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">Monto Pagado</div>
                                        <div class="info-value">${{ number_format($contract->monto_total - $contract->monto_pendiente, 2) }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Monto Pendiente</div>
                                        <div class="info-value">${{ number_format($contract->monto_pendiente, 2) }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Próximo Vencimiento</div>
                                        <div class="info-value">{{ $contract->proximo_vencimiento->format('d/m/Y') }}</div>
                                    </div>
                                </div>

                                <!-- Historial de Pagos -->
                                @if($contract->payments->count() > 0)
                                    <div class="mt-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <h4 class="section-title">
                                                <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                                </svg>
                                                Historial de Pagos
                                            </h4>
                                            <div class="status-badge status-active">
                                                {{ $contract->payments->count() }} pagos
                                            </div>
                                        </div>
                                        <div class="overflow-x-auto">
                                            <table class="payment-table">
                                                <thead>
                                                    <tr>
                                                        <th>Cuota</th>
                                                        <th>Fecha</th>
                                                        <th>Monto</th>
                                                        <th>Método</th>
                                                        <th>Referencia</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($contract->payments as $payment)
                                                        <tr>
                                                            <td>{{ $payment->numero_cuota }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($payment->fecha_pago)) }}</td>
                                                            <td>${{ number_format($payment->monto, 2) }}</td>
                                                            <td>
                                                                <span class="status-badge status-active">
                                                                    {{ ucfirst($payment->metodo_pago) }}
                                                                </span>
                                                            </td>
                                                            <td>{{ $payment->referencia ?? '-' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div class="mt-6 text-center py-6">
                                        <div class="w-12 h-12 bg-gray-600 bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <svg class="w-5 h-5" style="color: var(--text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                            </svg>
                                        </div>
                                        <p style="color: var(--text-muted);" class="text-sm">No hay pagos registrados para este contrato</p>
                                    </div>
                                @endif
                                        </div>
                                    </div>

                                <!-- Botones de acción -->
                                <div class="btn-group flex flex-wrap gap-3 mt-6">
                                    <a href="{{ route('contracts.pdf', [$contract, 'cedula' => $client->cedula]) }}" class="btn btn-secondary">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="7 10 12 15 17 10"></polyline>
                                            <line x1="12" y1="15" x2="12" y2="3"></line>
                                        </svg>
                                        Descargar PDF
                                    </a>
                                    @if(!$contract->firma)
                                        <a href="{{ route('contracts.firmar', [$contract, 'cedula' => $client->cedula]) }}" class="btn btn-primary">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                                <polyline points="10 17 15 12 10 7"></polyline>
                                                <line x1="15" y1="12" x2="3" y2="12"></line>
                                            </svg>
                                            Firmar Contrato
                                        </a>
                                    @else
                                        <span class="btn btn-success">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            </svg>
                                            Firmado
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                    @else
                        <div class="content-section text-center py-8">
                            <div class="w-12 h-12 bg-gray-600 bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-5 h-5" style="color: var(--text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-base font-medium mb-2" style="color: var(--text-primary);">No se encontraron contratos</h3>
                            <p style="color: var(--text-muted);" class="text-sm max-w-md mx-auto">No hay contratos activos registrados para este cliente en nuestro sistema.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 para mensajes de éxito -->
    <script>
        // Mostrar mensaje de éxito si existe
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Operación exitosa!',
                text: "{{ session('success') }}"
            });
        @endif
    </script>
</body>
</html>