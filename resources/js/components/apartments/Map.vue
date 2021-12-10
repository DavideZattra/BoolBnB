<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Vue 3 TomTom Maps Demo</h1> 
                <div id='map' ref="mapRef"></div> 
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue'

export default {
    name: "Map",
    setup() { 
    const mapRef = ref(null); 
    onMounted(() => { 
       
            const tt = window.tt; 
            var map = tt.map({ 
            key: 'NLbGYpRnYCS3jxXsynN2IfGsmEgZJJzB', 
            container: mapRef.value, 
            style: 'tomtom://vector/1/basic-main', 
        }); 
        map.addControl(new tt.FullscreenControl()); 
        map.addControl(new tt.NavigationControl());  
    }) 
 
    return { 
      mapRef, 
    }; 
  }  
}

</script>

<style scoped lang="scss">

#map { 
    height: 50vh; 
    width: 50vw; 
} 

</style>