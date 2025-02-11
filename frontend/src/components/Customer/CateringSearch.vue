<!-- src/components/Customer/CateringSearch.vue -->

<template>
    <div class="catering-search">
      <h3>Find Catering Services</h3>
      <form @submit.prevent="search">
        <div>
          <label>Keyword:</label>
          <input v-model="keyword" type="text" />
        </div>
        <div>
          <label>Location:</label>
          <input v-model="location" type="text" />
        </div>
        <button type="submit">Search</button>
      </form>
      <ul>
        <li v-for="menu in menus" :key="menu.id">
          <h4>{{ menu.name }}</h4>
          <p>{{ menu.description }}</p>
          <p>Price: {{ menu.price }}</p>
          <router-link :to="{ name: 'MenuDetails', params: { id: menu.id } }">View Details</router-link>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        keyword: '',
        location: '',
        menus: [],
      };
    },
    methods: {
      async search() {
        try {
          const response = await axios.get('/menus/search', {
            params: {
              keyword: this.keyword,
              location: this.location,
            },
          });
          this.menus = response.data;
        } catch (error) {
          console.error(error);
        }
      },
    },
  };
  </script>
  
  <style>
  /* Gaya untuk pencarian catering */
  </style>
  