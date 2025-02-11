<!-- src/components/Navbar.vue -->

<template>
    <nav class="navbar">
      <router-link to="/" class="navbar-brand">Marketplace Katering</router-link>
      <ul class="navbar-menu">
        <li v-if="!isLoggedIn">
          <router-link to="/login">Login</router-link>
        </li>
        <li v-if="!isLoggedIn">
          <router-link to="/register">Register</router-link>
        </li>
        <li v-if="isLoggedIn && userRole === 'merchant'">
          <router-link to="/merchant">Merchant Dashboard</router-link>
        </li>
        <li v-if="isLoggedIn && userRole === 'customer'">
          <router-link to="/customer">Customer Dashboard</router-link>
        </li>
        <li v-if="isLoggedIn">
          <a @click="logout">Logout</a>
        </li>
      </ul>
    </nav>
  </template>
  
  <script>
  import { mapGetters } from 'vuex';
  
  export default {
    computed: {
      ...mapGetters(['isLoggedIn', 'userRole']),
    },
    methods: {
      logout() {
        this.$store.dispatch('logout');
        this.$router.push('/');
      },
    },
  };
  </script>
  
  <style>
  /* Tambahkan gaya untuk navbar */
  </style>
  