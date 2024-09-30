import { createRouter, createWebHistory } from 'vue-router';
import Home from '../../views/pages/Home.vue';
import VehicleForm from '../../views/pages/VehicleForm.vue';

const routes = [
  { path: '/', component: Home },
  {
    path: '/cadastrar-veiculo',
    component: VehicleForm,
    meta: { isEditing: false },
  },
  {
    path: '/atualizar-veiculo/:id',
    component: VehicleForm,
    meta: { isEditing: true },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
