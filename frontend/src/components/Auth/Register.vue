<!-- src/components/Auth/Register.vue -->

<template>
    <div class="auth-container">
      <h2>Register</h2>
      <form @submit.prevent="register">
        <div>
          <label>Name:</label>
          <input v-model="name" type="text" required />
        </div>
        <div>
          <label>Email:</label>
          <input v-model="email" type="email" required />
        </div>
        <div>
          <label>Password:</label>
          <input v-model="password" type="password" required />
        </div>
        <div>
          <label>Role:</label>
          <select v-model="role" required>
            <option value="customer">Customer</option>
            <option value="merchant">Merchant</option>
          </select>
        </div>
        <button type="submit">Register</button>
        <p v-if="errorMessage">{{ errorMessage }}</p>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        role: 'customer',
        errorMessage: '',
      };
    },
    methods: {
      async register() {
        try {
          await this.$store.dispatch('register', {
            name: this.name,
            email: this.email,
            password: this.password,
            role: this.role,
          });
          this.$router.push('/');
        } catch (error) {
          this.errorMessage = 'Registration failed. Please try again.';
        }
      },
    },
  };
  </script>
  
  <style>
  /* Gaya untuk form registrasi */
  </style>
  