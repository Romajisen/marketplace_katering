<!-- src/components/Customer/OrderForm.vue -->

<template>
    <div class="order-form">
      <h3>Order Menu</h3>
      <form @submit.prevent="placeOrder">
        <div>
          <label>Quantity:</label>
          <input v-model="quantity" type="number" min="1" required />
        </div>
        <div>
          <label>Delivery Date:</label>
          <input v-model="deliveryDate" type="date" required />
        </div>
        <button type="submit">Place Order</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        quantity: 1,
        deliveryDate: '',
      };
    },
    methods: {
      async placeOrder() {
        try {
          await axios.post('/orders', {
            menu_id: this.$route.params.id,
            quantity: this.quantity,
            delivery_date: this.deliveryDate,
          });
          this.$router.push({ name: 'CustomerOrders' });
        } catch (error) {
          console.error(error);
        }
      },
    },
  };
  </script>
  
  <style>
  /* Gaya untuk form pemesanan */
  </style>
  