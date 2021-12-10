<template>
    <div class="container">

        <div class="row justify-content-center">
            <SearchAndFilter @getQuery='getQuery'/>
        </div>

        <div class="row justify-content-center mt-5">
            <ApartmentCard v-for="searchedApartment in searchedApartments" :key="searchedApartment.id" :apartment="searchedApartment"/>
        </div>
    </div>
</template>

<script>

import ApartmentCard from './ApartmentCard.vue';
import SearchAndFilter from './SearchAndFilter.vue';
import axios from 'axios';

export default {
    name: "ApartmentsList",
    components: {
        ApartmentCard,
        SearchAndFilter,
    },
    data() {
        return {
            apartments: [],
            errors: [],
            needle: ''
        }
    },

    methods: {
        getQuery(needle) {
            this.needle = needle;
            console.log(this.needle) 
        },
    },

    computed: {
        searchedApartments: function() {
            if (this.needle) {
                return this.apartments.filter(item => {
                    return item.descriptive_title.match(this.needle)
                });
            } else {
                return this.apartments;
              }
        }
    },
    
    created() {
        axios.get(`http://127.0.0.1:8000/api/apartments`)
            .then(response => {
                this.apartments = [...response.data];
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