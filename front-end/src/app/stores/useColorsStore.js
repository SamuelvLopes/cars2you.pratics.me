import { defineStore } from 'pinia';
import { getAllColors } from '../services/colors';

export const useColorsStore = defineStore('colors', {
  state: () => ({
    colors: [],
  }),

  actions: {
    async fetchColors() {
      try {
        const data = await getAllColors();
        console.log(data);
        this.colors = data;
      } catch (error) {
        console.error('Erro ao buscar cores:', error);
      }
    },
  },
});
