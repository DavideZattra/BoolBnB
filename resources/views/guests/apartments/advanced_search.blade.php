@extends('layouts.app')

@section('cdn-entrypoint')
    <link  rel='stylesheet'  type='text/css'  href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/maps.css'>
@endsection

@section('content')

    {{-- Vue container --}}
    <div id="root"></div>
    
@endsection
    
@section('scripts-entrypoint')
    <script  src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/maps-web.min.js"></script> 
    <script  src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/services/services-web.min.js"></script> 
@endsection