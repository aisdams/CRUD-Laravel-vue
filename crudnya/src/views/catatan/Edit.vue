<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>EDIT CATATAN</h4>
                        <hr>

                        <form @submit.prevent="update">
                            <div class="form-group">
                                <label for="location" class="font-weight-bold">location</label>
                                <input type="text" class="form-control" v-model="catatan.location" placeholder="Masukkan Judul Catatan">
                                <!-- validation -->
                                <div v-if="validation.location" class="mt-2 alert alert-danger">
                                    {{ validation.location[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bodytemp" class="font-weight-bold">bodytemp</label>
                                <input type="text" class="form-control" v-model="catatan.bodytemp" placeholder="Masukkan Judul Bodytemp">
                                <!-- validation -->
                                <div v-if="validation.bodytemp" class="mt-2 alert alert-danger">
                                    {{ validation.bodytemp[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date" class="font-weight-bold">Date</label>
                                <input type="date" class="form-control" v-model="catatan.date" placeholder="Masukkan Judul date">
                                <!-- validation -->
                                <div v-if="validation.date" class="mt-2 alert alert-danger">
                                    {{ validation.date[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="time" class="font-weight-bold">Time</label>
                                <input type="time" class="form-control" v-model="catatan.time" placeholder="Masukkan Judul Time">
                                <!-- validation -->
                                <div v-if="validation.time" class="mt-2 alert alert-danger">
                                    {{ validation.time[0] }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </form>                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'

export default {
    name: "catatan.edit",
    setup() {

        //state catatans
        const catatan = reactive({
            location: '',
            bodytemp: '',
            date: '',
            time: ''
        })

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        //vue router
        const route = useRoute()

        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get(`http://localhost:8000/api/catatan/${route.params.id}`)
            .then(response => {
              
              //assign state catatans with response data
              catatan.location  = response.data.data.location  
              catatan.bodytemp  = response.data.data.bodytemp  
              catatan.date      = response.data.data.date  
              catatan.time      = response.data.data.time  

            }).catch(error => {
                console.log(error.response.data)
            })

        })

        //method update
        function update() {

            let location = catatan.location
            let bodytemp = catatan.bodytemp
            let date     = catatan.date
            let time     = catatan.time

            axios.put(`http://localhost:8000/api/catatan/${route.params.id}`, {
                location: location,
                bodytemp: bodytemp,
                date: date,
                time: time
            }).then(() => {

                //redirect ke catatan index
                router.push({
                    name: 'catatan.index'
                })

            }).catch(error => {
                //assign state validation with error 
                validation.value = error.response.data
            })

        }

        //return
        return {
            catatan,
            validation,
            router,
            update
        }

    }

}
</script>
