<template>
<div class="container">
    <div class="input-group input-group-sm mt-5">
        <input v-model.trim="needle" placeholder="Address or city" @keyup.enter="$emit('getQuery', needle)" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"> 
        <button type="button" class="btn btn-success" @click="$emit('getQuery', needle)">Search</button>       
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
            needle: ''
        }
    }
}

</script>

<style scoped lang="scss">


</style>



