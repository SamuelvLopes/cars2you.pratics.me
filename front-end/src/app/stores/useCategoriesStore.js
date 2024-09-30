import { defineStore } from 'pinia';
import { getAllCategories } from '../services/categories';

export const useCategoriesStore = defineStore('categories', {
  state: () => ({
    categories: [],
  }),

  actions: {
    async fetchCategories() {
      try {
        const data = await getAllCategories();
        this.categories = data.data;
      } catch (error) {
        console.error('Erro ao buscar categorias:', error);
      }
    },
  },
});
