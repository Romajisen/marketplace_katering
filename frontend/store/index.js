// src/store/index.js

import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    token: localStorage.getItem('token') || '',
    user: null,
  },
  mutations: {
    SET_TOKEN(state, token) {
      state.token = token;
    },
    SET_USER(state, user) {
      state.user = user;
    },
    LOGOUT(state) {
      state.token = '';
      state.user = null;
    },
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const response = await axios.post('/login', credentials);
        const token = response.data.access_token;
        localStorage.setItem('token', token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        commit('SET_TOKEN', token);
        await this.dispatch('getUser');
      } catch (error) {
        throw error;
      }
    },
    async register({ commit }, userData) {
      try {
        const response = await axios.post('/register', userData);
        const token = response.data.access_token;
        localStorage.setItem('token', token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        commit('SET_TOKEN', token);
        await this.dispatch('getUser');
      } catch (error) {
        throw error;
      }
    },
    async getUser({ commit }) {
      try {
        const response = await axios.get('/user');
        commit('SET_USER', response.data);
      } catch (error) {
        commit('LOGOUT');
        localStorage.removeItem('token');
        delete axios.defaults.headers.common['Authorization'];
      }
    },
    logout({ commit }) {
      commit('LOGOUT');
      localStorage.removeItem('token');
      delete axios.defaults.headers.common['Authorization'];
    },
  },
  getters: {
    isLoggedIn: (state) => !!state.token,
    userRole: (state) => (state.user ? state.user.role : null),
    user: (state) => state.user,
  },
});
