<!-- src/components/Merchant/MerchantDashboard.vue -->

<template>
    <div class="dashboard">
      <h2>Merchant Dashboard</h2>
      <router-link to="profile">Edit Profile</router-link>
      <router-link to="menus">Manage Menus</router-link>
      <router-link to="orders">View Orders</router-link>
      <router-view />
    </div>
  </template>
  
  <script>
  export default {};
  </script>
  
  <style>
  /* Gaya untuk dashboard merchant */
  </style>
  