import { createRouter, createWebHistory } from 'vue-router';
import index from '../../resources/js/To_do_List/index.vue';
import Ajouter_Taches from '../../resources/js/To_do_List/Ajouter_Taches.vue';
import Modifier from '../../resources/js/To_do_List/Modify.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: index
  },

  {
    path: '/Ajouter',
    name: 'Ajouter',
    component: Ajouter_Taches
  },
  {
    path: '/modifier/:id',
    name: 'Modifier',
    component: Modifier,
    props: (route) => ({ id: route.params.id })
  }
  
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
