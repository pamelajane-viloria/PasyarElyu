import 'bootstrap/dist/css/bootstrap.min.css';
import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';

const app = createApp({
    data() {
      return {
        user: null, // Store the logged-in user here
        role: null, // Store the user's role (USER, LGU, ADMIN)
      };
    },
    methods: {
      // Function to check login state
      async checkLogin() {
        try {
          // Send a request to check if the user is logged in (optional)
          const response = await axios.get('/api/user');
          this.user = response.data.user;
          this.role = response.data.role;
        } catch (error) {
          console.log('Not logged in.');
        }
      },
      // Function to log in the user
      async loginUser(credentials) {
        try {
          const response = await axios.post('/api/login', credentials);
          this.user = response.data.user; // Assign the logged-in user
          this.role = response.data.role; // Get the user role
  
          // Redirect user based on their role
          if (this.role === 'ADMIN') {
            window.location.href = '/admin-dashboard';
          } else if (this.role === 'LGU') {
            window.location.href = '/lgu-dashboard';
          } else {
            window.location.href = '/user-dashboard';
          }
        } catch (error) {
          console.error('Login failed', error);
        }
      },
      // Function to log out the user
      async logoutUser() {
        await axios.post('/api/logout');
        this.user = null;
        this.role = null;
        window.location.href = '/'; // Redirect to home or login page
      },
    },
    mounted() {
      // Check login state on page load
      this.checkLogin();
    },
  });
  
// app.component('example-component', ExampleComponent);
app.component('new-user', Register);
app.component('login-user', Login);
app.mount('#app');
