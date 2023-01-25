<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Paises;
use App\Models\HistoricoConsultas;
use GuzzleHttp\Client;

use DateTimeZone;
use DateTime;
class HumedadPaisesController extends Controller
{
    //
    public function index(){
/*
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openweathermap.org/data/2.5/onecall?lat=28.5383&lon=-81.3792&appid=278857e8dee51f914026df21d0d40c19&lang=es');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $data = curl_exec($ch);

        if($data === false){
            echo 'Curl error: ' . curl_error($ch);
            exit();
        }

        curl_close($ch);
        $array = json_decode($data, true);

        var_dump($array);die();*/

        $lugares = Paises::all();
        $key='278857e8dee51f914026df21d0d40c19';
        $ruta='https://api.openweathermap.org/data/2.5/onecall?lat=28.5383&lon=-81.3792&appid=278857e8dee51f914026df21d0d40c19&lang=es';

        $hoy = new  DateTime();

        $hoy->setTimezone(new DateTimeZone('America/Bogota'));

        $fecha = $hoy->format('d/m/Y H:i:s');

        $fechaSql = $hoy->format('Ymd H:i:s');
        $fechaAntes = strtotime('-5 day', strtotime($fechaSql));
        $fechaAntes = date('Y-m-d', $fechaAntes);
        $fechaUnix=strtotime($fechaSql);

        $client = new Client([
            'verify' => false,
        ]);




        foreach ($lugares as $lugar) {
            $actualizar=Paises::find($lugar->id);
            //var_dump($actualizar->id);die();
            if($lugar->id == 1){
                $miami = $client->get('https://api.openweathermap.org/data/2.5/onecall?lat='.$lugar->lat.'&lon='.$lugar->lon.'&appid=278857e8dee51f914026df21d0d40c19&lang=es');
                $miamiInfo = json_decode($miami->getBody());
                $miamiHumedad = $miamiInfo->current->humidity;
                $actualizar->humedad=$miamiHumedad;
                $agregarHistoricoM=$this->agregarHistorico('index',$miamiHumedad,1,$fechaSql);
            }elseif ($lugar->id == 2) {
                $orlando = $client->get('https://api.openweathermap.org/data/2.5/onecall?lat='.$lugar->lat.'&lon='.$lugar->lon.'&appid=278857e8dee51f914026df21d0d40c19&lang=es');
                $orlandoInfo = json_decode($orlando->getBody());
                $orlandoHumedad = $orlandoInfo->current->humidity;
                $actualizar->humedad=$orlandoHumedad;
                $agregarHistoricoM=$this->agregarHistorico('index',$orlandoHumedad,2,$fechaSql);
            }else{
                $newYork = $client->get('https://api.openweathermap.org/data/2.5/onecall?lat='.$lugar->lat.'&lon='.$lugar->lon.'&appid=278857e8dee51f914026df21d0d40c19&lang=es');
                $newYorkInfo = json_decode($newYork->getBody());
                $newYorkHumedad = $newYorkInfo->current->humidity;
                $actualizar->humedad=$newYorkHumedad;
                $agregarHistoricoM=$this->agregarHistorico('index',$newYorkHumedad,3,$fechaSql);
            }
            $actualizar->save();
        }
        $lugares = Paises::all();
        $vista=1;

        return view('principal.verHumedad', compact('miamiHumedad', 'orlandoHumedad', 'newYorkHumedad','lugares','fecha','vista','fechaUnix','fechaAntes'));

    }
    public function lugarEspecifico($lugar=null,$fecha=null){
        $consulta=Paises::find($lugar);
        $hoy = new  DateTime("@$fecha");
        $fechaVista = $hoy->format('d/m/Y H:i:s');
        $fechaSql = $hoy->format('Ymd H:i:s');
        $client = new Client([
            'verify' => false,
        ]);
        //echo $lugar;var_dump($consulta);die();
        $lugarBusqueda = $client->get('https://api.openweathermap.org/data/2.5/onecall/timemachine?lat='.$consulta->lat.'&lon='.$consulta->lon.'&dt='.$fecha.'&appid=278857e8dee51f914026df21d0d40c19&lang=es');
        $lugarBusquedaInfo = json_decode($lugarBusqueda->getBody());
        $lugarBusquedaHumedad = $lugarBusquedaInfo->current->humidity;
        $consulta->humedad=$lugarBusquedaHumedad;
        $consulta->save();
        $ciudad=$consulta->nombre;
        $agregarHistoricoM=$this->agregarHistorico('lugarEspecifico',$lugarBusquedaHumedad,$lugar,$fechaSql);
        return view('principal.verHumedadCiudad', compact('lugarBusquedaHumedad','consulta','ciudad','lugarBusquedaInfo'));
    }
    public function cambioFecha(Request $request){
        $fechaForm=$request->input('fechaForm');
        $fechaUnix=strtotime($fechaForm);
        $hoy = new  DateTime($fechaForm);
        $fecha = $hoy->format('d/m/Y H:i:s');
        $fechaSql = $hoy->format('Ymd H:i:s');

        $actual = new  DateTime();

        $actual->setTimezone(new DateTimeZone('America/Bogota'));
        $fechaSqlActual = $actual->format('Ymd H:i:s');
        $fechaAntes = strtotime('-5 day', strtotime($fechaSqlActual));
        $fechaAntes = date('Y-m-d', $fechaAntes);
        $client = new Client([
            'verify' => false,
        ]);
        $lugares = Paises::all();
        foreach ($lugares as $lugar) {
            $actualizar=Paises::find($lugar->id);
            if($lugar->id == 1){
                $miami = $client->get('https://api.openweathermap.org/data/2.5/onecall/timemachine?lat='.$lugar->lat.'&lon='.$lugar->lon.'&dt='.$fechaUnix.'&appid=278857e8dee51f914026df21d0d40c19&lang=es');
                $miamiInfo = json_decode($miami->getBody());
                $miamiHumedad = $miamiInfo->current->humidity;
                $actualizar->humedadPasada=$miamiHumedad;
                $agregarHistoricoM=$this->agregarHistorico('cambioFecha',$miamiHumedad,1,$fechaSql);
            }elseif ($lugar->id == 2) {
                $orlando = $client->get('https://api.openweathermap.org/data/2.5/onecall?lat='.$lugar->lat.'&lon='.$lugar->lon.'&appid=278857e8dee51f914026df21d0d40c19&lang=es');
                $orlandoInfo = json_decode($orlando->getBody());
                $orlandoHumedad = $orlandoInfo->current->humidity;
                $actualizar->humedadPasada=$orlandoHumedad;
                $agregarHistoricoM=$this->agregarHistorico('cambioFecha',$orlandoHumedad,2,$fechaSql);
            }else{
                $newYork = $client->get('https://api.openweathermap.org/data/2.5/onecall?lat='.$lugar->lat.'&lon='.$lugar->lon.'&appid=278857e8dee51f914026df21d0d40c19&lang=es');
                $newYorkInfo = json_decode($newYork->getBody());
                $newYorkHumedad = $newYorkInfo->current->humidity;
                $actualizar->humedadPasada=$newYorkHumedad;
                $agregarHistoricoM=$this->agregarHistorico('cambioFecha',$newYorkHumedad,3,$fechaSql);
            }
            $actualizar->save();
        }
        $lugares = Paises::all();
        $vista=2;

        return view('principal.verHumedad', compact('miamiHumedad', 'orlandoHumedad', 'newYorkHumedad','lugares','fecha','vista','fechaUnix','fechaAntes'));
    }
    public function agregarHistorico($metodo=null,$humedad=null,$idCiudad=null,$fecha=null){

            $nuevo= new HistoricoConsultas();
            $nuevo->metodo=$metodo;
            $nuevo->fechaConsultada=$fecha;
            $nuevo->humedadConsultada=$humedad;
            $nuevo->idCiudad=$idCiudad;
            $nuevo->save();
        return [];

    }
    public function verHistorico(){
        $Historicos=HistoricoConsultas::all();
        return view('principal.verHistorico', compact('Historicos'));
    }
}
