<script>
import { computed, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useBrandsStore } from '../../app/stores/useBrandsStore';
import { useCategoriesStore } from '../../app/stores/useCategoriesStore';
import { useColorsStore } from '../../app/stores/useColorsStore';
import { useModelsStore } from '../../app/stores/useModelsStore';
import { useVehiclesStore } from '../../app/stores/useVehiclesStore';

export default {
  setup() {
    const vehiclesStore = useVehiclesStore();
    const categoriesStore = useCategoriesStore();
    const modelsStore = useModelsStore();
    const brandsStore = useBrandsStore();
    const colorsStore = useColorsStore();

    const router = useRouter();
    const route = useRoute();

    const vehicle = ref({
      brand_id: null,
      category_id: null,
      manufacture_year: null,
      model_id: null,
      weight: null,
      color_id: null,
      status_id: 1, // Ativo por padrão
    });

    const errors = ref({});

    // Carregar as categorias
    categoriesStore.fetchCategories();
    modelsStore.fetchModels();
    brandsStore.fetchBrands();
    colorsStore.fetchColors();

    const isEditing = computed(() => !!route.meta.isEditing);
    const categories = computed(() => categoriesStore.categories);
    const models = computed(() => modelsStore.models);
    const brands = computed(() => brandsStore.brands);
    const colors = computed(() => colorsStore.colors);

    // Carregar dados do veículo se estiver editando
    if (isEditing.value) {
      const vehicleId = route.params.id;
      vehiclesStore.fetchVehicleById(vehicleId).then((data) => {
        vehicle.value = { ...vehiclesStore.selectedVehicle };
      });
    }

    // Validações
    const validateForm = () => {
      const validationErrors = {};

      if (vehicle.value.ano <= 0) {
        validationErrors.ano = 'O ano do veículo não pode ser negativo ou zero.';
      }
      if (vehicle.value.peso <= 0) {
        validationErrors.peso = 'O peso do veículo não pode ser negativo ou zero.';
      }

      errors.value = validationErrors;
      return Object.keys(validationErrors).length === 0;
    };

    // Submissão do formulário
    const submitForm = async () => {
      if (validateForm()) {
        if (isEditing.value) {
          await vehiclesStore.updateVehicle(vehicle.value);
        } else {
          await vehiclesStore.addNewVehicle(vehicle.value);
        }
        
      // Limpar o estado do veículo selecionado após a submissão
        vehiclesStore.selectedVehicle = null;

        router.push('/'); // Redireciona para a página inicial
      } else {
        console.log('Erro de validação no formulário');
      }
    };

    return {
      vehicle,
      categories,
      colors,
      brands,
      models,
      errors,
      isEditing,
      submitForm,
    };
  },
};
</script>

<template>
  <div class="form-page content">
    <h1>{{ isEditing ? 'Atualizar Veículo' : 'Cadastrar Veículo' }}</h1>
    <form @submit.prevent="submitForm">
      <!-- Campo para Marca -->
      <label for="brand">Marca do Veículo:</label>
      <select class="input" v-model="vehicle.brand_id" id="brand" required>
        <option v-for="brand in brands" :key="brand.id" :value="brand.id">
          {{ brand.name }}
        </option>
      </select>


      <!-- Campo para Modelo -->
      <label for="model">Modelo do Veículo:</label>
      <select class="input" v-model="vehicle.model_id" id="model" required>
        <option v-for="model in models" :key="model.id" :value="model.id">
          {{ model.name }}
        </option>
      </select>

      <!-- Campo para Ano -->
      <label for="ano">Ano do Veículo:</label>
      <input class="input" type="number" v-model="vehicle.manufacture_year" id="ano" required />
      <p v-if="errors.ano" class="error">{{ errors.ano }}</p>

      <!-- Campo para Peso -->
      <label for="peso">Peso do Veículo (kg):</label>
      <input class="input" type="number" step="0.1" v-model="vehicle.weight" id="peso" required />
      <p v-if="errors.peso" class="error">{{ errors.peso }}</p>

      <!-- Campo para Cor -->
      <label for="color">Cor do Veículo:</label>
      <select class="input" v-model="vehicle.color_id" id="color" required>
        <option v-for="color in colors" :key="color.id" :value="color.id">
          {{ color.name }}
        </option>
      </select>

      <!-- Campo para Categoria -->
      <label for="category">Categoria do Veículo:</label>
      <select class="input" v-model="vehicle.category_id" id="category" required>
        <option v-for="category in categories" :key="category.id" :value="category.id">
          {{ category.name }}
        </option>
      </select>

      <!-- Campo para Status -->
      <label for="status">Status do Veículo:</label>
      <select class="input" v-model="vehicle.status_id  " id="status" required>
        <option value="1">Ativo</option>
        <option value="2">Inativo</option>
      </select>

      <button class="button is-medium is-primary" type="submit">{{ isEditing ? 'Atualizar' : 'Cadastrar' }}</button>
    </form>
  </div>
</template>

<style scoped>
.form-page {
  text-align: center;
}

form {
  display: flex;
  flex-direction: column;
  width: 40%;
  margin: 0 auto;
}

form label {
  text-align: start;
}

form label,
input,
select {
  margin: 10px 0;
}

button {
  margin: 40px 0;
}

.error {
  color: red;
  font-size: 0.9rem;
  text-align: start;
}

  /* Responsividade */
  @media (max-width: 768px) {
    form {
      width: 90%;
    }
  }
</style>
