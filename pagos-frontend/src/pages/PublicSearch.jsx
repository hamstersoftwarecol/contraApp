import { useState } from 'react';
import { searchService } from '../services/dashboard.service';
import { contractService } from '../services/contracts.service';
import SignatureCanvas from './SignatureCanvas';
import torreRelojBg from '../assets/torre-reloj-popayan.png';

function PublicSearch() {
    const [cedula, setCedula] = useState('');
    const [loading, setLoading] = useState(false);
    const [contracts, setContracts] = useState([]);
    const [clientInfo, setClientInfo] = useState(null);
    const [searched, setSearched] = useState(false);
    const [error, setError] = useState('');
    const [showSignature, setShowSignature] = useState(null);
    const [expandedContract, setExpandedContract] = useState(null);

    const handleSearch = async (e) => {
        e.preventDefault();
        setLoading(true);
        setSearched(true);
        setError('');

        try {
            const response = await searchService.searchContracts(cedula);
            if (response.data && response.data.length > 0) {
                setContracts(response.data);
                setClientInfo(response.data[0].client);
            } else {
                setContracts([]);
                setClientInfo(null);
                setError('No se encontraron contratos para esta cédula');
            }
        } catch (err) {
            setContracts([]);
            setClientInfo(null);
            setError('No se encontraron contratos para esta cédula');
        } finally {
            setLoading(false);
        }
    };

    const handleSignContract = async (contractId, signature) => {
        try {
            await contractService.sign(contractId, signature, cedula);
            const response = await searchService.searchContracts(cedula);
            setContracts(response.data);
            setShowSignature(null);
            alert('Contrato firmado exitosamente');
        } catch (error) {
            console.error('Error al firmar:', error);
            alert(error.response?.data?.message || 'Error al firmar el contrato');
        }
    };

    const getNextPaymentDate = (contract) => {
        if (!contract.payments || contract.payments.length === 0) {
            return new Date(contract.fecha_inicio);
        }
        const lastPayment = contract.payments.sort((a, b) =>
            new Date(b.fecha_pago) - new Date(a.fecha_pago)
        )[0];
        const nextDate = new Date(lastPayment.fecha_pago);
        nextDate.setMonth(nextDate.getMonth() + 1);
        return nextDate;
    };

    const getStatusGradient = (estado, contract) => {
        if (contract?.esta_atrasado) return 'from-red-500 to-red-600';
        if (contract?.esta_por_vencer) return 'from-amber-500 to-orange-500';
        if (estado === 'activo') return 'from-emerald-500 to-green-600';
        if (estado === 'completado') return 'from-blue-500 to-indigo-600';
        return 'from-gray-400 to-gray-500';
    };

    const getStatusText = (estado, contract) => {
        if (contract?.esta_atrasado) return 'Atrasado';
        if (contract?.esta_por_vencer) return 'Por Vencer';
        if (estado === 'activo') return 'Al Día';
        if (estado === 'completado') return 'Completado';
        return 'Cancelado';
    };

    const formatCurrency = (amount) => {
        return new Intl.NumberFormat('es-CO', {
            style: 'currency',
            currency: 'COP',
            minimumFractionDigits: 0,
        }).format(amount);
    };

    const formatDate = (date) => {
        return new Date(date).toLocaleDateString('es-CO', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
        });
    };

    const downloadPDF = (contractId) => {
        const pdfUrl = `${import.meta.env.VITE_API_URL.replace('/api', '')}/contracts/${contractId}/pdf?cedula=${cedula}`;
        window.open(pdfUrl, '_blank');
    };

    if (!searched) {
        // Landing Page with Search
        return (
            <div className="min-h-screen bg-gray-900 relative flex items-center justify-center overflow-hidden">
                {/* Background Image with Overlay */}
                <div
                    className="absolute inset-0 bg-cover bg-center"
                    style={{
                        backgroundImage: `url(${torreRelojBg})`,
                    }}
                >
                    <div className="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
                </div>

                {/* Glass Card */}
                <div className="relative z-10 w-full max-w-md px-4">
                    <div className="backdrop-blur-xl bg-white/10 rounded-3xl p-8 border-2 border-transparent bg-clip-padding"
                        style={{
                            borderImage: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%) 1',
                            boxShadow: '0 8px 32px 0 rgba(102, 126, 234, 0.2), 0 0 0 2px rgba(102, 126, 234, 0.1)',
                        }}>

                        {/* Icon */}
                        <div className="flex justify-center mb-6">
                            <div className="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-500/50">
                                <svg className="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>

                        {/* Title */}
                        <h1 className="text-2xl md:text-3xl font-bold text-white text-center mb-2">
                            Portal de Consulta
                        </h1>
                        <p className="text-white/70 text-center text-xs md:text-sm mb-6 md:mb-8">
                            Acceso exclusivo y seguro
                        </p>

                        {/* Form */}
                        <form onSubmit={handleSearch} className="space-y-4">
                            <div>
                                <label className="block text-white/90 text-xs font-semibold mb-2 uppercase tracking-wide">
                                    Documento o NIT
                                </label>
                                <div className="relative">
                                    <div className="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg className="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        required
                                        className="w-full pl-12 pr-4 py-3.5 bg-white/90 backdrop-blur-sm rounded-xl border border-white/20 focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-500 text-gray-900 font-medium transition-all"
                                        value={cedula}
                                        onChange={(e) => setCedula(e.target.value)}
                                        placeholder="12345678"
                                    />
                                </div>
                                <p className="mt-2 text-xs text-white/60 flex items-center gap-1">
                                    <svg className="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fillRule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clipRule="evenodd" />
                                    </svg>
                                    Ingrese su número de documento o NIT
                                </p>
                            </div>

                            <button
                                type="submit"
                                disabled={loading}
                                className="w-full py-3 md:py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-xl text-sm md:text-base font-semibold shadow-xl shadow-indigo-500/50 hover:shadow-2xl hover:shadow-indigo-500/60 transition-all transform hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                            >
                                {loading ? (
                                    <>
                                        <svg className="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                            <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Buscando...
                                    </>
                                ) : (
                                    <>
                                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        Consultar
                                    </>
                                )}
                            </button>

                            <div className="flex justify-center">
                                <div className="inline-flex items-center gap-2 px-4 py-2 bg-gray-700/50 rounded-full border border-gray-600/50">
                                    <svg className="w-3 h-3 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fillRule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clipRule="evenodd" />
                                    </svg>
                                    <span className="text-xs text-white/70 font-medium">Conexión segura</span>
                                </div>
                            </div>
                        </form>

                        {/* Footer */}
                        <div className="mt-8 text-center">
                            <p className="text-xs text-white/50">
                                © 2026 {import.meta.env.VITE_APP_NAME}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

    // Results Page
    return (
        <div className="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
            {/* Header */}
            <div className="sticky top-0 z-50 backdrop-blur-xl bg-gray-900/80 border-b border-white/10">
                <div className="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
                    <div className="flex items-center gap-3">
                        <div className="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg className="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h1 className="text-lg font-bold text-white">{import.meta.env.VITE_APP_NAME}</h1>
                            <p className="text-xs text-gray-400">Portal de Consulta</p>
                        </div>
                    </div>
                    <button
                        onClick={() => {
                            setSearched(false);
                            setContracts([]);
                            setClientInfo(null);
                            setCedula('');
                        }}
                        className="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg text-sm font-medium transition-all border border-white/10"
                    >
                        Nueva Búsqueda
                    </button>
                </div>
            </div>

            <div className="max-w-6xl mx-auto px-4 py-8">
                {/* Client Info */}
                {clientInfo && (
                    <div className="backdrop-blur-xl bg-white/10 rounded-2xl p-6 border border-white/10 mb-6">
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                            {[
                                { label: 'Cédula', value: clientInfo.cedula },
                                { label: 'Nombre', value: clientInfo.tipo_identificacion === 'NIT' ? clientInfo.razon_social : `${clientInfo.nombre} ${clientInfo.apellido}` },
                                { label: 'Email', value: clientInfo.email || 'N/A' },
                                { label: 'Teléfono', value: clientInfo.telefono || 'N/A' }
                            ].map((item, idx) => (
                                <div key={idx} className="bg-white/5 rounded-xl p-3 border border-white/10">
                                    <p className="text-xs text-gray-400 mb-1">{item.label}</p>
                                    <p className="font-semibold text-sm text-white truncate">{item.value}</p>
                                </div>
                            ))}
                        </div>
                    </div>
                )}

                {/* Results */}
                {error && contracts.length === 0 ? (
                    <div className="backdrop-blur-xl bg-white/10 rounded-2xl p-12 text-center border border-white/10">
                        <div className="w-20 h-20 bg-gray-700/50 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg className="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 className="text-xl font-bold text-white mb-2">No se encontraron contratos</h3>
                        <p className="text-gray-400">Verifica que el número de cédula sea correcto</p>
                    </div>
                ) : (
                    <div className="space-y-4">
                        {contracts.map((contract) => (
                            <div key={contract.id} className="backdrop-blur-xl bg-white/10 rounded-2xl border border-white/10 overflow-hidden hover:bg-white/15 transition-all">
                                <div
                                    className="p-6 cursor-pointer"
                                    onClick={() => setExpandedContract(expandedContract === contract.id ? null : contract.id)}
                                >
                                    <div className="flex items-start justify-between gap-4">
                                        <div className="flex-1">
                                            <div className="flex items-center gap-3 mb-2">
                                                <div className={`w-3 h-3 rounded-full bg-gradient-to-br ${getStatusGradient(contract.estado, contract)}`}></div>
                                                <h3 className="font-bold text-white text-lg">Contrato #{contract.id}</h3>
                                                <span className={`text-xs px-3 py-1 rounded-full bg-gradient-to-r ${getStatusGradient(contract.estado, contract)} text-white font-semibold`}>
                                                    {getStatusText(contract.estado, contract)}
                                                </span>
                                            </div>
                                            {contract.descripcion && (
                                                <p className="text-sm text-gray-300">{contract.descripcion}</p>
                                            )}
                                        </div>
                                        <div className="flex items-center gap-4">
                                            <div className="text-right">
                                                <p className="text-xs text-gray-400">Monto Total</p>
                                                <p className="font-bold text-white">{formatCurrency(contract.monto_total)}</p>
                                            </div>
                                            <div className="text-right">
                                                <p className="text-xs text-gray-400">Cuotas</p>
                                                <p className="font-bold text-white">{contract.payments?.length || 0}/{contract.numero_cuotas}</p>
                                            </div>
                                            <svg
                                                className={`w-6 h-6 text-gray-400 transition-transform ${expandedContract === contract.id ? 'rotate-180' : ''}`}
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2.5} d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>

                                    <div className="mt-4">
                                        <div className="h-2 bg-white/10 rounded-full overflow-hidden">
                                            <div
                                                className={`h-full bg-gradient-to-r ${getStatusGradient(contract.estado, contract)} transition-all duration-700`}
                                                style={{ width: `${((contract.payments?.length || 0) / contract.numero_cuotas) * 100}%` }}
                                            ></div>
                                        </div>
                                    </div>
                                </div>

                                {expandedContract === contract.id && (
                                    <div className="border-t border-white/10 bg-white/5 p-6 space-y-4">
                                        <div className="flex gap-3">
                                            <button
                                                onClick={() => downloadPDF(contract.id)}
                                                className="flex-1 px-4 py-3 bg-white/10 hover:bg-white/20 border border-white/10 rounded-xl text-sm font-semibold text-white flex items-center justify-center gap-2 transition-all"
                                            >
                                                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Descargar PDF
                                            </button>

                                            {contract.firma ? (
                                                <div className="flex-1 px-4 py-3 bg-gradient-to-r from-emerald-500 to-green-600 rounded-xl text-sm font-semibold text-white flex items-center justify-center gap-2">
                                                    <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
                                                    </svg>
                                                    Firmado
                                                </div>
                                            ) : (
                                                <button
                                                    onClick={() => setShowSignature(contract.id)}
                                                    className="flex-1 px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-xl text-sm font-semibold flex items-center justify-center gap-2 shadow-lg transition-all"
                                                >
                                                    <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                    Firmar Contrato
                                                </button>
                                            )}
                                        </div>

                                        <div className="grid grid-cols-2 md:grid-cols-4 gap-3">
                                            {[
                                                { label: 'Valor Cuota', value: formatCurrency(contract.monto_cuota) },
                                                { label: 'Próximo Pago', value: contract.estado === 'activo' && (contract.payments?.length || 0) < contract.numero_cuotas ? formatDate(getNextPaymentDate(contract)) : 'N/A' },
                                                { label: 'Fecha Inicio', value: formatDate(contract.fecha_inicio) },
                                                { label: 'Progreso', value: `${Math.round(((contract.payments?.length || 0) / contract.numero_cuotas) * 100)}%` },
                                            ].map((item, idx) => (
                                                <div key={idx} className="bg-white/5 rounded-xl p-4 border border-white/10">
                                                    <p className="text-xs text-gray-400 mb-2">{item.label}</p>
                                                    <p className="font-bold text-white">{item.value}</p>
                                                </div>
                                            ))}
                                        </div>

                                        {showSignature === contract.id && (
                                            <div className="bg-white/10 rounded-xl p-5 border border-white/10">
                                                <h4 className="font-bold text-white mb-4">✍️ Firmar Contrato</h4>
                                                <SignatureCanvas
                                                    onSave={(signature) => handleSignContract(contract.id, signature)}
                                                    onCancel={() => setShowSignature(null)}
                                                />
                                            </div>
                                        )}

                                        {contract.firma && (
                                            <div className="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-200 shadow-lg">
                                                <div className="flex items-center gap-2 mb-4">
                                                    <div className="w-8 h-8 bg-gradient-to-br from-emerald-500 to-green-600 rounded-full flex items-center justify-center shadow-lg">
                                                        <svg className="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
                                                        </svg>
                                                    </div>
                                                    <h4 className="font-bold text-gray-800">Firma del Contrato</h4>
                                                    <span className="ml-auto text-xs px-3 py-1 bg-green-500 text-white rounded-full font-semibold shadow-md">
                                                        Verificado
                                                    </span>
                                                </div>

                                                <div className="relative bg-white rounded-xl p-8 shadow-inner border-2 border-gray-100">
                                                    <div className="absolute top-3 left-3 w-8 h-8 border-l-2 border-t-2 border-gray-300"></div>
                                                    <div className="absolute top-3 right-3 w-8 h-8 border-r-2 border-t-2 border-gray-300"></div>
                                                    <div className="absolute bottom-3 left-3 w-8 h-8 border-l-2 border-b-2 border-gray-300"></div>
                                                    <div className="absolute bottom-3 right-3 w-8 h-8 border-r-2 border-b-2 border-gray-300"></div>

                                                    <div className="flex flex-col items-center">
                                                        <img
                                                            src={contract.firma}
                                                            alt="Firma Digital"
                                                            className="max-w-sm w-full h-auto mb-4"
                                                        />
                                                        <div className="pt-2 border-t-2 border-gray-800 w-64 text-center">
                                                            <p className="text-sm text-gray-600 font-medium">Firma Digital</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div className="mt-4 flex items-center justify-center gap-2 text-xs text-green-700">
                                                    <svg className="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fillRule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
                                                    </svg>
                                                    <span>Documento firmado digitalmente</span>
                                                </div>
                                            </div>
                                        )}

                                        {contract.payments && contract.payments.length > 0 && (
                                            <div className="bg-white/5 rounded-xl p-5 border border-white/10">
                                                <h4 className="font-bold text-white mb-4 flex items-center gap-2">
                                                    <span className="w-6 h-6 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center text-white text-xs">
                                                        {contract.payments.length}
                                                    </span>
                                                    Historial de Pagos
                                                </h4>
                                                <div className="space-y-2 max-h-72 overflow-y-auto">
                                                    {contract.payments
                                                        .sort((a, b) => new Date(b.fecha_pago) - new Date(a.fecha_pago))
                                                        .map((payment) => (
                                                            <div
                                                                key={payment.id}
                                                                className="bg-white/10 rounded-xl p-4 border border-white/10 hover:bg-white/15 transition-all"
                                                            >
                                                                <div className="flex items-center justify-between">
                                                                    <div className="flex items-center gap-3">
                                                                        <div className="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold">
                                                                            {payment.numero_cuota}
                                                                        </div>
                                                                        <div>
                                                                            <p className="font-bold text-white">{formatCurrency(payment.monto)}</p>
                                                                            <p className="text-xs text-gray-400 capitalize">{payment.metodo_pago}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div className="text-right">
                                                                        <p className="text-xs font-semibold text-white">{formatDate(payment.fecha_pago)}</p>
                                                                        {payment.referencia && (
                                                                            <p className="text-xs text-gray-400">Ref: {payment.referencia}</p>
                                                                        )}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        ))}
                                                </div>
                                            </div>
                                        )}
                                    </div>
                                )}
                            </div>
                        ))}
                    </div>
                )}
            </div>

            <div className="max-w-6xl mx-auto px-4 py-8 text-center">
                <p className="text-xs text-gray-500">
                    © {new Date().getFullYear()} {import.meta.env.VITE_APP_NAME} - Sistema de Gestión de Contratos
                </p>
            </div>
        </div>
    );
}

export default PublicSearch;
