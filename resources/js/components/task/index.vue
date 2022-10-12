<script setup>
    import axios from 'axios';
    import {onMounted,ref} from 'vue';

    let tasks = ref([]);
    let form = ref({description: ''});
    let checkBoxArray=ref([]);

    onMounted(async () => {
        getTasks();
    });

    const getTasks = async () => {
        let get = await axios.get('/api/task/list');
        tasks.value = get.data.data;
        loadtaskchecked();
    };

    const loadtaskchecked = () => {
        tasks.value.forEach(element => {
            if (element.complete_at) {
                checkBoxArray.value[element.id] = true;
            } else {
                checkBoxArray.value[element.id] = false;
            }
        });
    }
    const create = () => {
        if (form.value.description) {
            const formData = new FormData();
            formData.append('description', form.value.description);
            axios.post('/api/task/store', formData)
                .then((response) => {
                    form.value.description = '',
                        getTasks()
                    toast.fire({
                        icon: "success",
                        title: "Tarea Agregada con exito"
                    })
                }).catch((error) => {

                });
        }
    };
    const update = (id) => {
        Swal.fire({
            title: 'Actualiza la descripción de la tarea ID' + id,
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Actualizar',
            showLoaderOnConfirm: true,
            preConfirm: (input) => {
                return axios.put(`/api/task/update/${id}`, {
                        description: input
                    })
                    .then((response) => {
                        console.log(response);
                    }).catch((error) => {
                        console.log(error);
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                getTasks();
                toast.fire({
                    icon: "success",
                    title: "Tarea Actualizada con exito"
                });
            }
        });
    };
    const completed = (id) => {

        if (!checkBoxArray.value[id]) {
            axios.put(`/api/task/complete/${id}`)
                .then((response) => {
                    toast.fire({
                        icon: "success",
                        title: "Tarea Completada con exito"
                    })
                }).catch((error) => {

                });
        } else {
            checkBoxArray.value[id] = true;
        }
    }
    const deletetask = (id) => {
        Swal.fire({
            title: '¿Esta seguro que desea eliminar la tarea ID ' + id,
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/api/task/delete/${id}`)
                    .then((response) => {
                        getTasks()
                        toast.fire({
                            icon: "success",
                            title: "Tarea Eliminada con exito"
                        })
                    }).catch((error) => {

                    });
            }
        })
    };
</script>
<template>
<div class="app-container" id="taskList">
  <h1 class="app-header">TO DO LIST</h1>
  <div class="add-task">
    <input type="hidden" id="">
    <input type="text" autocomplete="off" placeholder="Agregar nueva tarea" class="task-input" v-model="form.description">
		<input type="submit" value=" " class="submit-task" title="Agregar Tarea" @click="create">
  </div>
  <ul class="task-list">
		<li class="task-list-item" v-for="item in tasks" :key="item.id" v-if="tasks.length > 0">
			<label class="task-list-item-label">
        <input type="checkbox" @click="completed(item.id)" v-model="checkBoxArray[item.id]" v-if="checkBoxArray[item.id]">
        <input type="checkbox" @click="completed(item.id)" v-model="checkBoxArray[item.id]" v-else>
				<span>{{item.id}}. {{item.description}}</span>
			</label>
			<div class="btn-group">
        <span class="edit-btn" title="Edit Task" @click="update(item.id)"><i class="fas fa-pencil-alt"></i></span>
        <span class="delete-btn" title="Delete Task" @click="deletetask(item.id)"><i class="fa fa-trash"></i></span>
      </div>
		</li>
    <li class="task-list-item" v-else>
      <label class="task-list-item-label">
        <span>No se han encontrado tareas,<br>agregue una</span>
      </label>
    </li>
	</ul>
</div>
</template>