<template>
   
 <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <div id="app">
        
       
        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="submitForm" class="custom-form">
                        <div class="form-group">
                            <label for="Titre">Titre Tache</label>
                            <input type="text" class="form-control" id="Titre" v-model="formData.Titre"
                                placeholder="Titre">
                        </div>
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <input type="text" class="form-control" id="Description" v-model="formData.Description"
                                placeholder="Description">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter Tache</button>
                    </form>
                </div>
            </div>
        </div>
     
        <router-view></router-view>
    </div>
</template>

<script setup>
// Import Axios
import axios from 'axios';
import router from '../../router/routes.js'; 


import { useRouter } from 'vue-router'; 
import { useToast } from 'vue-toastification'; 


const toast = useToast(); 
const formData = {
  Titre: '',
  Description: ''
};


const submitForm = () => {
  axios.post('http://127.0.0.1:8000/api/TaskList', formData)
    .then(response => {
   
      console.log('Data added successfully:', response.data);
      
      formData.Titre = '';
      formData.Description = '';
      
       toast.success('Data added successfully');
     
      router.push({ path: '/' });
    })
    .catch(error => {
     
      console.error('Error adding data:', error);
     
      toast.error('Failed to add data');
    });
};
</script>

<style scoped>

.navbar {
    background-color: #343a40;
    padding: 1rem;
}

.navbar-brand {
    color: #fff;
    font-size: 1.5rem;
    text-decoration: none;
}

.navbar-nav .nav-item {
    margin-right: 1rem;
}

.navbar-nav .nav-link {
    color: #fff;
    text-decoration: none;
}

/* Container */
.container {
    margin-top: 2rem;
}

/* Card */
.card {
    border: 1px solid #ccc;
    border-radius: 0.25rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 1.5rem;
}

/* Form */
.form-group {
    margin-bottom: 1rem;
}

.form-control {
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    cursor: pointer;
    transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

</style>