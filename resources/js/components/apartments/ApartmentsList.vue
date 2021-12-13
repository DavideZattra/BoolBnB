<template>
    <div class="container">

        <div class="row justify-content-center">
            <SearchAndFilter @getQuery='getQuery' @getRooms='getRooms' @getBathrooms='getBathrooms' @getAmenities='getAmenities' :amenities="amenities"/>
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
            apartments: [],
            amenities: [],
            checkedAmenities: [],
            searchedApartments: [],
            searchLat: 0,
            searchLon: 0,
            errors: [],
            needle: '',
            rooms: 0,
            bathrooms: 0,
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
            }).then( () => {
                this.searchedApartments = [];
                console.log(this.geoFiltering())
            });

        },

        getRooms(rooms) {
            this.rooms = rooms;
            console.log(this.rooms)
        },

        getBathrooms(bathrooms) {
            this.bathrooms = bathrooms;
              console.log(this.bathrooms)
        },

        getAmenities(checkedAmenities) {
            this.checkedAmenities = checkedAmenities;
            console.log(this.checkedAmenities)
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
            this.apartments.forEach((apartment) => {
                if (this.getDistanceFromLatLonInKm(this.searchLat, this.searchLon, apartment.addresses.lat, apartment.addresses.lon) < this.searchRange) {
                    this.searchedApartments.push(apartment);
                    this.apartments = [...this.searchedApartments];
                }
            });
            console.log(this.searchedApartments);
        },

        compareAmenities(arr1, arr2) {
            let apartmentsAmenitiesId = [];

            arr1.forEach((object) => {
            apartmentsAmenitiesId.push(object.id)
            
            });

            const filteredArray = arr2.filter(value => apartmentsAmenitiesId.includes(value));

            if (filteredArray.length == arr2.length) {
                return true;
            }  else {
                return false
            }

        }
    },


    computed: {
        filteredApartments: function() {
            if (this.rooms || this.bathrooms || this.checkedAmenities) {
                return this.searchedApartments.filter(item => {
                    return item.rooms >= this.rooms &&  item.bathrooms >= this.bathrooms && this.compareAmenities(item.amenities, this.checkedAmenities);
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
                this.searchedApartments = [...this.apartments];
            })

        axios.get(`http://127.0.0.1:8000/api/amenities`)
            .then(response => {
                this.amenities = [...response.data]

                console.log(this.amenities)
            })

            .catch(e => {
            this.errors.push(e);
            })
    }
}
</script>

<style scoped lang="scss">

</style>