<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Firma Digital de Contrato - Acceso exclusivo y seguro">
    <title>Firma Digital de Contrato</title>

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
            background: radial-gradient(ellipse at top, #1e293b 0%, var(--darker) 50%, #000000 100%);
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
            padding: 0.75rem;
            max-width: 700px;
            margin: 0.5rem auto;
            transition: all 0.3s ease;
        }

        /* Glass effect cards */
        .glass-card {
            background: var(--glass);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            box-shadow:
                0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.05);
            position: relative;
            overflow: hidden;
            animation: slideIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
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

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Header */
        .header {
            padding: 1.25rem 1rem;
            text-align: center;
            border-bottom: 1px solid var(--glass-border);
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
        }

        .header-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.75rem;
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .header-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
            letter-spacing: -0.025em;
        }

        .header-subtitle {
            color: var(--text-secondary);
            font-size: 0.8rem;
            font-weight: 400;
        }

        /* Content sections */
        .content-section {
            padding: 1rem;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-icon {
            width: 20px;
            height: 20px;
            color: var(--primary);
        }

        /* Info grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .info-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            padding: 1rem;
            transition: all 0.2s ease;
            position: relative;
        }

        .info-item:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.25);
            transform: translateY(-1px);
        }

        .info-label {
            font-size: 0.75rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.375rem;
            font-weight: 600;
        }

        .info-value {
            font-size: 1rem;
            color: var(--text-primary);
            font-weight: 600;
            line-height: 1.4;
        }

        /* Signature container */
        .signature-container {
            background: rgba(255, 255, 255, 0.02);
            border: 2px dashed var(--glass-border);
            border-radius: 8px;
            padding: 1.25rem;
            text-align: center;
            transition: all 0.3s ease;
            margin: 1rem 0;
        }

        .signature-container:hover {
            border-color: var(--primary);
            background: rgba(99, 102, 241, 0.05);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .signature-canvas {
            border: 1px solid var(--glass-border);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.95);
            cursor: crosshair;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            outline: none;
        }

        .btn:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
            border: 1px solid var(--glass-border);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .btn svg {
            width: 16px;
            height: 16px;
        }

        /* Instructions */
        .instructions {
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 6px;
            padding: 0.75rem;
            margin-bottom: 1rem;
        }

        .instructions-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.375rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .instructions-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .instructions-list li {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-bottom: 0.125rem;
            padding-left: 0.875rem;
            position: relative;
        }

        .instructions-list li::before {
            content: '•';
            color: var(--primary);
            position: absolute;
            left: 0;
        }

        /* Button group */
        .btn-group {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin-top: 1rem;
        }

        /* SweetAlert2 customization */
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
        }

        .swal2-content {
            color: var(--text-secondary) !important;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;
            border: none !important;
            border-radius: 6px !important;
            font-weight: 600 !important;
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
        <div class="glass-card">
            <!-- Header -->
            <div class="header">
                <div class="header-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                </div>
                <h1 class="header-title">Firma Digital</h1>
                <p class="header-subtitle">Contrato #{{ $contract->id }}</p>
                <div style="margin-top: 0.75rem;">
                    <a href="{{ route('public.search.results', ['cedula' => request('cedula')]) }}" class="btn btn-secondary" style="font-size: 0.8rem; padding: 0.5rem 1rem;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver
                    </a>
                </div>
            </div>

            <!-- Contract Information -->
            <div class="content-section">
                <h2 class="section-title">
                    <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Información del Contrato
                </h2>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: inline; margin-right: 0.25rem;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V6a2 2 0 012-2h4a2 2 0 012 2v1m-6 0h8m-9 0v10a2 2 0 002 2h8a2 2 0 002-2V7H7z"></path>
                            </svg>
                            Fecha de Creación
                        </div>
                        <div class="info-value">{{ $contract->created_at->format('d/m/Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: inline; margin-right: 0.25rem;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Estado
                        </div>
                        <div class="info-value" style="color: var(--warning); font-weight: 700;">
                            <span style="display: inline-flex; align-items: center; gap: 0.25rem;">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                Pendiente de Firma
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Signature Section -->
            <div class="content-section">
                <h2 class="section-title">
                    <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    Firma Digital
                </h2>

                <!-- Instructions -->
                <div class="instructions">
                    <div class="instructions-title">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Instrucciones para firmar
                    </div>
                    <ul class="instructions-list">
                        <li>Dibuja tu firma en el recuadro usando el mouse o tu dedo</li>
                        <li>Puedes limpiar y volver a firmar las veces que necesites</li>
                        <li>Una vez satisfecho con tu firma, haz clic en "Guardar Firma"</li>
                    </ul>
                </div>

                <!-- Signature Form -->
                <form id="firmaForm" method="POST" action="{{ route('contracts.guardarFirma', $contract) }}?cedula={{ request('cedula') }}">
                    @csrf

                    <!-- Signature Canvas -->
                    <div class="signature-container">
                        <p style="color: var(--text-secondary); margin-bottom: 0.75rem; font-size: 0.8rem;">
                            Dibuja tu firma:
                        </p>
                        <canvas id="signature-pad" width="100%" height="150" class="signature-canvas" style="width: 100%; touch-action: none;"></canvas>
                        <input type="hidden" name="firma" id="firmaInput">
                        <p style="color: var(--text-muted); margin-top: 0.5rem; font-size: 0.7rem; text-align: center;">
                            Usa el mouse o tu dedo
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="btn-group">
                        <button type="button" id="clear" class="btn btn-secondary">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Limpiar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Guardar Firma
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Signature Pad JS -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('signature-pad');
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgba(255, 255, 255, 0.95)',
                penColor: 'rgb(0, 0, 0)',
                minWidth: 1.5,
                maxWidth: 3.5,
                throttle: 16,
                minDistance: 5,
            });

            // Función para redimensionar el canvas
            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                const rect = canvas.getBoundingClientRect();
                canvas.width = rect.width * ratio;
                canvas.height = rect.height * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
                signaturePad.clear();
            }

            // Redimensionar al cargar y al cambiar el tamaño de la ventana
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            // Botón limpiar
            document.getElementById('clear').addEventListener('click', function() {
                signaturePad.clear();
            });

            // Envío del formulario
            document.getElementById('firmaForm').addEventListener('submit', function(e) {
                e.preventDefault();

                if (signaturePad.isEmpty()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Firma requerida',
                        text: 'Por favor, dibuja tu firma antes de continuar.',
                        confirmButtonText: 'Entendido',
                        confirmButtonColor: '#6366f1'
                    });
                    return;
                }

                // Obtener la imagen de la firma
                const signatureData = signaturePad.toDataURL();
                document.getElementById('firmaInput').value = signatureData;

                // Mostrar confirmación
                Swal.fire({
                    title: '¿Confirmar firma?',
                    text: 'Una vez confirmada, no podrás modificar tu firma.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#6366f1',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Sí, confirmar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Mostrar loading
                        Swal.fire({
                            title: 'Guardando firma...',
                            text: 'Por favor espera mientras procesamos tu firma.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Enviar formulario
                        this.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>