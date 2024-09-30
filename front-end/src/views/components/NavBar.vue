<script>
export default {
  data() {
    return {
      currentTheme: 'dark',
    };
  },
  mounted() {
    this.currentTheme = document.documentElement.getAttribute('data-theme') || 'light';

    document.addEventListener('DOMContentLoaded', () => {
      const navbarBurgers = Array.prototype.slice.call(
        document.querySelectorAll('.navbar-burger'),
        0
      );

      navbarBurgers.forEach((el) => {
        el.addEventListener('click', () => {
          const target = el.dataset.target;
          const targetById = document.getElementById(target);

          el.classList.toggle('is-active');
          targetById.classList.toggle('is-active');
        });
      });
    });
  },
  methods: {
    toggleTheme() {
      const htmlElement = document.documentElement;
      const currentTheme = htmlElement.getAttribute('data-theme');
      if (currentTheme === 'dark') {
        htmlElement.setAttribute('data-theme', 'light');
        this.currentTheme = 'light';
      } else {
        htmlElement.setAttribute('data-theme', 'dark');
        this.currentTheme = 'dark';
      }
    },
  },
};

</script>

<template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
        <a class="navbar-item">
          <router-link v-if="currentTheme === 'dark'" class="dark" to="/">Home</router-link>
          <router-link v-else class="ligth" to="/">Home</router-link>
        </a>

        <a class="navbar-item">
          <router-link v-if="currentTheme === 'dark'" class="dark" to="/cadastrar-veiculo">Cadastrar Veiculo</router-link>
          <router-link v-else class="ligth" to="/cadastrar-veiculo">Cadastrar Veiculo</router-link>
        </a>
      </div>

      <div class="navbar-end">
        <div class="navbar-item">
          <button class="button is-rounded" @click="toggleTheme">
            <span class="icon is-small">
              <i v-if="currentTheme === 'dark'" class="far fa-moon"></i>
              <i v-else class="fas fa-sun"></i>
            </span>
          </button>
        </div>
      </div>
    </div>
  </nav>
</template>

<style>
  nav {
    border-bottom: 1px solid #888;
  }

  .navbar-burger {
    margin-inline-start: initial;
    margin-inline-start: 0.375rem;  
  }

  .ligth {
    color: #000
  }

  .dark {
    color: #FFF
  }
</style>