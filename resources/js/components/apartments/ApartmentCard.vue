<template>
    <div class="card col-3 mx-4 mb-4 p-0" @click="goToThisHouse" style="width: 18rem;">
        <img class="card-img-top" :src="'/storage/' + apartment.image" :alt="apartment.descriptive_title">
        <div class="card-body">
            <a class="text-center" href="#">{{ apartment.descriptive_title }}</a>
            <p class="m-0">
            <span>{{ apartment.addresses.country }}</span>, 
            <span>{{ apartment.addresses.city }}</span> <br>
            <span>{{ apartment.addresses.address }}</span>
            </p> 
        </div>
    </div>
</template>

<script>

export default {
    name: "ApartmentCard",
    props: ["apartment"],
    data(){
      return {
          baseUri : 'http://127.0.0.1:8000',
      }
    },
    methods: {
        goToThisHouse() {
                axios.get(`${this.baseUri}/users/apartments/${this.apartment.id}`)
                    .finally( err => {
                        window.location = '/users/apartments/' + this.apartment.id;
                    })
            },
    }
}
</script>

<style scoped lang="scss">
  @import "../../../sass/partials/variables";
  @import "../../../sass/partials/general";
    .row{
        background-color: $my_new-black;
        border-radius: 20px;
    }

    a{
        color: $my_brightyellow;

        &:hover{
            color: white;
        }
    }

    .card{
        border: 3px solid $my_brightyellow;
        cursor: pointer;

        a{
            font-size: 20px;
            font-weight: bold;
            color: $my_black;
        }

        span{
            color: $my_darkgrey;
        }
    }

</style>