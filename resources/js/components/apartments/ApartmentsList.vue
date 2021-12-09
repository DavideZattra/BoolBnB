<template>
    <ApartmentCard/>
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
                console.log(response);
            })
        .catch(e => {
        this.errors.push(e);
        })
  }
}
</script>

<style scoped lang="scss">

</style>