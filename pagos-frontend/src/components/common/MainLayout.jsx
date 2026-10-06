import { Outlet, Link, useNavigate } from 'react-router-dom';
import { authService } from '../../services/auth.service';

function MainLayout() {
    const navigate = useNavigate();
    const user = authService.getCurrentUser();

    const handleLogout = async () => {
        await authService.logout();
        navigate('/login');
    };

    return (
        <div className="min-h-screen bg-gray-50">
            {/* Navigation */}
            <nav className="bg-white shadow-sm border-b">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between h-16">
                        <div className="flex">
                            <div className="flex-shrink-0 flex items-center">
                                <h1 className="text-2xl font-bold text-primary-600">
                                    {import.meta.env.VITE_APP_NAME}
                                </h1>
                            </div>
                            <div className="hidden sm:ml-8 sm:flex sm:space-x-8">
                                <Link
                                    to="/"
                                    className="border-transparent text-gray-700 hover:text-primary-600 hover:border-primary-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition"
                                >
                                    Dashboard
                                </Link>
                                <Link
                                    to="/clients"
                                    className="border-transparent text-gray-700 hover:text-primary-600 hover:border-primary-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition"
                                >
                                    Clientes
                                </Link>
                                <Link
                                    to="/contracts"
                                    className="border-transparent text-gray-700 hover:text-primary-600 hover:border-primary-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition"
                                >
                                    Contratos
                                </Link>
                                <Link
                                    to="/payments"
                                    className="border-transparent text-gray-700 hover:text-primary-600 hover:border-primary-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition"
                                >
                                    Pagos
                                </Link>
                            </div>
                        </div>
                        <div className="flex items-center">
                            <span className="text-sm text-gray-700 mr-4">
                                {user?.name}
                            </span>
                            <button
                                onClick={handleLogout}
                                className="btn btn-secondary text-sm"
                            >
                                Cerrar Sesión
                            </button>
                        </div>
                    </div>
                </div>
            </nav>

            {/* Main Content */}
            <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <Outlet />
            </main>
        </div>
    );
}

export default MainLayout;
