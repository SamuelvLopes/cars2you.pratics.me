<script>
import { computed, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useVehiclesStore } from '../../app/stores/useVehiclesStore';

export default {
  setup() {
    const vehiclesStore = useVehiclesStore();
    const router = useRouter();

    // Estado para controlar a página atual
    const currentPage = ref(1);
    const totalPages = ref(1);
    const nextPageUrl = ref(null);
    const prevPageUrl = ref(null);

    // Carrega veículos da página atual
    const fetchVehicles = async (page = 1) => {
    const response = await vehiclesStore.fetchVehicles(page);
    currentPage.value = response.current_page; // Usa a página atual da resposta da API
    totalPages.value = response.last_page; // Usa o total de páginas da resposta da API
    nextPageUrl.value = page < totalPages.value ? page + 1 : null; // Próxima página
    prevPageUrl.value = page > 1 ? page - 1 : null; // Página anterior
  };

    // Carrega os veículos inicialmente
    fetchVehicles(currentPage.value);

    // Reatividade do campo de busca
    const searchQuery = ref('');

    // Computed para veículos
    const vehicles = computed(() => vehiclesStore.vehicles);

    // Computed para filtrar veículos por marca ou modelo
    const filteredVehicles = computed(() => {
      if (!searchQuery.value) {
        return vehicles.value;
      }
      return vehicles.value.filter(vehicle =>
        vehicle.brand.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        vehicle.model.name.toLowerCase().includes(searchQuery.value.toLowerCase())
      );
    });

    const editVehicle = (id) => {
      router.push({ path: `/atualizar-veiculo/${id}` });
    };

    // Funções para navegar entre as páginas
    const goToNextPage = () => {
      if (nextPageUrl.value) {
        fetchVehicles(currentPage.value + 1);
      }
    };

    const goToPreviousPage = () => {
      if (prevPageUrl.value) {
        fetchVehicles(currentPage.value - 1);
      }
    };

    return {
      searchQuery,
      filteredVehicles,
      editVehicle,
      deleteVehicle: vehiclesStore.deleteVehicle,
      currentPage,
      totalPages,
      goToNextPage,
      goToPreviousPage,
    };
  },
};
</script>

<template>
  <div class="list has-visible-pointer-controls has-hoverable-list-items" id="vehicles-list">
    <!-- Campo de busca -->
    <input
      v-model="searchQuery"
      type="text"
      placeholder="Buscar por marca ou modelo"
      class="input search-input"
    />

    <!-- Lista de veículos filtrados -->
    <div v-for="vehicle in filteredVehicles" :key="vehicle.id" class="list-item" id="vehicle-item">
      <div class="list-item-content">
        <div class="list-details">
          <div class="list-item-image">
            <figure class="image is-64x64">
              <img class="is-rounded" :src="vehicle.photo" alt="Vehicle image">
            </figure>
          </div>

          <div class="list-about">
            <div class="list-item-title">{{ vehicle.brand.name }} {{ vehicle.model.name }} - {{ vehicle.manufacture_year }}</div>
            <div class="list-item-description">Cor: {{ vehicle.color.name }} | Peso: {{ vehicle.weight }} kg</div>
          </div>
        </div>
      </div>

      <div class="list-item-controls">
        <div class="buttons is-right" id='button-options'>
          <button class="button" @click="editVehicle(vehicle.id)">
            <span class="icon is-small">
              <i class="fas fa-edit"></i>
            </span>
            <span>Alterar</span>
          </button>

          <button class="button is-danger" @click="deleteVehicle(vehicle.id)">
            <span class="icon">
              <i class="fas fa-trash-alt"></i>
            </span>
            <span>Excluir</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Controles de paginação -->
    <div class="pagination-controls">
      <button class="button" :disabled="currentPage === 1" @click="goToPreviousPage">Anterior</button>
      <span>{{ currentPage }} de {{ totalPages }}</span>
      <button class="button" :disabled="currentPage === totalPages" @click="goToNextPage">Próxima</button>
    </div>
  </div>
</template>

<style scoped>
  #vehicles-list {
    width: 50%;
    margin: 6rem auto 2rem auto;
  }

  .search-input {
    margin-bottom: 20px;
    width: 100%;
    padding: 10px;
    font-size: 1.1rem;
  }

  #vehicle-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 1.2rem 0;
    padding-bottom: 2rem;
    border-bottom: 1px solid #888;
  }

  #vehicle-item:nth-child(11) {
  padding-bottom: 0;
  border-bottom: none;
}

  .list-details {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .list-item-title {
    font-weight: bold;
    font-size: 1.2rem;
    margin-top: .8rem;
  }

  .list-about {
    margin-left: .8rem;
    display: flex;
    flex-direction: column;
    align-items: start;
    justify-content: center;
  }

  #button-options {
    display: flex; 
    flex-direction: column; 
    width: 100%;
  }

  .pagination-controls {
    width: 100%;
    padding: 2rem;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
  }

  /* Responsividade */
  @media (max-width: 768px) {
    #vehicles-list {
      margin: 4rem auto 2rem auto;
      width: 90%;
    }

    #vehicle-item {
      flex-direction: column;
      align-items: flex-start;
    }

    .list-item-controls {
      margin-top: 1rem;
      width: 100%;
      display: flex;
      justify-content: space-between;
    }

    .list-item-title,
    .list-item-description {
      font-size: 1rem;
    }

    .buttons.is-right {
      justify-content: space-between;
      width: 100%;
    }

    .buttons .button {
      flex-grow: 1;
      margin-right: 0.5rem;
    }
  }

  /* Ajuste para tablets */
  @media (max-width: 1024px) {
    #vehicles-list {
      width: 80%;
    }

    .list-item-title,
    .list-item-description {
      font-size: 1.2rem;
    }
  }
</style>
