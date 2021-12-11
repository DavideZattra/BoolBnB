<template>
<div class="container">
    <div class="input-group input-group-sm mt-5">
        <input v-model.trim="needle" placeholder="Address or city" @keyup.enter="$emit('getQuery', needle)" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"> 
        <button type="button" class="btn btn-success" @click="$emit('getQuery', needle)">Search</button>       
    </div>

    <div class="input-group input-group-sm mt-5">
        <input v-model.trim="rooms" placeholder="Minimum number of rooms" @keyup.enter="$emit('getRooms', rooms)" type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"> 

        <input v-model.trim="bathrooms" placeholder="Minimum number of bathrooms" @keyup.enter="$emit('getBathrooms', bathrooms)" type="number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"> 
             
    </div>    



    <!-- <div class="dropdown show">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown link
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
        </div>
    </div> -->
</div>

</template>

<script>


export default {
    name: "SearchAndFilter",
    data() {
        return {
            needle: '',
            rooms: 0,
            bathrooms: 0
        }
    }
}

</script>

<style scoped lang="scss">


</style>



