<template>
    <div class="bg-container">
        <ApartmentsList/>
    </div>
</template>

<script>

import ApartmentsList from './apartments/ApartmentsList.vue';


export default {
    name: "App",
    components: {
        ApartmentsList,
    },
}
</script>

<style scoped lang="scss">


</style>