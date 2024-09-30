<script>
 import NavBar from './views/components/NavBar.vue';

  export default {
    name: 'App',
    components: {
    NavBar,
  },
};
</script>

<template>
  <div>
    <NavBar />  
    <router-view></router-view>
  </div>
</template>


<style>
nav {
  margin-bottom: 20px;
}
router-link {
  margin-right: 15px;
}
</style>
