<template>
    <div class="col-4">
        <div id='map'></div>
    </div>
</template>
<script>
export default {
//   props: ['lon', 'lat', 'name', 'address'],
    mounted() {
        var lat = 45.87162000;
        var lon = 8.91306000;
        var coordinates = [lon, lat];
        var map = tt.map({
            container: 'map',
            key: '4plL73VgGOGRuTO2bSvJ1YZFmyuDVVaD',
            style: 'tomtom://vector/1/basic-main',
            center: coordinates,
            zoom: 10
        });
        var marker = new tt.Marker().setLngLat(coordinates).addTo(map);
        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
        var popupOffsets = {
            top: [0, 0],
            bottom: [0, -40],
            'bottom-right': [0, -70],
            'bottom-left': [0, -70],
            left: [25, -35],
            right: [-25, -35]
        }
        var popup = new tt.Popup({
            offset: popupOffsets
        }).setHTML(`${this.name}<br>${this.address}`);
        marker.setPopup(popup).togglePopup();
}
}
</script>

<style lang="scss">
    
</style>