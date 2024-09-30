import { defineStore } from 'pinia';
import { getAllBrands } from '../services/brands';

export const useBrandsStore = defineStore('brands', {
  state: () => ({
    brands: [],
  }),

  actions: {
    async fetchBrands() {
      try {
        const data = await getAllBrands();
        this.brands = data.data;
      } catch (error) {
        console.error('Erro ao buscar marcas:', error);
      }
    },
  },
});
