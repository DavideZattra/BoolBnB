<template>
    <div class="search-wrapper p-5">
        <div class="fluid-container">
            <div class="row">

                <div class="col-4">
                    <div id='map'></div>

                    <SearchAndFilter 
                        @getQuery='getQuery' 
                        @getRooms='getRooms' 
                        @getBathrooms='getBathrooms' 
                        @getAmenities='getAmenities' 
                        @getRadius='getRadius' 
                        :amenities="amenities"/>
                </div>

                <div class="justify-content-center col-8 pl-4">
                    <div class="fluid-container">
                        <div id="apartment-list" class="row justify-content-center">
                            <ApartmentCard 
                                v-for="filteredApartment in filteredApartments" 
                                :key="filteredApartment.id" 
                                :apartment="filteredApartment"/>
                        </div>
                    </div>
                </div>
            </div>
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
            searchLat: 41.89056,
            searchLon: 12.49427,
            errors: [],
            needle: '',
            rooms: 0,
            bathrooms: 0,
            radius: 20 
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
        
        getRadius(radius){
            this.radius = radius;
            console.log(this.radius)
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
                if (this.getDistanceFromLatLonInKm(this.searchLat, this.searchLon, apartment.addresses.lat, apartment.addresses.lon) < this.radius) {
                    this.searchedApartments.push(apartment);
                    this.apartments = [...this.searchedApartments];
                }
            });
            
            
            var coordinates = [this.searchLon, this.searchLat];
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
                }).setHTML(`${apartment.descriptive_title}<br>${apartment.addresses.city}`);
                marker.setPopup(popup).togglePopup();
            })
            
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

        },

        newMarkerDisplay(apartments){
            
            
            apartments.forEach((apartment)=>{
                let marker;
                marker = new tt.Marker().setLngLat([apartment.addresses.lon, apartment.addresses.lat]).addTo(map);
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
                }).setHTML(`${apartment.descriptive_title}<br>${apartment.addresses.city}`);
                marker.setPopup(popup).togglePopup();
            })
            
        }
    },


    computed: {
        filteredApartments: function() {
            // this.newMarkerDisplay(); 
            if (this.rooms || this.bathrooms || this.checkedAmenities) {
                return this.searchedApartments.filter(item => {
                    return item.rooms >= this.rooms &&  item.bathrooms >= this.bathrooms && this.compareAmenities(item.amenities, this.checkedAmenities);
                });
            } else {
                // this.newMarkerDisplay(this.apartments);
                return this.apartments;
            }
        },

        
    },
    
    created() {
        axios.get(`http://127.0.0.1:8000/api/apartments`)
            .then(response => {
                this.apartments = [...response.data];
                console.log(this.apartments)
                this.searchedApartments = [...this.apartments];
            }).catch(e => {
            this.errors.push(e);
            }).then(()=>{
                var coordinates = [this.searchLon, this.searchLat];
                var map = tt.map({
                    container: 'map',
                    key: '4plL73VgGOGRuTO2bSvJ1YZFmyuDVVaD',
                    style: 'tomtom://vector/1/basic-main',
                    center: coordinates,
                    zoom: 3
                });
                map.addControl(new tt.FullscreenControl());
                map.addControl(new tt.NavigationControl());
                this.filteredApartments.forEach((apartment)=>{
                    let marker;
                    marker = new tt.Marker().setLngLat([apartment.addresses.lon, apartment.addresses.lat]).addTo(map);
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
                    }).setHTML(`${apartment.descriptive_title}<br>${apartment.addresses.city}`);
                    marker.setPopup(popup).togglePopup();
                })
            })

        axios.get(`http://127.0.0.1:8000/api/amenities`)
            .then(response => {
                this.amenities = [...response.data]

                console.log(this.amenities)
            }).catch(e => {
            this.errors.push(e);
            });
    }
}
</script>

<style lang="scss">
.search-wrapper{
    height: calc(100vh - 60px);

    #apartment-list{
        height: calc(100vh - 60px);
        overflow-y: scroll;
    }
}
    #map{
        height: 300px;
        width: 100%;
        border-radius: 15px;
    }
</style>