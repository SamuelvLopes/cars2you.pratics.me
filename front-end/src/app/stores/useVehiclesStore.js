import { defineStore } from 'pinia';
import {
  addNewVehicle,
  getAllVehicles,
  getVehicleById,
  removeVehicle,
  updateVehicle,
} from '../services/vehicles';

export const useVehiclesStore = defineStore('vehicles', {
  state: () => ({
    vehicles: [],
    selectedVehicle: null,
    pagination: {
      currentPage: 1,
      lastPage: 1,
    }, // Estado para paginação
  }),

  actions: {
    // Buscar veículos com paginação
    async fetchVehicles(page = 1) {
      try {
        const response = await getAllVehicles(page);
        this.vehicles = response.data; // Atribuir a lista de veículos ao estado
        this.pagination.currentPage = response.current_page; // Atribuir a página atual
        this.pagination.lastPage = response.last_page; // Atribuir o total de páginas
        return response; // Retorna os dados da API para serem usados no componente
      } catch (error) {
        console.error('Erro ao buscar veículos:', error);
        throw error; // Lança o erro para que o componente possa lidar com ele
      }
    },

    async fetchVehicleById(id) {
      try {
        const vehicle = await getVehicleById(id);
        this.selectedVehicle = vehicle;
      } catch (error) {
        console.error('Erro ao buscar veículo:', error);
      }
    },

    async deleteVehicle(id) {
      try {
        await removeVehicle(id);
        this.vehicles = this.vehicles.filter((vehicle) => vehicle.id !== id);
        alert('Veículo removido com sucesso!');
      } catch (error) {
        console.error('Erro ao remover veículo:', error);
        alert('Erro ao remover veículo.');
      }
    },

    async addNewVehicle(vehicle) {
      try {
        const newVehicle = await addNewVehicle(vehicle);
        this.vehicles.push(newVehicle);
        alert('Veículo adicionado com sucesso!');
      } catch (error) {
        console.error('Erro ao adicionar veículo:', error);
        alert('Erro ao adicionar veículo.');
      }
    },

    async updateVehicle(vehicle) {
      try {
        const updatedVehicle = await updateVehicle(vehicle, vehicle.id);
        const index = this.vehicles.findIndex((v) => v.id === vehicle.id);
        if (index !== -1) {
          this.vehicles[index] = updatedVehicle;
        }
        alert('Veículo atualizado com sucesso!');
      } catch (error) {
        console.error('Erro ao atualizar veículo:', error);
        alert('Erro ao atualizar veículo.');
      } finally {
        this.selectedVehicle = null;
      }
    },
  },
});
