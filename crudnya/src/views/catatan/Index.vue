<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>Data Catatan Perjalanan</h4>
                        <hr>
                        <router-link :to="{name: 'catatan.create'}" class="btn btn-md btn-success">TAMBAH Catatan</router-link>

                        <table class="table table-bordered border-dark mt-4 text-center">
                            <thead class="table-info">
                                <tr>
                                    <th scope="col">Location</th>
                                    <th scope="col">Bodytemp</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">OPTIONS</th>
                                </tr>
                            </thead>
                            <tbody v-if="catatans.length > 0">
                                <tr v-for="(catatan, index) in catatans" :key="index">
                                    <td>{{ catatan.location }}</td>
                                    <td>{{ catatan.bodytemp }}°</td>
                                    <td>{{ catatan.date }}</td>
                                    <td>{{ catatan.time }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'catatan.edit', params:{id: catatan.id }}" class="btn btn-sm mr-1 btn-outline-secondary"><img src="@/assets/img/edit.svg" alt="" style="width: 20px;"></router-link>
                                        <button @click.prevent="catatanDelete(catatan.id)" class="btn btn-sm mr-1 btn-outline-danger"><img src="@/assets/img/delete.svg" alt="" style="width: 20px;"></button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="5" align="center">No Categories Found.</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { onMounted, ref } from 'vue'

export default {
    name: "catatan.index",
    setup() {
        //method delete
        function catatanDelete(id) {
            
        //delete data catatan by ID
        axios.delete(`http://localhost:8000/api/catatan/${id}`)
        .then(() => {
                       
        //splice catatans 
        catatans.value.splice(catatans.value.indexOf(id), 1);
         
        }).catch(error => {
            console.log(error.response.data)
        })
         
         }
         
        //reactive state
        let catatans = ref([])

        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/catatan')
            .then(response => {
              
              //assign state catatans with response data
              catatans.value = response.data.data

            }).catch(error => {
                console.log(error.response.data)
            })

        })

        //return
        return {
            catatans,
            catatanDelete
        }

    }

}
</script>
