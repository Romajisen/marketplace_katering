<!-- src/components/Auth/Login.vue -->

<template>
    <div class="auth-container">
      <h2>Login</h2>
      <form @submit.prevent="login">
        <div>
          <label>Email:</label>
          <input v-model="email" type="email" required />
        </div>
        <div>
          <label>Password:</label>
          <input v-model="password" type="password" required />
        </div>
        <button type="submit">Login</button>
        <p v-if="errorMessage">{{ errorMessage }}</p>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        email: '',
        password: '',
        errorMessage: '',
      };
    },
    methods: {
      async login() {
        try {
          await this.$store.dispatch('login', {
            email: this.email,
            password: this.password,
          });
          this.$router.push('/');
        } catch (error) {
          this.errorMessage = 'Login failed. Please check your credentials.';
        }
      },
    },
  };
  </script>
  
  <style>
  /* Gaya untuk form login */
  </style>
  