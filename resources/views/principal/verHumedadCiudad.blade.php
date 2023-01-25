@extends('layouts.master')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Humedad </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('ver-humedad') }}">Regresar</a></li>
                <li class="breadcrumb-item active" aria-current="page">consultar humedad</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h2>{{$consulta->nombre}}</h2>
                        </div>
                        <hr>
                        <br>

                        <div class="d-flex justify-content-between">
                            <b>Humedad:</b>
                            <p>{{$consulta->humedad}}%</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <b>Zona Horaria:</b>
                            <p>{{$lugarBusquedaInfo->timezone}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <b>Temperatura</b>
                            <p>{{$lugarBusquedaInfo->current->temp}} °K</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <b>Presión</b>
                            <p>{{$lugarBusquedaInfo->current->temp}} hPa</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <b>Nubosidad</b>
                            <p>{{$lugarBusquedaInfo->current->clouds}}% </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-8">
                <div id="map"></div>
            </div>
        </div>
        <br>




        <script>
            var map = L.map('map').setView([25.7617, -80.1918], 4);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var popup = L.marker([25.7617, -80.1918]).addTo(map);
            popup.bindPopup("{{ $ciudad }} Humedad: {{ $lugarBusquedaHumedad }}%").openPopup();
        </script>
    </div>
</div>
@endsection
