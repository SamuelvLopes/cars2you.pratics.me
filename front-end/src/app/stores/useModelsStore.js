import { defineStore } from 'pinia';
import { getAllModels } from '../services/models';

export const useModelsStore = defineStore('models', {
  state: () => ({
    models: [],
  }),

  actions: {
    async fetchModels() {
      try {
        const data = await getAllModels();
        this.models = data.data;
      } catch (error) {
        console.error('Erro ao buscar modelos:', error);
      }
    },
  },
});
