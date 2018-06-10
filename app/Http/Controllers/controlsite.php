<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Controllers\auditor;


class controlsite extends Controller
{
    //
    public function curl($url) {
        $ch = curl_init($url); // Inicia sesión cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Configura cURL para devolver el resultado como cadena
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Configura cURL para que no verifique el peer del certificado dado que nuestra URL utiliza el protocolo HTTPS
        $info = curl_exec($ch); // Establece una sesión cURL y asigna la información a la variable $info
        curl_close($ch); // Cierra sesión cURL
        return $info; // Devuelve la información de la función
    }

    public function auditors($pusuario,$ptabla,$paccion)
    {
      \DB::insert('insert into auditor (usuario,tabla,accion) values (?,?,?)',[$pusuario,$ptabla,$paccion]);
    }
    public function salirsite()
    {
      \Session::forget('user');
      \Session::forget('valdolar');
      \Session::forget('observado');
      return view("vwsalio");
    }
    public function registrarusuario(Request $reg){
      \DB::insert('insert into usuarios (nombre,usuario,password,email) '.
      'values (?,?,?,?)',[$reg -> input("nombre"),$reg -> input("usuario"),$reg -> input("pwd"),$reg -> input("email2")]);
      Self::auditors($reg -> input("usuario"),'usuarios','inserto usuario '.$reg -> input("usuario"));
      return view("vwrespuesta")-> with('caso',1);
    }
    public function accesarsite(Request $reg){
      $user=$reg->input("usuario");
      $pawd=$reg->input("password");
      $users= \DB::select('select * from usuarios where usuario=? and password=?',[$user,$pawd]);
      if (!empty($users)){
        $sitioweb = Self::curl("https://si3.bcentral.cl/IndicadoresSiete/secure/IndicadoresDiarios.aspx");  // Ejecuta la función curl escrapeando el sitio web https://devcode.la and regresa el valor a la variable $sitioweb
      	$cadena = 'id="lblValor1_3">';
      	$valdolar=substr($sitioweb,strpos($sitioweb,$cadena) + 17,6);
      	if(intval(substr($valdolar,4,2))<50){
      		$observado=intval(substr($valdolar,0,3))+5;
      	}else{
      		$observado=intval(substr($valdolar,0,3))+6;
      	}
      	\Session::put('valdolar',$valdolar);
        \Session::put('observado',$observado);
        \Session::put('user',$users[0]->usuario);
        return  view('menu');
      }else{
        return  view('vwincorrecto');
      }
    }
}
