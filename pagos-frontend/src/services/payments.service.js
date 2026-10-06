import api from './api';

export const paymentService = {
    getAll: async (params = {}) => {
        const response = await api.get('/payments', { params });
        return response.data;
    },

    getById: async (id) => {
        const response = await api.get(`/payments/${id}`);
        return response.data;
    },

    create: async (paymentData) => {
        const response = await api.post('/payments', paymentData);
        return response.data;
    },

    update: async (id, paymentData) => {
        const response = await api.put(`/payments/${id}`, paymentData);
        return response.data;
    },

    delete: async (id) => {
        const response = await api.delete(`/payments/${id}`);
        return response.data;
    },

    getByContract: async (contractId) => {
        const response = await api.get(`/payments/contract/${contractId}`);
        return response.data;
    },
};
