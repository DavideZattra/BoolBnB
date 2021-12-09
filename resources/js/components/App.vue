<template>
  <section>
    <Jubotron />
    <FakeHouses />
    <ApartmentList />
  </section>
</template>

<script>
import Jumbotron from './apartments/Jumbotron.vue';
import FakeHouses from './apartments/FakeHouses.vue';
import ApartmentsList from './apartments/ApartmentsList.vue';

export default {
    name: "App",
    components: {
        Jumbotron,
        FakeHouses,
        ApartmentsList
    },
    data
}
</script>

<style scoped lang="scss">


</style>