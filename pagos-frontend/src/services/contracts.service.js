import api from './api';

export const contractService = {
    getAll: async (params = {}) => {
        const response = await api.get('/contracts', { params });
        return response.data;
    },

    getById: async (id) => {
        const response = await api.get(`/contracts/${id}`);
        return response.data;
    },

    create: async (contractData) => {
        const response = await api.post('/contracts', contractData);
        return response.data;
    },

    update: async (id, contractData) => {
        const response = await api.put(`/contracts/${id}`, contractData);
        return response.data;
    },

    delete: async (id) => {
        const response = await api.delete(`/contracts/${id}`);
        return response.data;
    },

    getPayments: async (id) => {
        const response = await api.get(`/contracts/${id}/payments`);
        return response.data;
    },

    sign: async (id, signature, cedula) => {
        const response = await api.post(`/contracts/${id}/sign`, {
            firma: signature,
            cedula: cedula
        });
        return response.data;
    },

    downloadPdf: (id) => {
        return `${import.meta.env.VITE_API_URL}/contracts/${id}/pdf`;
    },
};
