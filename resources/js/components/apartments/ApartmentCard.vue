<template>
    <div class="col-12 col-sm-6 col-md-12 col-lg-4 card-wrapper">
        <div class="card col-12 p-0 d-flex" @click="goToThisHouse" style="width: 18rem;">
            <img class="card-img-top img-fluid" :src="'/storage/' + apartment.image" :alt="apartment.descriptive_title">
            <div class="card-body">
                <a class="text-center" href="#">{{ apartment.descriptive_title }}</a>
                <p class="m-0">
                <span>{{ apartment.addresses.country }}</span>, 
                <span>{{ apartment.addresses.city }}</span> <br>
                <span>{{ apartment.addresses.address }}</span>
                </p> 
            </div>
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
                axios.get(`${this.baseUri}/apartment/${this.apartment.id}`)
                    .finally( err => {
                        window.location = '/apartment/' + this.apartment.id;
                    })
            },
    }
}
</script>

<style scoped lang="scss">
  @import "../../../sass/partials/variables";
  @import "../../../sass/partials/general";
    .card-wrapper{
        padding: 0 20px 40px 20px;

        a{
            color: $my_brightyellow;

            &:hover{
                color: white;
            }
        }

        .card{
            // height: 300px;
            border: 3px solid $my_brightyellow;
            border-radius: 5px;
            cursor: pointer;

            .card-img-top{
                height: 150px;
            }

            a{
                font-size: 20px;
                font-weight: bold;
                color: $my_black;
            }

            span{
                color: $my_darkgrey;
            }
        }
    }

</style>