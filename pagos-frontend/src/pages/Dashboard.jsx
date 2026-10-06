import { useState } from 'react';
import { useQuery } from '@tanstack/react-query';
import { dashboardService } from '../services/dashboard.service';
import { BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer } from 'recharts';

function Dashboard() {
    const { data: stats, isLoading: statsLoading } = useQuery({
        queryKey: ['dashboard-stats'],
        queryFn: () => dashboardService.getStats(),
    });

    const { data: monthlyIncome } = useQuery({
        queryKey: ['monthly-income'],
        queryFn: () => dashboardService.getMonthlyIncome(),
    });

    const { data: recentPayments } = useQuery({
        queryKey: ['recent-payments'],
        queryFn: () => dashboardService.getRecentPayments(5),
    });

    if (statsLoading) {
        return (
            <div className="flex items-center justify-center h-64">
                <div className="text-lg text-gray-600">Cargando...</div>
            </div>
        );
    }

    const statsData = stats?.data || {};
    const incomeData = monthlyIncome?.data || [];
    const payments = recentPayments?.data || [];

    return (
        <div className="space-y-6">
            <h1 className="text-3xl font-bold text-gray-900">Dashboard</h1>

            {/* Stats Grid */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div className="card bg-gradient-to-br from-blue-500 to-blue-600 text-white">
                    <div className="text-sm opacity-90">Total Clientes</div>
                    <div className="text-3xl font-bold mt-2">{statsData.total_clients}</div>
                </div>

                <div className="card bg-gradient-to-br from-green-500 to-green-600 text-white">
                    <div className="text-sm opacity-90">Contratos Activos</div>
                    <div className="text-3xl font-bold mt-2">{statsData.active_contracts}</div>
                </div>

                <div className="card bg-gradient-to-br from-yellow-500 to-yellow-600 text-white">
                    <div className="text-sm opacity-90">Por Vencer</div>
                    <div className="text-3xl font-bold mt-2">{statsData.contracts_expiring_soon}</div>
                </div>

                <div className="card bg-gradient-to-br from-red-500 to-red-600 text-white">
                    <div className="text-sm opacity-90">Atrasados</div>
                    <div className="text-3xl font-bold mt-2">{statsData.contracts_overdue}</div>
                </div>
            </div>

            {/* Income Chart */}
            <div className="card">
                <h2 className="text-xl font-bold mb-4">Ingresos Mensuales</h2>
                <ResponsiveContainer width="100%" height={300}>
                    <BarChart data={incomeData}>
                        <CartesianGrid strokeDasharray="3 3" />
                        <XAxis dataKey="month_name" />
                        <YAxis />
                        <Tooltip />
                        <Bar dataKey="income" fill="#3b82f6" />
                    </BarChart>
                </ResponsiveContainer>
            </div>

            {/* Recent Payments */}
            <div className="card">
                <h2 className="text-xl font-bold mb-4">Pagos Recientes</h2>
                <div className="overflow-x-auto">
                    <table className="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha
                                </th>
                                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cliente
                                </th>
                                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Monto
                                </th>
                                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Método
                                </th>
                            </tr>
                        </thead>
                        <tbody className="bg-white divide-y divide-gray-200">
                            {payments.map((payment) => (
                                <tr key={payment.id}>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {new Date(payment.fecha_pago).toLocaleDateString()}
                                    </td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {payment.contract?.client?.nombre} {payment.contract?.client?.apellido}
                                    </td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        ${parseFloat(payment.monto).toLocaleString()}
                                    </td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                        {payment.metodo_pago}
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    );
}

export default Dashboard;
