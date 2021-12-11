<template>
    <div class="container">

        <div class="row justify-content-center">
            <SearchAndFilter @getQuery='getQuery'/>
        </div>

        <div class="row justify-content-center mt-5">
            <ApartmentCard v-for="filteredApartment in filteredApartments" :key="filteredApartment.id" :apartment="filteredApartment"/>
        </div>
        <div id='map'></div>
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
            }).then( () => {
                this.searchedApartments = [];
                console.log(this.geoFiltering())
            });

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
        }).then(()=>{
            var lat = 45.87162000;
            var lon = 8.91306000;
            var coordinates = [lon, lat];
            var map = tt.map({
                container: 'map',
                key: '4plL73VgGOGRuTO2bSvJ1YZFmyuDVVaD',
                style: 'tomtom://vector/1/basic-main',
                center: coordinates,
                zoom: 10
            });
            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());
            this.filteredApartments.forEach((apartment)=>{
                 let marker;
                 marker = new tt.Marker().setLngLat([apartment.addresses.lon, apartment.addresses.lat]).addTo(map);
            })
            var popupOffsets = {
                top: [0, 0],
                bottom: [0, -40],
                'bottom-right': [0, -70],
                'bottom-left': [0, -70],
                left: [25, -35],
                right: [-25, -35]
            }
            var popup = new tt.Popup({
                offset: popupOffsets
            }).setHTML(`${this.name}<br>${this.address}`);
            marker.setPopup(popup).togglePopup();
            
        })
    },

    // mounted: function() {
    //     this.$nextTick(function(){

    //         var lat = 45.87162000;
    //         var lon = 8.91306000;
    //         var coordinates = [lon, lat];
    //         var map = tt.map({
    //             container: 'map',
    //             key: '4plL73VgGOGRuTO2bSvJ1YZFmyuDVVaD',
    //             style: 'tomtom://vector/1/basic-main',
    //             center: coordinates,
    //             zoom: 10
    //         });
    //         var marker = new tt.Marker().setLngLat(coordinates).addTo(map);
    //         map.addControl(new tt.FullscreenControl());
    //         map.addControl(new tt.NavigationControl());
    //         var popupOffsets = {
    //             top: [0, 0],
    //             bottom: [0, -40],
    //             'bottom-right': [0, -70],
    //             'bottom-left': [0, -70],
    //             left: [25, -35],
    //             right: [-25, -35]
    //         }
    //         var popup = new tt.Popup({
    //             offset: popupOffsets
    //         }).setHTML(`${this.name}<br>${this.address}`);
    //         marker.setPopup(popup).togglePopup();
    //         console.log('hello there')
    //     })
    // }
}
</script>

<style lang="scss">
#map{
    height: 500px;
    width: 800px;
    margin: 0 auto;
}
</style>