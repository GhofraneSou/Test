<template>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">TO DO LIST</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
   
    </div>
    </nav>
  </template>
  
  <style scoped>
  /* Ajoutez vos styles CSS ici */
  .navbar {
    padding: 1rem;
  }
  
  .navbar-brand {
    color: #fff;
    font-size: 1.5rem;
  }
  
  .navbar-nav .nav-item {
    margin-right: 1rem;
  }
  
  .navbar-nav .nav-link {
    color: #fff;
  }
  </style>
  
  <script>
  export default {
    name: 'Navbar' // Nommez votre composant
  }
  </script>
  