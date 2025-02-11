<!-- src/components/Merchant/MenuList.vue -->

<template>
    <div class="menu-list">
      <h3>Your Menus</h3>
      <router-link to="create">Add New Menu</router-link>
      <ul>
        <li v-for="menu in menus" :key="menu.id">
          <h4>{{ menu.name }}</h4>
          <p>{{ menu.description }}</p>
          <p>Price: {{ menu.price }}</p>
          <router-link :to="{ name: 'MenuEdit', params: { id: menu.id } }">Edit</router-link>
          <button @click="deleteMenu(menu.id)">Delete</button>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        menus: [],
      };
    },
    methods: {
      async fetchMenus() {
        try {
          const response = await axios.get('/menus');
          this.menus = response.data;
        } catch (error) {
          console.error(error);
        }
      },
      async deleteMenu(id) {
        try {
          await axios.delete(`/menus/${id}`);
          this.fetchMenus();
        } catch (error) {
          console.error(error);
        }
      },
    },
    created() {
      this.fetchMenus();
    },
  };
  </script>
  
  <style>
  /* Gaya untuk daftar menu */
  </style>
  