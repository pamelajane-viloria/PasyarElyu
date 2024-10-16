<template>
  <div>
    <h2>Login</h2>
    <form @submit.prevent="login">
      <div>
        <label for="username">Username:</label>
        <input type="text" v-model="credentials.username" id="username" required />
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" v-model="credentials.password" id="password" required />
      </div>
      <button type="submit">Login</button>
      <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      credentials: {
        username: '',
        password: '',
      },
      errorMessage: '',
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('/api/login', this.credentials);
        alert('Login successful! Welcome ' + response.data.user.name);
        // Redirect or store user info as needed
      } catch (error) {
        this.errorMessage = error.response.data.message || 'Login failed!';
      }
    },
  },
};
</script>

<style scoped>
.error {
  color: red;
}
</style>
