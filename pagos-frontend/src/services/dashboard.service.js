import api from './api';

export const dashboardService = {
    getStats: async () => {
        const response = await api.get('/dashboard/stats');
        return response.data;
    },

    getRecentPayments: async (limit = 10) => {
        const response = await api.get('/dashboard/recent-payments', { params: { limit } });
        return response.data;
    },

    getContractsStatus: async () => {
        const response = await api.get('/dashboard/contracts-status');
        return response.data;
    },

    getMonthlyIncome: async (months = 12) => {
        const response = await api.get('/dashboard/monthly-income', { params: { months } });
        return response.data;
    },
};

export const searchService = {
    searchContracts: async (cedula) => {
        const response = await api.get('/search/contracts', { params: { cedula } });
        return response.data;
    },
};
