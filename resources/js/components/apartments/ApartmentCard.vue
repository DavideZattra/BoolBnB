<template>
      <div class="card col-3 m-3">
        <div class="card-body">
            <img class="img-fluid" :src="apartment.image" :alt="apartment.descriptive_title">
            <h4 class="card-title">{{apartment.descriptive_title}}</h4>
            <h5 class="card-title">{{apartment.addresses.country}}</h5>
            <span class="card-title">{{apartment.addresses.city}}</span>
            <span class="card-title">{{apartment.addresses.address}}</span>
        </div>
  </div>
</template>

<script>

export default {
    name: "ApartmentCard",
    props: ["apartment"],
}
</script>

<style scoped lang="scss">

</style>