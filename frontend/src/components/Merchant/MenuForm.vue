<!-- src/components/Merchant/MenuForm.vue -->

<template>
    <div class="menu-form">
      <h3>Add New Menu</h3>
      <form @submit.prevent="submitForm">
        <div>
          <label>Name:</label>
          <input v-model="menu.name" type="text" required />
        </div>
        <div>
          <label>Description:</label>
          <textarea v-model="menu.description" required></textarea>
        </div>
        <div>
          <label>Price:</label>
          <input v-model="menu.price" type="number" step="0.01" required />
        </div>
        <div>
          <label>Photo:</label>
          <input type="file" @change="handleFileUpload" />
        </div>
        <button type="submit">Save Menu</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        menu: {
          name: '',
          description: '',
          price: '',
        },
        photo: null,
      };
    },
    methods: {
      handleFileUpload(event) {
        this.photo = event.target.files[0];
      },
      async submitForm() {
        try {
          const formData = new FormData();
          formData.append('name', this.menu.name);
          formData.append('description', this.menu.description);
          formData.append('price', this.menu.price);
          if (this.photo) {
            formData.append('photo', this.photo);
          }
  
          await axios.post('/menus', formData, {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          });
  
          this.$router.push({ name: 'MenuList' });
        } catch (error) {
          console.error(error);
        }
      },
    },
  };
  </script>
  
  <style>
  /* Gaya untuk form menu */
  </style>
  