import { useQuery } from '@tanstack/react-query';
import { contractService } from '../../services/contracts.service';

function ContractList() {
    const { data, isLoading } = useQuery({
        queryKey: ['contracts'],
        queryFn: () => contractService.getAll(),
    });

    if (isLoading) {
        return <div className="text-center py-8">Cargando...</div>;
    }

    const contracts = data?.data?.data || [];

    const getStatusBadge = (contract) => {
        if (contract.esta_atrasado) {
            return <span className="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Atrasado</span>;
        } else if (contract.esta_por_vencer) {
            return <span className="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Por Vencer</span>;
        } else if (contract.estado === 'activo') {
            return <span className="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Al Día</span>;
        } else if (contract.estado === 'completado') {
            return <span className="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Completado</span>;
        } else {
            return <span className="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Cancelado</span>;
        }
    };

    return (
        <div className="space-y-6">
            <div className="flex justify-between items-center">
                <h1 className="text-3xl font-bold text-gray-900">Contratos</h1>
                <button className="btn btn-primary">
                    + Nuevo Contrato
                </button>
            </div>

            <div className="card">
                <div className="overflow-x-auto">
                    <table className="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cliente
                                </th>
                                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Monto Total
                                </th>
                                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cuotas
                                </th>
                                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pagadas
                                </th>
                                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                            </tr>
                        </thead>
                        <tbody className="bg-white divide-y divide-gray-200">
                            {contracts.map((contract) => (
                                <tr key={contract.id} className="hover:bg-gray-50">
                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{contract.id}
                                    </td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {contract.client?.tipo_identificacion === 'NIT'
                                            ? contract.client?.razon_social
                                            : `${contract.client?.nombre} ${contract.client?.apellido}`
                                        }
                                    </td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ${parseFloat(contract.monto_total).toLocaleString()}
                                    </td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {contract.numero_cuotas}
                                    </td>
                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {contract.payments?.length || 0} / {contract.numero_cuotas}
                                    </td>
                                    <td className="px-6 py-4 whitespace-nowrap">
                                        {getStatusBadge(contract)}
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

export default ContractList;
