<template>
    <select id="filterSelect" class="form-control">
      <option value="">Tous</option>
      <option value="Complete">Complète</option>
      <option value="Incomplete">Incomplète</option>
    </select>
  </template>
  
  <script>
  export default {
    name: 'FilterSelect',
    mounted() {
      $('#filterSelect').on('change', () => {
        this.$emit('change', $('#filterSelect').val());
      });
    }
  }
  </script>
  