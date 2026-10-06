<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --sidebar-width: 240px;
            --sidebar-collapsed: 64px;
            --header-height: 60px;
            
            /* Corporate color palette */
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --secondary: #475569;
            --accent: #0ea5e9;
            
            /* Dark corporate theme */
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --bg-card: #1e293b;
            
            --border-primary: #334155;
            --border-secondary: #475569;
            --border-accent: #64748b;
            
            --text-primary: #f8fafc;
            --text-secondary: #e2e8f0;
            --text-muted: #94a3b8;
            --text-disabled: #64748b;
            
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.3);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
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
            background: var(--bg-primary);
            font-size: 14px;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--bg-secondary);
            border-right: 1px solid var(--border-primary);
            z-index: 50;
            transition: width 0.2s ease;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-lg);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }

        /* Sidebar Header */
        .sidebar-header {
            height: var(--header-height);
            padding: 0 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-primary);
            background: var(--bg-card);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            overflow: hidden;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.875rem;
            color: white;
            flex-shrink: 0;
            box-shadow: var(--shadow-sm);
        }

        .logo-text {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-primary);
            white-space: nowrap;
            transition: opacity 0.2s ease;
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
            width: 0;
        }

        .toggle-btn {
            width: 24px;
            height: 24px;
            background: transparent;
            border: 1px solid var(--border-secondary);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: var(--text-muted);
        }

        .toggle-btn:hover {
            background: var(--bg-tertiary);
            border-color: var(--border-accent);
            color: var(--text-secondary);
        }

        .toggle-btn svg {
            transition: transform 0.2s ease;
        }

        .sidebar.collapsed .toggle-btn svg {
            transform: rotate(180deg);
        }

        /* Navigation */
        .nav-content {
            flex: 1;
            overflow-y: auto;
            padding: 0.75rem 0;
        }

        .nav-section {
            margin-bottom: 1.5rem;
        }

        .nav-section:last-child {
            margin-bottom: 0;
        }

        .nav-section-title {
            padding: 0 1rem;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-disabled);
            margin-bottom: 0.5rem;
            transition: opacity 0.2s ease;
        }

        .sidebar.collapsed .nav-section-title {
            opacity: 0;
            height: 0;
            margin: 0;
        }

        .nav-item {
            position: relative;
            margin: 0 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.625rem 0.75rem;
            border-radius: 6px;
            color: var(--text-muted);
            transition: all 0.15s ease;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1px;
        }

        .nav-link:hover {
            background: var(--bg-tertiary);
            color: var(--text-secondary);
        }

        .nav-link.active {
            background: var(--primary);
            color: white;
            font-weight: 600;
            box-shadow: var(--shadow-sm);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: -0.5rem;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 16px;
            background: var(--accent);
            border-radius: 0 2px 2px 0;
        }

        .nav-icon {
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .nav-text {
            margin-left: 0.75rem;
            white-space: nowrap;
            transition: opacity 0.2s ease;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
            width: 0;
            margin-left: 0;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--accent);
            color: white;
            font-size: 0.7rem;
            padding: 0.125rem 0.375rem;
            border-radius: 10px;
            font-weight: 600;
            transition: opacity 0.2s ease;
            min-width: 18px;
            text-align: center;
        }

        .sidebar.collapsed .nav-badge {
            opacity: 0;
            width: 0;
            margin: 0;
        }

        /* Tooltip */
        .nav-tooltip {
            position: absolute;
            left: calc(100% + 8px);
            top: 50%;
            transform: translateY(-50%);
            background: var(--bg-card);
            color: var(--text-primary);
            padding: 0.375rem 0.625rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.15s ease;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-primary);
            z-index: 60;
        }

        .sidebar.collapsed .nav-item:hover .nav-tooltip {
            opacity: 1;
        }

        /* User Profile */
        .user-profile {
            padding: 0.75rem 1rem;
            border-top: 1px solid var(--border-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            transition: background 0.15s ease;
            background: var(--bg-card);
        }

        .user-profile:hover {
            background: var(--bg-tertiary);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: linear-gradient(135deg, var(--accent), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.875rem;
            color: white;
            flex-shrink: 0;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: opacity 0.2s ease;
        }

        .sidebar.collapsed .user-info {
            opacity: 0;
            width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.7rem;
            color: var(--text-disabled);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-dropdown-icon {
            margin-left: auto;
            transition: opacity 0.2s ease;
            color: var(--text-muted);
        }

        .sidebar.collapsed .user-dropdown-icon {
            opacity: 0;
            width: 0;
        }

        /* User Dropdown */
        .user-dropdown {
            position: absolute;
            bottom: 100%;
            left: 0.5rem;
            right: 0.5rem;
            margin-bottom: 0.25rem;
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: 6px;
            box-shadow: var(--shadow-lg);
            z-index: 60;
            overflow: hidden;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0.625rem 0.75rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: background 0.15s ease;
            font-size: 0.8rem;
            font-weight: 500;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: var(--bg-tertiary);
            color: var(--text-primary);
        }

        .dropdown-item.danger {
            color: #f87171;
        }

        .dropdown-item.danger:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
        }

        /* Danger nav link styles */
        .nav-link.danger {
            color: #f87171 !important;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .nav-link.danger:hover {
            background: rgba(239, 68, 68, 0.1) !important;
            color: #fca5a5 !important;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.2s ease;
            min-height: 100vh;
            background: var(--bg-primary);
        }

        .sidebar.collapsed + .main-content {
            margin-left: var(--sidebar-collapsed);
        }

        /* Top Bar */
        .top-bar {
            height: var(--header-height);
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border-primary);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 40;
            box-shadow: var(--shadow-sm);
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .mobile-menu-btn {
            display: none;
            width: 32px;
            height: 32px;
            background: transparent;
            border: 1px solid var(--border-secondary);
            border-radius: 4px;
            color: var(--text-muted);
            cursor: pointer;
            align-items: center;
            justify-content: center;
            transition: all 0.15s ease;
        }

        .mobile-menu-btn:hover {
            background: var(--bg-tertiary);
            color: var(--text-secondary);
        }

        .page-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .breadcrumb-separator {
            color: var(--text-disabled);
        }

        .top-bar-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            background: transparent;
            border: 1px solid var(--border-secondary);
            border-radius: 4px;
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s ease;
        }

        .action-btn:hover {
            background: var(--bg-tertiary);
            color: var(--text-secondary);
        }

        /* Page Content */
        .page-content {
            padding: 1.5rem;
            background: var(--bg-primary);
        }

        /* Mobile Overlay */
        .mobile-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 45;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
        }

        .mobile-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 60;
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0 !important;
            }

            .mobile-menu-btn {
                display: flex;
            }

            .top-bar {
                padding: 0 1rem;
            }

            .page-content {
                padding: 1rem;
            }

            .nav-tooltip {
                display: none;
            }

            .page-title {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .sidebar-header {
                padding: 0 0.75rem;
            }

            .user-profile {
                padding: 0.75rem;
            }

            .page-content {
                padding: 0.75rem;
            }

            .top-bar {
                padding: 0 0.75rem;
            }
        }

        /* Scrollbar */
        .nav-content::-webkit-scrollbar {
            width: 3px;
        }

        .nav-content::-webkit-scrollbar-track {
            background: transparent;
        }

        .nav-content::-webkit-scrollbar-thumb {
            background: var(--border-secondary);
            border-radius: 2px;
        }

        .nav-content::-webkit-scrollbar-thumb:hover {
            background: var(--border-accent);
        }

        /* Status indicator */
        .status-indicator {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            margin-left: auto;
            flex-shrink: 0;
        }

        .sidebar.collapsed .status-indicator {
            margin: 0;
            position: absolute;
            top: 8px;
            right: 8px;
        }

        /* Compact spacing adjustments */
        .nav-section {
            margin-bottom: 1rem;
        }

        .nav-item + .nav-item {
            margin-top: 1px;
        }

        /* Professional focus states */
        .nav-link:focus,
        .toggle-btn:focus,
        .action-btn:focus,
        .mobile-menu-btn:focus {
            outline: 2px solid var(--primary);
            outline-offset: 1px;
        }

        /* Subtle animations */
        .nav-link,
        .toggle-btn,
        .action-btn,
        .mobile-menu-btn,
        .user-profile {
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body>
    <div x-data="{
        sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
        sidebarMobileOpen: false,
        userDropdownOpen: false,
        
        toggleSidebar() {
            this.sidebarCollapsed = !this.sidebarCollapsed;
            localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
        },
        
        toggleMobileSidebar() {
            this.sidebarMobileOpen = !this.sidebarMobileOpen;
        },
        
        closeMobileSidebar() {
            this.sidebarMobileOpen = false;
        }
    }">

        <!-- Mobile Overlay -->
        <div class="mobile-overlay" 
             :class="{'active': sidebarMobileOpen}" 
             @click="closeMobileSidebar()"></div>

        <!-- Sidebar -->
        <aside class="sidebar" 
               :class="{
                   'collapsed': sidebarCollapsed,
                   'mobile-open': sidebarMobileOpen
               }">
            
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <div class="logo-container">
                    <div class="logo-icon">
                        <span>SP</span>
                    </div>
                    <div class="logo-text">Sistema Pagos</div>
                </div>
                <button class="toggle-btn" @click="toggleSidebar()">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
            </div>

            <!-- Navigation Content -->
            <div class="nav-content">
                <!-- Principal Section -->
                <div class="nav-section">
                    <div class="nav-section-title">Principal</div>
                    <div class="nav-item">
                        <a href="{{ route('dashboard') }}" 
                           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                           @click="closeMobileSidebar()">
                            <div class="nav-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                            </div>
                            <span class="nav-text">Dashboard</span>
                            <div class="nav-tooltip">Dashboard</div>
                        </a>
                    </div>
                </div>

                <!-- Gestión Section -->
                <div class="nav-section">
                    <div class="nav-section-title">Gestión</div>
                    
                    <div class="nav-item">
                        <a href="{{ route('clients.index') }}" 
                           class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}" 
                           @click="closeMobileSidebar()">
                            <div class="nav-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <span class="nav-text">Clientes</span>
                            <div class="nav-tooltip">Gestión de Clientes</div>
                        </a>
                    </div>

                    <div class="nav-item">
                        <a href="{{ route('contracts.index') }}" 
                           class="nav-link {{ request()->routeIs('contracts.*') ? 'active' : '' }}" 
                           @click="closeMobileSidebar()">
                            <div class="nav-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                </svg>
                            </div>
                            <span class="nav-text">Contratos</span>
                            <div class="nav-tooltip">Gestión de Contratos</div>
                        </a>
                    </div>

                    <div class="nav-item">
                        <a href="{{ route('payments.index') }}" 
                           class="nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }}" 
                           @click="closeMobileSidebar()">
                            <div class="nav-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                </svg>
                            </div>
                            <span class="nav-text">Pagos</span>
                            <span class="nav-badge">12</span>
                            <div class="nav-tooltip">Gestión de Pagos</div>
                        </a>
                    </div>
                </div>

                <!-- Configuración Section -->
                <div class="nav-section">
                    <div class="nav-section-title">Sistema</div>

                    <div class="nav-item">
                        <a href="{{ route('profile.edit') }}"
                           class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                           @click="closeMobileSidebar()">
                            <div class="nav-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <span class="nav-text">Mi Perfil</span>
                            <div class="nav-tooltip">Configuración de Perfil</div>
                        </a>
                    </div>

                    <div class="nav-item">
                        <button class="nav-link danger"
                                @click="document.getElementById('logout-form').submit()"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <div class="nav-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                            </div>
                            <span class="nav-text">Cerrar Sesión</span>
                            <div class="nav-tooltip">Cerrar Sesión</div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- User Profile -->
            <div class="user-profile">
                <div class="user-avatar">
                    {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->name ?? 'Usuario' }}</div>
                    <div class="user-role">Administrador</div>
                </div>
                <div class="status-indicator"></div>
            </div>

            <!-- Hidden logout form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="top-bar-left">
                    <button class="mobile-menu-btn" @click="toggleMobileSidebar()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>
                    <div>
                        <h1 class="page-title">Sistema de Pagos</h1>
                        <div class="breadcrumb">
                            <span>Dashboard</span>
                            <span class="breadcrumb-separator">/</span>
                            <span>Principal</span>
                        </div>
                    </div>
                </div>

                <div class="top-bar-actions">
                    <button class="action-btn" title="Notificaciones">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </button>
                    <button class="action-btn" title="Configuración">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M12 1v6m0 6v6m11-7h-6m-6 0H1"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Page Content -->
            <div class="page-content">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>