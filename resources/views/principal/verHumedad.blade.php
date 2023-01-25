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
                <li class="breadcrumb-item"><a href="#">Lugares</a></li>
                <li class="breadcrumb-item active" aria-current="page">consultar humedad</li>
            </ol>
        </nav>
    </div>
    <div class="row hr-banner">
        <div class="col-xl-12 col-sm-12 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex">
                        <div class="pr-4 border-right-lg">
                            <i class="mdi mdi-alert-circle menu-icon" style="font-size: 50px"></i>
                        </div>
                        <div class="w-75 px-0 px-lg-4">
                            <div class="d-lg-flex align-items-center mb-2">
                                <h4 class="mr-3 mb-0 mt-2 mt-sm-0">Elija fecha a consultar</h4>

                            </div>
                            <form class="form-sample"
                                    action="{{ url('ver-humedad-fecha') }}"
                                    method="POST" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <input type="date" class="form-control"
                                            name="fechaForm"
                                            id="fechaForm" min="{{$fechaAntes}}" >

                                    </div>
                                    <button class="btn btn-outline-success"
                                        type="submit">Ver</button>
                                </form>
                            <p class="text-muted mb-0">Datos de la fecha: {{$fecha}} </p>
                        </div>
                        <!--<a href="#" class="close-hr-banner"><i class="mdi mdi mdi-close-circle mdi-24px"></i></a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            @foreach ($lugares as $lugar)
                <div class="col-sm-12 col-md-4">
                    <a class="nav-link" href="{{ url('ver-humedad-ciudad', ['lugar' => $lugar->id,'fecha' => $fechaUnix]) }}">
                        <div class="card">
                            <div class="card-body">

                                <div class="d-flex justify-content-between">
                                    <b>{{$lugar->nombre}}</b>
                                    @if ($vista == 2)
                                        <p>{{$lugar->humedad}}% - {{$lugar->humedadPasada}}%</p>
                                    @else
                                        <p>{{$lugar->humedad}}%</p>
                                    @endif
                                </div>
                                @if ($vista == 2)
                                    <div class="d-flex justify-content-between">
                                        <p> </p>
                                        <p>actual - anterior</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <br>
        <div id="map"></div>



        <script>
            var map = L.map('map').setView([25.7617, -80.1918], 4);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var miami = L.marker([25.7617, -80.1918]).addTo(map);
            miami.bindPopup("Miami Humedad: {{ $miamiHumedad }}%").openPopup();

            var orlando = L.marker([28.5383, -81.3792]).addTo(map);
            orlando.bindPopup("Orlando Humedad: {{ $orlandoHumedad }}%").openPopup();

            var newYork = L.marker([40.730610, -73.935242]).addTo(map);
            newYork.bindPopup("New York Humedad: {{ $newYorkHumedad }}%").openPopup();
        </script>
    </div>
</div>
@endsection
