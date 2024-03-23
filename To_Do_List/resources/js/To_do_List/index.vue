<template>
  <div class="container mt-5 d-flex justify-content-center">
       <div class="container mt-3 ms-auto">
    <router-link to="/Ajouter" class="btn btn-primary ms-auto">Ajouter tâches</router-link>
  
    <div class="container mt-3">
      <select id="filterSelect" @change="FilterData($event.target.value)">
      <option value=" ">Tous</option>
      <option value="Complete">Complète</option>
      <option value="Incomplete">Incomplète</option>
    </select>
      

    <table id="tasks-table" class="display table table-striped table-bordered"></table>
  </div>
</div>
</div>
  <!-- Modal for delete confirmation -->
  <form id="deleteForm" @submit.prevent="deleteItem" class="custom-form">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this item?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger"  data-bs-dismiss="modal" id="confirm-delete">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import DataTable from 'datatables.net';
import 'bootstrap'; // Import Bootstrap JavaScript
import router from '../../router/routes.js';


const table = ref(null);
const items = ref([]);

const currentFilter = ref('');
const FilterData = (filterValue) => {
  try {
    console.log('Filter value:', filterValue);

    if (table.value) {
   
      table.value.search('').draw();

      if (filterValue !== ' ') {
        const columnIndex = table.value.columns().header().toArray().findIndex(header => header.innerText === 'Etat');

        if (columnIndex !== -1) {
          const regex = `^${filterValue}$`;
          table.value.column(columnIndex).search(regex, true, false).draw();
        } else {
          console.error('Column index for "Etat" column not found.');
        }
      } else {
      

        table.value.search('').columns().search('').draw();
        fetchData();
     
   

      }
    }
  } catch (error) {
    console.error('Error filtering data:', error);
  }
};





window.modifyItem = (id) => {
  console.log('ID :', id);
  router.push({ name: 'Modifier', params: { id: id } });
};


onMounted(async () => {
  try {
    await fetchData();
  } catch (error) {
    console.error('Error fetching data:', error);
  }
});


const fetchData = async () => {
  try {
    const response = await axios.get('/api/TaskList');
    items.value = response.data;

    if (table.value) {
    console.log('tableggggg :', table);
      table.value.clear().rows.add(items.value).draw();
    
    } else {
      table.value = new DataTable('#tasks-table', {
        data: items.value,
        columns: [
          {
            title: 'Check',
            data: null,
            render: function (data, type, row) {
  const isChecked = row.Etat === 'Complete' ? 'checked' : '';
  return `<div class="custom-control custom-checkbox">
            <input 
              type="checkbox" 
              class="custom-control-input check-checkbox" 
              id="check-${row.id}" 
              data-id="${row.id}" 
              ${isChecked}
              onclick="Change_etat(${row.id}, this.checked);"
            >
            <label class="custom-control-label" for="check-${row.id}"></label>
          </div>`;
}
            
          },
          { title: 'ID', data: 'id' },
          { title: 'Titre', data: 'Titre' },
          { title: 'Description', data: 'Description' },
          { title: 'Etat', data: 'Etat' },
          {
            title: 'Actions',
            data: null,
            render: function (data, type, row) {
              return `<button class="btn btn-primary" onclick="modifyItem(${row.id})">Modify</button>
                      <button class="btn btn-danger delete-btn" data-id="${row.id}" data-toggle="modal" data-target="#deleteModal">Delete</button>`;
            }
          }
        ]
      });
    }
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};
window.Change_etat = async (id, isChecked) => {
  console.log(`Checkbox with ID ${id} is checked: ${isChecked}`);
  try {
    const response = await axios.get(`api/TaskList/${id}`);
    items.value = response.data;
    console.log("items", items.value);
    isChecked = response.data.Etat === 'Complete';
    const checkbox = document.getElementById(`check-${id}`);
    checkbox.checked = isChecked;
    fetchData(); 
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};


const deleteItem = async () => {
  try {
    const itemId = document.querySelector('.delete-btn').getAttribute('data-id');
    const response = await axios.delete(`/api/TaskList/${itemId}`);
    
   
    console.log('Item deleted successfully:', response.data);
    
   
    const deleteModal = document.getElementById('deleteModal');
    const modal = new bootstrap.Modal(deleteModal);
    modal.hide();

  
    deleteModal.classList.remove('show');

 
    const modalBackdrop = document.querySelector('.modal-backdrop');
    if (modalBackdrop) {
      modalBackdrop.remove();
    }
    
   
    fetchData();
  } catch (error) {
    console.error('Error deleting item:', error);
  }
};



onMounted(fetchData);


</script>

<style>
  @import 'datatables.net-dt';
</style>
