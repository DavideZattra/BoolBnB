<template>
<div class="container">

    <div class="input-group input-group-sm mt-5">
        <input v-model.trim="needle" placeholder="Address or city" @keyup.enter="$emit('getQuery', needle)" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"> 
        <button type="button" class="btn btn-success" @click="$emit('getQuery', needle)">Search</button>       
    </div>

    <div class="input-group input-group-sm mt-5">
        <input v-model.number="rooms" @change="$emit('getRooms', rooms)" type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" min="1" max="10" >  

        <input v-model.number="bathrooms" @change="$emit('getBathrooms', bathrooms)" type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" min="1" max="10"> 

        <input v-model.number="radius" @change="$emit('getRadius', radius)" type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" min="1" max="550" > 
 
    </div>    

    <div class="amenities text-white" v-for="amenity in amenities" :key="amenity.id">
        <label :for="amenity.name">{{amenity.name}}</label>
        <input type="checkbox" :id="amenity.name" :value="amenity.id" v-model="checkedAmenities" true-value="yes" false-value="no">
    </div>

    <button class="btn btn-primary" @click="$emit('getAmenities', checkedAmenities)">Choose amenities</button>

    <h1 class="text-white">Checked: {{ checkedAmenities }}</h1>

    
    
    <form class="p-3">
        <div class="row mt-4 ml-2 d-flex align-items-center">
            <div class="col-sm-12 col-lg-6 d-flex">
                <input 
                    v-model.trim="needle" 
                    placeholder="Choose an address or a city" 
                    @keyup.enter="$emit('getQuery', needle)" 
                    type="text" 
                    class="form-control" 
                    aria-label="Small" 
                    aria-describedby="inputGroup-sizing-sm"> 
                <button type="button" class="btn btn-custom my_btn form-control-sm" @click="$emit('getQuery', needle)">Search</button>       
            </div>

            <div class="col-sm-12 col-lg-6 pb-4">
                <label class="form-check-label text-white">Choose the number of km radius from chosen location.</label>
                <input 
                    v-model.number="radius" 
                    @change="$emit('getRadius', radius)" 
                    type="number" class="form-control" 
                    aria-label="Small" 
                    aria-describedby="inputGroup-sizing-sm" 
                    min="1" max="550" >             
            </div>
        </div>

        <div class="row mt-4 ml-2">
            <div class="col-sm-12 col-lg-6">
                <label class="form-check-label text-white">Choose the number of needed rooms.</label>
                <input 
                    v-model.number="rooms" 
                    @change="$emit('getRooms', rooms)" 
                    type="number" 
                    class="form-control" 
                    aria-label="Small" 
                    aria-describedby="inputGroup-sizing-sm" 
                    min="1" max="10">
                </div>
            
            <div class="col-sm-12 col-lg-6">
                <label class="form-check-label text-white">Choose the number of needed bathrooms.</label>
                <input 
                    v-model.number="bathrooms" 
                    @change="$emit('getBathrooms', bathrooms)" 
                    type="number" 
                    class="form-control" 
                    aria-label="Small" 
                    aria-describedby="inputGroup-sizing-sm" 
                    min="1" max="10">
            </div>
        </div>
        
        <div class="row mt-4 ml-2">
            <div class="form-group col-sm-12 col-lg-6">
                <div class="dropdown">
                    <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Choose your amenities.
                    </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button">
                            <div v-for="amenity in amenities" :key="amenity.id">
                                <input 
                                    type="checkbox" 
                                    class="form-check-input" 
                                    :id="amenity.name" 
                                    :value="amenity.id" 
                                    v-model="checkedAmenities" 
                                    true-value="yes" 
                                    false-value="no">
                                <label class="form-check-label" :for="amenity.name">{{amenity.name}}</label>    
                            </div>
                            <button class="btn btn-custom m-2" @click="$emit('getAmenities', checkedAmenities)">Submit</button>
                        </button>
                    </div>
                </div>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <div class="form-check form-check-inline">
                        <div v-for="amenity in amenities" :key="amenity.id">
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                :id="amenity.name" 
                                :value="amenity.id" 
                                v-model="checkedAmenities" 
                                true-value="yes" 
                                false-value="no">
                            <label class="form-check-label" :for="amenity.name">{{amenity.name}}</label>    
                        </div>
                        <button class="btn btn-custom" @click="$emit('getAmenities', checkedAmenities)">Choose amenities</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

</template>

<script>


export default {
    name: "SearchAndFilter",
    props: ['amenities'],
    data() {
        return {
            needle: '',
            rooms: 1,
            bathrooms: 1,
            radius: 20,
            checkedAmenities: [],
        }
    },
}

</script>

<style scoped lang="scss">
    .my_btn{
        height: 80%;
    }

</style>



