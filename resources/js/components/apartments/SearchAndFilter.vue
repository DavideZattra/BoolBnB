<template>
<div>
    <div class="row mt-4">
        <div class="col-12 input-group">
            <input 
                value=""
                v-model.trim="needle" 
                placeholder="Choose an address or a city" 
                @keyup.enter="$emit('getQuery', needle)" 
                type="text" 
                class="form-control" 
                aria-label="Small" 
                aria-describedby="inputGroup-sizing-sm"> 
            <div class="input-group-append">
                <button type="button" class="btn btn-secondary " @click="$emit('getQuery', needle)">Search</button>       
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
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

    <div class="row mt-4">
        <div class="col-12">
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
    </div>
    <div class="row mt-4">
        <div class="col-12">
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
    
    <div class="row mt-4 p-0">
        <div class="form-group col-12">
            <div class="dropdown">
                <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Choose your amenities
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <button class="my_button dropdown-item" type="button">
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
        </div>
    </div>
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

    .my_button:active,
    .my_button:hover {
        cursor: default;
        background: white;
        color: black;
    }

</style>



