<template>
    <div class="container">
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
        // 
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