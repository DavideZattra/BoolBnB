<template>
<div class="container">
    <div class="input-group input-group-sm mt-5">
        <input v-model.trim="needle" @keyup="$emit('getQuery', needle)" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
    </div>  
</div>

</template>

<script>


export default {
    name: "SearchAndFilter",
    data() {
        return {
            needle: '',
        }
    }
}

</script>

<style scoped lang="scss">


</style>



