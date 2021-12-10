<template>
    <div class="container">
        <div class="input-group input-group-sm mt-5">
            <input v-model.trim="search" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            
            <div class="input-group-prepend">
                <button class="btn btn-primary" id="inputGroup-sizing-sm" type="button">Search</button>
            </div>
        </div>  

        <div class="row justify-content-center mt-5">
            <ApartmentCard :v-if="apartments.visible = 1" v-for="apartment in apartments" :key="apartment.id" :apartment="apartment"/>
        </div>
    </div>
</template>

<script>

import ApartmentCard from './ApartmentCard.vue';
import axios from 'axios';

export default {
    name: "ApartmentsList",
    components: {
        ApartmentCard,
    },
    data() {
        return {
            apartments: [],
        }
    },
    methods: {
        search(needle) {
            
        } 
    },
    created() {
        axios.get(`http://127.0.0.1:8000/api/apartments`)
            .then(response => {
                this.apartments = response.data;
                console.log(this.apartments)
            })
        .catch(e => {
        this.errors.push(e);
        })
  }
}
</script>

<style scoped lang="scss">

</style>