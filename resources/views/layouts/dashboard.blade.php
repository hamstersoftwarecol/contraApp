<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <!-- Incluimos Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #3b82f6;
            --primary-50: #eff6ff;
            --primary-100: #dbeafe;
            --primary-200: #bfdbfe;
            --primary-800: #1e40af;
            --primary-900: #1e3a8a;
            --secondary: #0ea5e9;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #0f172a;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --topbar-height: 70px;
            
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            
            --transition-default: all 0.3s ease;
            --transition-fast: all 0.15s ease;
            --transition-slow: all 0.5s ease;
            
            --radius-sm: 0.25rem;
            --radius: 0.5rem;
            --radius-md: 0.75rem;
            --radius-lg: 1rem;
            --radius-xl: 1.5rem;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--gray-700);
            background-color: var(--gray-50);
            line-height: 1.5;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            color: var(--gray-900);
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideInLeft {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        /* Layout */
        .dashboard-container {
            display: grid;
            grid-template-columns: var(--sidebar-width) 1fr;
            min-height: 100vh;
            transition: var(--transition-default);
        }
        
        .dashboard-container.collapsed {
            grid-template-columns: var(--sidebar-collapsed-width) 1fr;
        }
        
        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-900) 100%);
            color: white;
            position: fixed;
            width: var(--sidebar-width);
            height: 100vh;
            overflow-x: hidden;
            overflow-y: auto;
            transition: var(--transition-default);
            z-index: 50;
            box-shadow: var(--shadow-lg);
        }
        
        .dashboard-container.collapsed .sidebar {
            width: var(--sidebar-collapsed-width);
        }
        
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: var(--topbar-height);
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            overflow: hidden;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            font-weight: 700;
            flex-shrink: 0;
        }
        
        .logo-text {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 1.25rem;
            white-space: nowrap;
            transition: var(--transition-default);
        }
        
        .dashboard-container.collapsed .logo-text {
            opacity: 0;
            width: 0;
        }
        
        .toggle-sidebar {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-default);
        }
        
        .toggle-sidebar:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .toggle-sidebar i {
            transition: var(--transition-default);
        }
        
        .dashboard-container.collapsed .toggle-sidebar i {
            transform: rotate(180deg);
        }
        
        /* Navigation */
        .sidebar-nav {
            padding: 1.5rem 0;
        }
        
        .nav-section {
            margin-bottom: 1.5rem;
        }
        
        .nav-section-title {
            padding: 0 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 0.75rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: var(--transition-default);
        }
        
        .dashboard-container.collapsed .nav-section-title {
            opacity: 0;
            height: 0;
            margin: 0;
            padding: 0;
        }
        
        .nav-item {
            padding: 0.75rem 1.5rem;
            margin: 0.25rem 0.75rem;
            border-radius: var(--radius-md);
            transition: var(--transition-default);
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .nav-item.active {
            background: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }
        
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: white;
            border-radius: 0 var(--radius) var(--radius) 0;
        }
        
        .nav-icon {
            width: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .nav-text {
            white-space: nowrap;
            transition: var(--transition-default);
        }
        
        .dashboard-container.collapsed .nav-text {
            opacity: 0;
            width: 0;
        }
        
        .nav-badge {
            background: var(--danger);
            color: white;
            font-size: 0.75rem;
            padding: 0.125rem 0.5rem;
            border-radius: var(--radius-full);
            margin-left: auto;
            transition: var(--transition-default);
        }
        
        .dashboard-container.collapsed .nav-badge {
            opacity: 0;
            width: 0;
            margin: 0;
        }
        
        /* Tooltip for collapsed sidebar */
        .nav-tooltip {
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background: var(--dark);
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: var(--radius);
            font-size: 0.875rem;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: var(--transition-fast);
            z-index: 10;
            box-shadow: var(--shadow-lg);
        }
        
        .dashboard-container.collapsed .nav-item:hover .nav-tooltip {
            opacity: 1;
            transform: translateY(-50%) translateX(10px);
        }
        
        /* Sidebar footer */
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }
        
        .sidebar-footer-content {
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-md);
            padding: 1rem;
            transition: var(--transition-default);
        }
        
        .dashboard-container.collapsed .sidebar-footer-content {
            padding: 1rem 0.5rem;
        }
        
        .sidebar-footer-title {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: var(--transition-default);
        }
        
        .dashboard-container.collapsed .sidebar-footer-title {
            opacity: 0;
            height: 0;
            margin: 0;
        }
        
        .sidebar-footer-text {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: var(--transition-default);
        }
        
        .dashboard-container.collapsed .sidebar-footer-text {
            opacity: 0;
            height: 0;
            margin: 0;
        }
        
        .sidebar-footer-button {
            background: white;
            color: var(--primary);
            border: none;
            border-radius: var(--radius);
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: var(--transition-default);
        }
        
        .sidebar-footer-button:hover {
            background: rgba(255, 255, 255, 0.9);
        }
        
        .dashboard-container.collapsed .sidebar-footer-button span {
            display: none;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            transition: var(--transition-default);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .dashboard-container.collapsed .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        /* Top Bar */
        .top-bar {
            height: var(--topbar-height);
            background: white;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 40;
            box-shadow: var(--shadow-sm);
        }
        
        .search-bar {
            position: relative;
            width: 300px;
        }
        
        .search-input {
            width: 100%;
            padding: 0.625rem 1rem 0.625rem 2.5rem;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            font-size: 0.875rem;
            transition: var(--transition-default);
            background-color: var(--gray-50);
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-100);
            background-color: white;
        }
        
        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            pointer-events: none;
        }
        
        .top-bar-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .action-button {
            background: none;
            border: none;
            color: var(--gray-600);
            width: 40px;
            height: 40px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-default);
            position: relative;
        }
        
        .action-button:hover {
            background: var(--gray-100);
            color: var(--gray-900);
        }
        
        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: var(--danger);
            color: white;
            font-size: 0.625rem;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }
        
        /* Profile Menu */
        .profile-menu {
            position: relative;
        }
        
        .profile-button {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition-default);
        }
        
        .profile-button:hover {
            background: var(--gray-100);
        }
        
        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-100);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
        }
        
        .profile-info {
            display: flex;
            flex-direction: column;
        }
        
        .profile-name {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--gray-900);
        }
        
        .profile-role {
            font-size: 0.75rem;
            color: var(--gray-500);
        }
        
        .profile-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 0.5rem);
            background: white;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            min-width: 240px;
            padding: 0.5rem;
            z-index: 50;
            border: 1px solid var(--gray-200);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: var(--transition-default);
        }
        
        .profile-menu.active .profile-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-header {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--gray-200);
            margin-bottom: 0.5rem;
        }
        
        .dropdown-user {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--gray-900);
        }
        
        .dropdown-email {
            font-size: 0.75rem;
            color: var(--gray-500);
            margin-top: 0.25rem;
        }
        
        .dropdown-item {
            padding: 0.75rem 1rem;
            border-radius: var(--radius);
            transition: var(--transition-default);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.875rem;
        }
        
        .dropdown-item:hover {
            background: var(--gray-100);
        }
        
        .dropdown-icon {
            width: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-500);
        }
        
        .dropdown-divider {
            height: 1px;
            background: var(--gray-200);
            margin: 0.5rem 0;
        }
        
        .dropdown-item.danger {
            color: var(--danger);
        }
        
        .dropdown-item.danger .dropdown-icon {
            color: var(--danger);
        }
        
        .dropdown-item.danger:hover {
            background: #fee2e2;
        }
        
        /* Page Content */
        .page-content {
            padding: 2rem;
            flex: 1;
        }
        
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .page-description {
            color: var(--gray-500);
            font-size: 0.875rem;
        }
        
        /* Dashboard Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            transition: var(--transition-default);
            border: 1px solid var(--gray-100);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--gray-200);
        }
        
        .stat-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        
        .stat-icon.blue {
            background: var(--primary-50);
            color: var(--primary);
        }
        
        .stat-icon.green {
            background: #ecfdf5;
            color: var(--success);
        }
        
        .stat-icon.orange {
            background: #fff7ed;
            color: var(--warning);
        }
        
        .stat-icon.red {
            background: #fee2e2;
            color: var(--danger);
        }
        
        .stat-menu {
            color: var(--gray-400);
            cursor: pointer;
            transition: var(--transition-default);
        }
        
        .stat-menu:hover {
            color: var(--gray-700);
        }
        
        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        
        .stat-label {
            color: var(--gray-500);
            font-size: 0.875rem;
        }
        
        .stat-change {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            font-size: 0.875rem;
        }
        
        .stat-change.positive {
            color: var(--success);
        }
        
        .stat-change.negative {
            color: var(--danger);
        }
        
        /* Recent Activity */
        .activity-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
            border: 1px solid var(--gray-100);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        
        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
        }
        
        .card-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .card-button {
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            color: var(--gray-700);
            padding: 0.5rem 1rem;
            border-radius: var(--radius);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition-default);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .card-button:hover {
            background: var(--gray-100);
            color: var(--gray-900);
        }
        
        .card-button.primary {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }
        
        .card-button.primary:hover {
            background: var(--primary-dark);
        }
        
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-100);
        }
        
        .activity-item:last-child {
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }
        
        .activity-icon.blue {
            background: var(--primary-50);
            color: var(--primary);
        }
        
        .activity-icon.green {
            background: #ecfdf5;
            color: var(--success);
        }
        
        .activity-icon.orange {
            background: #fff7ed;
            color: var(--warning);
        }
        
        .activity-icon.red {
            background: #fee2e2;
            color: var(--danger);
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-title {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        
        .activity-title strong {
            font-weight: 600;
            color: var(--gray-900);
        }
        
        .activity-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.75rem;
            color: var(--gray-500);
        }
        
        .activity-time {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        /* Mobile Responsive */
        .mobile-menu-button {
            display: none;
            background: none;
            border: none;
            color: var(--gray-700);
            width: 40px;
            height: 40px;
            border-radius: var(--radius);
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-default);
        }
        
        .mobile-menu-button:hover {
            background: var(--gray-100);
            color: var(--gray-900);
        }
        
        .mobile-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 45;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition-default);
        }
        
        .mobile-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        @media (max-width: 1024px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                transform: translateX(-100%);
                box-shadow: var(--shadow-xl);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0 !important;
            }
            
            .mobile-menu-button {
                display: flex;
            }
            
            .search-bar {
                width: auto;
                flex: 1;
                margin: 0 1rem;
            }
            
            .top-bar {
                padding: 0 1rem;
            }
            
            .top-bar-actions {
                gap: 0.75rem;
            }
            
            .page-content {
                padding: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 640px) {
            .profile-info {
                display: none;
            }
            
            .search-bar {
                max-width: 150px;
            }
        }
        
        /* Dark Mode */
        .dark-mode-toggle {
            background: none;
            border: none;
            color: var(--gray-600);
            width: 40px;
            height: 40px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-default);
        }
        
        .dark-mode-toggle:hover {
            background: var(--gray-100);
            color: var(--gray-900);
        }
        
        /* Utility Classes */
        .flex {
            display: flex;
        }
        
        .items-center {
            align-items: center;
        }
        
        .justify-between {
            justify-content: space-between;
        }
        
        .gap-2 {
            gap: 0.5rem;
        }
        
        .gap-3 {
            gap: 0.75rem;
        }
        
        .gap-4 {
            gap: 1rem;
        }
        
        .text-sm {
            font-size: 0.875rem;
        }
        
        .font-medium {
            font-weight: 500;
        }
        
        .text-gray-400 {
            color: var(--gray-400);
        }
        
        .text-gray-700 {
            color: var(--gray-700);
        }
        
        .w-full {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="dashboard-container" id="dashboardContainer">
        <!-- Mobile Overlay -->
        <div class="mobile-overlay" id="mobileOverlay"></div>
        
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-container">
                    <div class="logo-icon">S</div>
                    <div class="logo-text">Sistema de Pagos</div>
                </div>
                <button class="toggle-sidebar" id="toggleSidebar">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
            
            <div class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Principal</div>
                    
                    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <div class="nav-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <span class="nav-text">Dashboard</span>
                        <div class="nav-tooltip">Dashboard</div>
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">Gestión</div>
                    
                    <a href="{{ route('clients.index') }}" class="nav-item {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                        <div class="nav-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="nav-text">Clientes</span>
                        <div class="nav-badge">8</div>
                        <div class="nav-tooltip">Clientes</div>
                    </a>

                    <a href="{{ route('contracts.index') }}" class="nav-item {{ request()->routeIs('contracts.*') ? 'active' : '' }}">
                        <div class="nav-icon">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <span class="nav-text">Contratos</span>
                        <div class="nav-tooltip">Contratos</div>
                    </a>

                    <a href="{{ route('payments.index') }}" class="nav-item {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                        <div class="nav-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <span class="nav-text">Pagos</span>
                        <div class="nav-badge">3</div>
                        <div class="nav-tooltip">Pagos</div>
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">Configuración</div>
                    
                    <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <div class="nav-icon">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <span class="nav-text">Mi Perfil</span>
                        <div class="nav-tooltip">Mi Perfil</div>
                    </a>
                    
                    <a href="#" class="nav-item">
                        <div class="nav-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <span class="nav-text">Configuración</span>
                        <div class="nav-tooltip">Configuración</div>
                    </a>
                </div>
            </div>
            
            <div class="sidebar-footer">
                <div class="sidebar-footer-content">
                    <div class="sidebar-footer-title">¿Necesitas ayuda?</div>
                    <div class="sidebar-footer-text">Accede a nuestros recursos de soporte</div>
                    <button class="sidebar-footer-button">
                        <i class="fas fa-question-circle"></i>
                        <span>Centro de Ayuda</span>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Contenido Principal -->
        <main class="main-content">
            <div class="top-bar">
                <button class="mobile-menu-button" id="mobileMenuButton">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Buscar...">
                    <i class="fas fa-search search-icon"></i>
                </div>
                
                <div class="top-bar-actions">
                    <button class="dark-mode-toggle" id="darkModeToggle">
                        <i class="fas fa-moon"></i>
                    </button>
                    
                    <button class="action-button">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    
                    <div class="profile-menu" id="profileMenu">
                        <div class="profile-button">
                            <div class="profile-avatar">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="profile-info">
                                <div class="profile-name">{{ Auth::user()->name }}</div>
                                <div class="profile-role">Administrador</div>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                        
                        <div class="profile-dropdown">
                            <div class="dropdown-header">
                                <div class="dropdown-user">{{ Auth::user()->name }}</div>
                                <div class="dropdown-email">{{ Auth::user()->email }}</div>
                            </div>
                            
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <div class="dropdown-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span>Mi Perfil</span>
                            </a>
                            
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-icon">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <span>Configuración</span>
                            </a>
                            
                            <div class="dropdown-divider"></div>
                            
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="dropdown-item danger w-full">
                                    <div class="dropdown-icon">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </div>
                                    <span>Cerrar Sesión</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div> 
</div>      

  

    <script>
        // Toggle sidebar
        const dashboardContainer = document.getElementById('dashboardContainer');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        
        toggleSidebar.addEventListener('click', () => {
            dashboardContainer.classList.toggle('collapsed');
        });
        
        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.add('active');
            mobileOverlay.classList.add('active');
        });
        
        mobileOverlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            mobileOverlay.classList.remove('active');
        });
        
        // Profile dropdown
        const profileMenu = document.getElementById('profileMenu');
        
        profileMenu.addEventListener('click', () => {
            profileMenu.classList.toggle('active');
        });
        
        document.addEventListener('click', (e) => {
            if (!profileMenu.contains(e.target)) {
                profileMenu.classList.remove('active');
            }
        });
        
        // Dark mode toggle (placeholder - would need additional CSS)
        const darkModeToggle = document.getElementById('darkModeToggle');
        
        darkModeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            
            if (document.body.classList.contains('dark-mode')) {
                darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            } else {
                darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
            }
        });
    </script>
</body>
</html>