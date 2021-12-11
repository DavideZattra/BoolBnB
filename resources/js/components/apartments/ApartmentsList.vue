<template>
    <div class="container">

        <div class="row justify-content-center mt-5">
            <SearchAndFilter @getQuery='getQuery'/>
        </div>

        <div class="row justify-content-center mt-5">
            <ApartmentCard v-for="filteredApartment in filteredApartments" :key="filteredApartment.id" :apartment="filteredApartment"/>
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
            filteredApartments: [],
            searchedApartments: [],
            searchLat: 0,
            searchLon: 0,
            errors: [],
            needle: '',
            searchRange: 20
        }
    },

    methods: {
        getQuery(needle) {
            this.needle = needle.replaceAll(' ', '-');
             
            axios.get('https://api.tomtom.com/search/2/geocode/' + this.needle + '.json?key=NLbGYpRnYCS3jxXsynN2IfGsmEgZJJzB')
            .then(response => {
                this.searchLat = response.data.results[0].position.lat;
                this.searchLon = response.data.results[0].position.lon;
                console.log(this.searchLat, this.searchLon)
            }).then(

                console.log(this.geoFiltering())
            );

        },

        deg2rad(deg) {
            return deg * (Math.PI / 180);
        },

        getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
            let R = 6371; // Radius of the earth in km
            let dLat = this.deg2rad(lat2 - lat1); // deg2rad below
            let dLon = this.deg2rad(lon2 - lon1);
            let a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(this.deg2rad(lat1)) * Math.cos(this.deg2rad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
            let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            let d = R * c; // Distance in km
                return d;
        },

        geoFiltering() {
            this.filteredApartments.forEach((apartment) => {
                if (this.getDistanceFromLatLonInKm(this.searchLat, this.searchLon, apartment.addresses.lat, apartment.addresses.lon) < this.searchRange) {
                    this.searchedApartments.push(apartment);
                }
            });
            console.log(this.searchedApartments);
        }
    },


    // computed: {
    //     searchedApartments: function() {
    //         if (this.needle) {
    //             return this.apartments.filter(item => {
    //                 return item.addresses['address'].toLowerCase().match(this.needle) || item.addresses['city'].toLowerCase().match(this.needle)
    //             });
    //         } else {
    //             return this.apartments;
    //         } 
    //     }
    // },
    
    created() {
        axios.get(`http://127.0.0.1:8000/api/apartments`)
            .then(response => {
                this.filteredApartments = [...response.data];
                console.log(this.filteredApartments)

            })

        .catch(e => {
        this.errors.push(e);
        })
  }
}
</script>

<style scoped lang="scss">

</style>