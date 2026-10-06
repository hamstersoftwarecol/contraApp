<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portal de Consulta de Pagos - Acceso exclusivo y seguro">
    <title>Portal de Consulta de Pagos</title>
    
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

        /* Exclusive background pattern - disabled for background image */
        /*
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
        */

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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        /* Compact card */
        .portal-card {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            animation: slideIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .portal-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            margin-bottom: 1rem;
            box-shadow: 0 4px 16px rgba(99, 102, 241, 0.3);
        }

        .title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.02em;
        }

        .subtitle {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        /* Form */
        .form {
            margin-bottom: 1.5rem;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
            padding-top: 1rem;
        }

        .input-label {
            display: block;
            margin-bottom: 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .input-field {
            width: 100%;
            height: 52px;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            padding: 0 1rem 0 3rem;
            font-size: 1rem;
            font-family: 'JetBrains Mono', monospace;
            color: var(--dark);
            transition: all 0.2s ease;
            outline: none;
        }

        .input-field::placeholder {
            color: #64748b;
            font-family: 'Inter', sans-serif;
        }

        .input-field:focus {
            background: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            transition: color 0.2s ease;
        }

        .input-field:focus + .input-icon {
            color: var(--primary);
        }

        .input-hint {
            margin-top: 0.5rem;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            gap: 0.375rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        /* Button */
        .submit-btn {
            width: 100%;
            height: 52px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.4);
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--primary-dark) 0%, #7c3aed 100%);
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .submit-btn:hover::before {
            opacity: 1;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Loading */
        .spinner {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Alerts */
        .alert {
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            animation: slideDown 0.3s ease;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 1.5rem;
        }

        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 25px;
            font-size: 0.75rem;
            color: #ffffff;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: var(--success);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .copyright {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.8);
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

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-3px); }
            75% { transform: translateX(3px); }
        }

        .shake {
            animation: shake 0.4s ease-in-out;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .container {
                padding: 0.75rem;
            }

            .portal-card {
                max-width: 100%;
                padding: 1.5rem 1.25rem;
                border-radius: 12px;
            }

            .title {
                font-size: 1.375rem;
            }

            .input-field, .submit-btn {
                height: 44px;
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
        <div class="portal-card">
            <!-- Header -->
            <div class="header">
                <div class="logo">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <h1 class="title">Portal de Consulta</h1>
                <p class="subtitle">Acceso exclusivo y seguro</p>
            </div>

            <!-- Alerts -->
            @if(session('error'))
            <div class="alert alert-error">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22,4 12,14.01 9,11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <!-- Form -->
            <form action="{{ route('public.search.results') }}" method="GET" class="form" id="search-form">
                <div class="input-group">
                    <label class="input-label" for="cedula">Documento o NIT</label>
                    <input
                        type="text"
                        name="cedula"
                        id="cedula"
                        class="input-field"
                        placeholder="12345678"
                        required
                        autocomplete="off"
                        maxlength="20"
                    >
                    <svg class="input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <div class="input-hint">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        Ingrese su número de documento o NIT
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submit-btn">
                    <div class="btn-content">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <span>Consultar</span>
                    </div>
                </button>
            </form>

            <!-- Footer -->
            <div class="footer">
                <div class="security-badge">
                    <div class="status-dot"></div>
                    <span>Conexión segura</span>
                </div>
                <p class="copyright">&copy; {{ date('Y') }} Portal de Consulta</p>
            </div>
        </div>
    </div>

    <script>
        // Form handling
        document.getElementById('search-form').addEventListener('submit', function(e) {
            const cedula = document.getElementById('cedula').value.trim();
            const submitBtn = document.getElementById('submit-btn');
            const btnContent = submitBtn.querySelector('.btn-content');
            
            // Basic validation - just check if it's not empty and has reasonable length
            if (cedula.length < 3) {
                e.preventDefault();
                
                // Shake animation
                const card = document.querySelector('.portal-card');
                card.classList.add('shake');
                setTimeout(() => card.classList.remove('shake'), 400);
                
                // Show error
                Swal.fire({
                    icon: 'warning',
                    title: 'Documento requerido',
                    text: 'Por favor ingrese un número de documento válido',
                    confirmButtonText: 'Entendido',
                    customClass: {
                        popup: 'swal-custom'
                    }
                });
                return;
            }

            // Check for invalid characters (only allow alphanumeric and common separators)
            const validPattern = /^[a-zA-Z0-9\-\s]+$/;
            if (!validPattern.test(cedula)) {
                e.preventDefault();
                
                // Shake animation
                const card = document.querySelector('.portal-card');
                card.classList.add('shake');
                setTimeout(() => card.classList.remove('shake'), 400);
                
                // Show error
                Swal.fire({
                    icon: 'warning',
                    title: 'Formato inválido',
                    text: 'El documento solo puede contener letras, números y guiones',
                    confirmButtonText: 'Entendido',
                    customClass: {
                        popup: 'swal-custom'
                    }
                });
                return;
            }

            // Loading state
            submitBtn.disabled = true;
            btnContent.innerHTML = `
                <div class="spinner"></div>
                <span>Consultando...</span>
            `;
        });

        // Clean input - remove special characters except alphanumeric, spaces and hyphens
        document.getElementById('cedula').addEventListener('input', function(e) {
            let value = e.target.value;
            
            // Remove invalid characters
            value = value.replace(/[^a-zA-Z0-9\-\s]/g, '');
            
            // Remove multiple spaces and hyphens
            value = value.replace(/\s+/g, ' ').replace(/\-+/g, '-');
            
            e.target.value = value;
        });

        // Auto-hide alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-8px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 4000);

        // Session messages
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'No encontrado',
                text: "{{ session('error') }}",
                confirmButtonText: 'Reintentar'
            });
        @endif

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                confirmButtonText: 'Continuar'
            });
        @endif
    </script>
</body>
</html>