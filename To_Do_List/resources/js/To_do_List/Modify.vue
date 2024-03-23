<template>
 
  <div id="app">
 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  
    </nav>
    <div class="container mt-5">
      <div class="card">
        <div class="card-body">
          <form @submit.prevent="submitForm">
            <div class="form-group">
              <label for="Titre">Titre Tache</label>
             
              <input type="text" class="form-control" id="Titre" v-model="titre" placeholder="Titre">
            </div>
            <div class="form-group">
              <label for="Description">Description</label>
            
              <input type="text" class="form-control" id="Description" v-model="description" placeholder="Description">
            </div>
            <button type="submit" class="btn btn-primary">Modifier Tache</button>
          </form>
        </div>
      </div>
    </div>
    
    <router-view></router-view>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();
const titre = ref('');
const description = ref('');

// Fetch data based on ID
onMounted(() => {
  const id = router.currentRoute.value.params.id;
  console.log("ID:", id); // Check if the ID is fetched correctly
  fetchDataById(id);
  console.log("hello1111"); // Check if this line is reached
});


const fetchDataById = async (id) => {
  try {
    console.log("Fetching data for ID:", id); // Check if the function is called
    const response = await axios.get(`/api/TaskList/${id}/edit`);
    console.log("API Response:", response.data); // Check the API response
    const { Titre, Description } = response.data;
    titre.value = Titre;
    description.value = Description;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};


const submitForm = async () => {
  try {
    const id = router.currentRoute.value.params.id;
    const updatedData = {
      Titre: titre.value,
      Description: description.value
    };

   
    const response = await axios.put(`/api/TaskList/${id}`, updatedData);

    
    console.log('Task list item updated successfully:', response.data);
    router.push({ name: 'Home'});


  } catch (error) {
   
    console.error('Error updating task list item:', error);
  }
};

</script>
