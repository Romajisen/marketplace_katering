<!-- src/components/Customer/MenuDetails.vue -->

<template>
    <div class="menu-details" v-if="menu">
      <h3>{{ menu.name }}</h3>
      <p>{{ menu.description }}</p>
      <p>Price: {{ menu.price }}</p>
      <button @click="orderMenu">Order</button>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        menu: null,
      };
    },
    methods: {
      async fetchMenu() {
        try {
          const response = await axios.get(`/menus/${this.$route.params.id}`);
          this.menu = response.data;
        } catch (error) {
          console.error(error);
        }
      },
      orderMenu() {
        this.$router.push({ name: 'OrderForm', params: { id: this.menu.id } });
      },
    },
    created() {
      this.fetchMenu();
    },
  };
  </script>
  
  <style>
  /* Gaya untuk detail menu */
  </style>
  