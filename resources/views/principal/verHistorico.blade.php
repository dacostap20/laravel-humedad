@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Histórico </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('ver-humedad') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Histórico</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ciudad</th>
                            <th>Fecha Filtrada</th>
                            <th>Humedad fecha filtrada</th>
                            <th>Fecha consulta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Historicos as $Historico)
                            <tr>
                                <td>{{$Historico->historicoCiudad->nombre}}</td>
                                <td>{{$Historico->fechaConsultada}}</td>
                                <td>{{$Historico->humedadConsultada}}</td>
                                <td>{{$Historico->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
