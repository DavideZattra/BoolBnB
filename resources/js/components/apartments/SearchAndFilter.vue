<template>
<div class="container">
    <div class="input-group input-group-sm mt-5">
        <input v-model.trim="needle" placeholder="Address or city" @keyup.enter="$emit('getQuery', needle)" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"> 
        <button type="button" class="btn btn-success" @click="$emit('getQuery', needle)">Search</button>       
    </div>

    <div class="input-group input-group-sm mt-5">
        <input v-model.number="rooms" @change="$emit('getRooms', rooms)" type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" min="1" max="10" >  

<<<<<<< HEAD
        <input v-model.number="bathrooms" @change="$emit('getBathrooms', bathrooms)" type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" min="1" max="10"> 

        <input v-model.number="radius" @change="$emit('getRadius', radius)" type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" min="1" max="550" > 
 
=======
        <input v-model.number="bathrooms" @change="$emit('getBathrooms', bathrooms)" type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"> 
   
>>>>>>> origin/guests_search
    </div>    

    <div class="amenities text-white" v-for="amenity in amenities" :key="amenity.id">
        <label :for="amenity.name">{{amenity.name}}</label>
        <input type="checkbox" :id="amenity.name" :value="amenity.id" v-model="checkedAmenities" true-value="yes" false-value="no">
    </div>

    <button class="btn btn-primary" @click="$emit('getAmenities', checkedAmenities)">Choose amenities</button>

    <h1 class="text-white">Checked: {{ checkedAmenities }}</h1>
    
</div>

</template>

<script>


export default {
    name: "SearchAndFilter",
    props: ['amenities'],
    data() {
        return {
            needle: '',
            rooms: 0,
            bathrooms: 0,
            checkedAmenities: [],
        }
    },
    
}

</script>

<style scoped lang="scss">


</style>



