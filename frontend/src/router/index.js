// src/router/index.js

import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import About from '../views/About.vue';

// Komponen Auth
import Login from '../components/Auth/Login.vue';
import Register from '../components/Auth/Register.vue';

// Komponen Merchant
import MerchantDashboard from '../components/Merchant/MerchantDashboard.vue';
import Profile from '../components/Merchant/Profile.vue';
import MenuList from '../components/Merchant/MenuList.vue';
import MenuForm from '../components/Merchant/MenuForm.vue';
import OrderList from '../components/Merchant/OrderList.vue';

// Komponen Customer
import CustomerDashboard from '../components/Customer/CustomerDashboard.vue';
import CateringSearch from '../components/Customer/CateringSearch.vue';
import MenuDetails from '../components/Customer/MenuDetails.vue';
import OrderForm from '../components/Customer/OrderForm.vue';
import InvoiceList from '../components/Customer/InvoiceList.vue';

import store from '../store';

const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/about', name: 'About', component: About },
  { path: '/login', name: 'Login', component: Login, meta: { guest: true } },
  { path: '/register', name: 'Register', component: Register, meta: { guest: true } },
  // Route Merchant
  {
    path: '/merchant',
    component: MerchantDashboard,
    meta: { requiresAuth: true, role: 'merchant' },
    children: [
      { path: 'profile', name: 'MerchantProfile', component: Profile },
      { path: 'menus', name: 'MenuList', component: MenuList },
      { path: 'menus/create', name: 'MenuCreate', component: MenuForm },
      { path: 'orders', name: 'MerchantOrders', component: OrderList },
    ],
  },
  // Route Customer
  {
    path: '/customer',
    component: CustomerDashboard,
    meta: { requiresAuth: true, role: 'customer' },
    children: [
      { path: 'search', name: 'CateringSearch', component: CateringSearch },
      { path: 'menu/:id', name: 'MenuDetails', component: MenuDetails, props: true },
      { path: 'orders', name: 'CustomerOrders', component: InvoiceList },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Navigation Guard
router.beforeEach((to, from, next) => {
  const isAuthenticated = store.getters.isLoggedIn;
  const userRole = store.getters.userRole;

  if (to.meta.requiresAuth) {
    if (isAuthenticated) {
      if (to.meta.role && to.meta.role !== userRole) {
        next('/'); // Pengguna tidak memiliki akses
      } else {
        next();
      }
    } else {
      next('/login');
    }
  } else if (to.meta.guest && isAuthenticated) {
    next('/'); // Pengguna sudah login, redirect ke home
  } else {
    next();
  }
});

export default router;
