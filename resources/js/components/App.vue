<template>
    <div>
        <ApartmentsList/>
        <Map/>
    </div>
</template>

<script>

import ApartmentsList from './apartments/ApartmentsList.vue';
import Map from './apartments/Map.vue';

export default {
    name: "App",
    components: {
        ApartmentsList,
        Map
    },
}
</script>

<style scoped lang="scss">


</style>