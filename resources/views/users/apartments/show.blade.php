@extends('layouts.app')

@section('cdn-entrypoint')
<link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.16.0/maps/maps.css'>

@endsection

@section('content')

    <div class="container">
        <div class="row">
            {{-- Titolo e indirizzo --}}
            <div class="col-12 apartment-modify">
                <h3 class="text-uppercase font-weight-bold">{{ $apartment->descriptive_title }}</h3>
                <div class="map-link mb-3 mt-3">
                    <a href="#">
                        <i class="fas fa-map-marked-alt"></i>
                        {{ $apartment->addresses->country }}, {{ $apartment->addresses->city }}, {{ $apartment->addresses->address }}
                    </a>
                </div>
            </div>

            {{-- Sezione immagine --}}
            <div class="col-12 show-img">
                <img src="{{ asset('storage/' . $apartment->image) }}" alt="immagine copertina dell'appartamento">
            </div>
            <div class="col-12 col-md-7 apartment-description mt-5">
                <h4>Description of your apartment:</h4>
                <p>{{ $apartment->description }}</p>
                <p><i class="fab fa-buromobelexperte"></i> rooms: {{ $apartment->rooms }}</p>
                <p><i class="fas fa-bed"></i> beds: {{ $apartment->beds }}</p>
                <p><i class="fas fa-restroom"></i> bathrooms: {{ $apartment->bathrooms }}</p>
                <p><i class="fas fa-home"></i> square meters: {{ $apartment->square_meters }}</p>

                <div class="hr"></div>

                <h3 class="mt-3">Servicies</h3>
                <ul>
                    @foreach ($amenities as $amenitie)
                        <li class="mt-2">{{ $amenitie }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-md-5 mt-5 map-show">
                <div id='map' class='map'></div>
            </div>

            <div class="hr col-9 mt-5 mb-5"></div>

            <div class="col-12">
                <h3>Messages</h3>
            </div>
            <div class="col-12">
                @forelse ($messages as $message)

                <div class="card mt-3">
                    <h5 class="card-header">{{ $message['name'] }}</h5>
                    <div class="card-body">
                      <h5 class="card-title">{{ $message['email'] }}</h5>
                      <p class="card-text">{{ $message['body'] }}</p>
                      <a href="#" class="btn btn-primary">Answer</a>
                    </div>
                </div>

                @empty

                <h4>Non hai ricevuto messaggi mentre eri via.. forse dovresti provare <a href="#">link per promuovere account</a></h4>
                    
                @endforelse
            </div>

            <div class="d-flex col-12 mt-3 mb-5">
                <a href="{{ route('users.apartments.edit', $apartment) }}" class="btn btn-primary mr-3">Modify your apartment details</a>
                <form action="{{route('users.apartments.destroy', $apartment->id )}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger" type="submit">Delete this apartment</a>
                </form>
            </div>




            {{-- Sezione immagini multiple da attivare se inseriamo più immagini per la show--}}
            {{-- <div class="col-12 col-md-8 show-img">
                <img src="{{ $apartment->image }}" alt="immagine copertina dell'appartamento">
            </div>
            <div class="col-md-4 d-none d-md-block show-img">
                <div class="row">
                    <div class="col-12">
                        <img src="{{ $apartment->image }}" alt="immagine dell'appartamento">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <img src="{{ $apartment->image }}" alt="immagine dell'appartamento">
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    
@endsection

@section('scripts-entrypoint')
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.16.0/maps/maps-web.min.js'></script>
    <script type="text/javascript">
        const apartment = {!! json_encode($apartment->toArray(), JSON_HEX_TAG) !!};
        let latitude = apartment.addresses.lat;
        let longitude = apartment.addresses.lon;
        let name = apartment.descriptive_title;
        console.log(apartment)

        tt.setProductInfo('<your-product-name>', '<your-product-version>');
        function isMobileOrTablet(){var i,a=!1;return i=navigator.userAgent||navigator.vendor||window.opera,(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(i)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(i.substr(0,4)))&&(a=!0),a}window.isMobileOrTablet=window.isMobileOrTablet||isMobileOrTablet;    
        var map = tt.map({
            key: 'NLbGYpRnYCS3jxXsynN2IfGsmEgZJJzB',
            container: 'map',
            dragPan: !isMobileOrTablet(),
            center: [longitude, latitude],
            zoom: 3
        });
        
        map.addControl(new tt.FullscreenControl());
        
        map.addControl(new tt.NavigationControl());
        
        function createMarker(icon, position, color, popupText) {
            var markerElement = document.createElement('div');
        
            markerElement.className = 'marker';
        
            var markerContentElement = document.createElement('div');
        
            markerContentElement.className = 'marker-content';
        
            markerContentElement.style.backgroundColor = color;
        
            markerElement.appendChild(markerContentElement);
        
            var iconElement = document.createElement('div');
        
            iconElement.className = 'marker-icon';
        
            iconElement.style.backgroundImage =
                'url(https://api.tomtom.com/maps-sdk-for-web/cdn/static/' + icon + ')';
        
            markerContentElement.appendChild(iconElement);
        
            var popup = new tt.Popup({offset: 30}).setText(popupText);
        
            // add marker to map
            new tt.Marker({element: markerElement, anchor: 'bottom'})
                .setLngLat(position)
                .setPopup(popup)
                .addTo(map);
        }

        createMarker('accident.colors-white.svg', [longitude, latitude], '#5327c3', name);
        

    </script>
@endsection