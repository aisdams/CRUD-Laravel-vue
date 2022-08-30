<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH CATATAN</h4>
                        <hr>

                        <form @submit.prevent="store">
                            <div class="form-group">
                                <label for="location" class="font-weight-bold">LOCATION</label>
                                <input type="text" class="form-control" v-model="catatan.location" placeholder="Masukkan Judul Catatan">
                                <!-- validation -->
                                <div v-if="validation.location" class="mt-2 alert alert-danger">
                                    {{ validation.location[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bodytemp" class="font-weight-bold">BODYTEMP</label>
                                <input type="text" class="form-control" v-model="catatan.bodytemp" placeholder="Masukkan Judul catatan">
                                <!-- validation -->
                                <div v-if="validation.bodytemp" class="mt-2 alert alert-danger">
                                    {{ validation.bodytemp[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date" class="font-weight-bold">DATE</label>
                                <input type="date" class="form-control" v-model="catatan.date" placeholder="Masukkan Judul catatan">
                                <!-- validation -->
                                <div v-if="validation.date" class="mt-2 alert alert-danger">
                                    {{ validation.date[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="time" class="font-weight-bold">TIME</label>
                                <input type="time" class="form-control" v-model="catatan.time" placeholder="Masukkan Judul catatan">
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
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {
    name: "catatan.create",
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

        //method store
        function store() {

            let location = catatan.location
            let bodytemp = catatan.bodytemp
            let date     = catatan.date
            let time     = catatan.time

            axios.post('http://localhost:8000/api/catatan', {
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
            store
        }

    }

}
</script>