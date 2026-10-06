import api from './api';

export const clientService = {
    getAll: async (params = {}) => {
        const response = await api.get('/clients', { params });
        return response.data;
    },

    getById: async (id) => {
        const response = await api.get(`/clients/${id}`);
        return response.data;
    },

    create: async (clientData) => {
        const response = await api.post('/clients', clientData);
        return response.data;
    },

    update: async (id, clientData) => {
        const response = await api.put(`/clients/${id}`, clientData);
        return response.data;
    },

    delete: async (id) => {
        const response = await api.delete(`/clients/${id}`);
        return response.data;
    },

    getContracts: async (id) => {
        const response = await api.get(`/clients/${id}/contracts`);
        return response.data;
    },
};
