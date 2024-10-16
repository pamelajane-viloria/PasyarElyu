<template>
    <div class="container">
      <h2>Create User</h2>
      <form @submit.prevent="submitForm">
        <div>
          <label for="username">Username:</label>
          <input type="text" v-model="form.username" id="username" />
        </div>
        <div>
          <label for="name">Name:</label>
          <input type="text" v-model="form.name" id="name" />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" v-model="form.password" id="password" />
        </div>
        <button type="submit">Create User</button>
      </form>
      <div v-if="errors.length">
        <h3>Errors:</h3>
        <ul>
          <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        form: {
          username: '',
          name: '',
          password: '',
          role: 'USER',
          isArchived: false,
        },
        errors: [],
      };
    },
    methods: {
      async submitForm() {
        try {
          const response = await axios.post('/api/users', this.form);
          alert(response.data.message);
          // Reset the form
          this.form = {
            username: '',
            name: '',
            password: '',
            role: 'user',
            isArchived: false,
          };
          this.errors = [];
        } catch (error) {
          if (error.response && error.response.status === 422) {
            this.errors = Object.values(error.response.data.errors).flat();
          }
        }
      },
    },
  };
  </script>
  