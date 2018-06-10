<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class telenetcontrol extends Controller
{
    //
    public function listar($lista){
      switch ($lista) {
        //caso 1 selecciona los datos de atenciones
        case 1:
          $result= \DB::select('select * from atencion ORDER BY CAST(abierto AS unsigned) asc,CAST(codate AS unsigned) asc');
          break;
        //caso 2 selecciona todos los origenes de atenciones juridicos
        case 2:
          $result= \DB::select('select * from origenesn order by nombren asc');
          break;
        //caso 3 selecciona todos los origenes de atenciones naturales
        case 3:
          $result= \DB::select('select * from origenesj order by nombrej asc');
          break;
        //caso 4 selecciona las opciones estadisticas medio de comunicacion de la atencion
        case 4:
          $result= \DB::select('select codaso,valor from variables where tabla="atencion" and campo="medate"');
          break;
        //caso 5 selecciona las opciones estadisticas de llamadas del sector publico o privado
        case 5:
          $result= \DB::select('select codaso,valor from variables where tabla="atencion" and campo="pubpri"');
          break;
        // caso 6 selecciona las opciones de estados de una atención abierto, cerrado con detalle o cerrado
        case 6:
          $result= \DB::select('select codaso,valor from variables where tabla="atencion" and campo="abierto"');
          break;
        // caso 7 selecciona los productos para las ofertas
        case 7:
          $result= \DB::select('select * from ofproducto');
          break;
        // caso 8 selecciona las ofertas
        case 8:
          $result= \DB::select('select idepro,date_format(feciniof,"%d/%m/%Y") as feciniof,date_format(fecfinof,"%d/%m/%Y") as fecfinof,preofe,costo,margen from ofofertas order by feciniof desc');
          break;
      }
      return  $result;
    }


    public function auditor($pusuario,$ptabla,$paccion)
    {
      \DB::insert('insert into auditor (usuario,tabla,accion) values (?,?,?)',[$pusuario,$ptabla,$paccion]);
    }
    public function listaratenciones(){
      $atencion= Self::listar(1);
      return  view('vwatenciones')-> with('atenciones',$atencion);
    }
    public function listarofertas()
    {
      /*$protemp= Self::listar(7);
      $i=0;
      foreach ($protemp as $protemp1) {
        $producto[$i][0]=$protemp1->idepro;
        $producto[$i][1]=$protemp1->nompro;
        $producto[$i][2]=$protemp1->prepro;
        $i++;
      }*/
      $producto= Self::listar(7);
      $ofertas= Self::listar(8);
      return view('vwofertas')-> with('producto',$producto)-> with('ofertas',$ofertas)/*->with('i',($i))*/;
    }

    public function detallarate(Request $reg){
      $codate= $reg -> input("codate");
      if($codate=="newatt"){
          $maxcodate= \DB::select('select MAX(cast(codate as unsigned)) as intcodate from atencion');
          $newcodate=$maxcodate[0]->intcodate +1;
          if ($newcodate<1000) {
            $newcodate=1000;
          }
          \DB::insert('insert into atencion (codate,ateate,abierto) values (?,?,"01")',[$newcodate,\Session::get('user')]);
          $detate= \DB::select('select * from atencion where codate=?',[$newcodate]);
          Self::auditor(\Session::get('user'),'atencion','inserta nuevo registro'.$newcodate);
      }else {
          $detate= \DB::select('select * from atencion where codate=? ORDER BY CAST(codate AS unsigned) DESC',[$codate]);
      }
      $perate=Self::listar(2);
      $oriate=Self::listar(3);
      $medate=Self::listar(4);
      $pubpri=Self::listar(5);
      $abierto=Self::listar(6);

      return  view('vwdetatencion')-> with('detate',$detate)-> with('perate',$perate)-> with('oriate',$oriate)->
      with('medate',$medate)-> with('pubpri',$pubpri)-> with('abierto',$abierto);
    }

    public function guardarate(Request $reg){
      $peratecomp= \DB::select('select nombren from origenesn where nombren=?',[$reg -> input("perate")]);
      if (empty($peratecomp)){
        \DB::insert('insert into origenesn (nombren) values (?)',[$reg -> input("perate")]);
      }
      $oriatecomp= \DB::select('select nombrej from origenesj where nombrej=?',[$reg -> input("oriate")]);
      if (empty($oriatecomp)){
        \DB::insert('insert into origenesj (nombrej) values (?)',[$reg -> input("oriate")]);
      }
      $detate= \DB::update('update atencion set medate=?, perate=?, oriate= ?, pubpri= ?, asunto= ?, fono= ?,'.
      'movil= ?, email= ?, abierto=? where codate=?',
      [$reg -> input("medate"),$reg -> input("perate"),$reg -> input("oriate"),$reg -> input("pubpri"),
      $reg -> input("asunto"),$reg -> input("fono"),$reg -> input("movil"),$reg -> input("email"),
      $reg -> input("abierto"),$reg -> input("codate")]);

      Self::auditor(\Session::get('user'),'atencion','Actualiza registro '.$reg -> input("codate"));
      $atencion= Self::listar(1);
      return  view('vwatenciones')-> with('atenciones',$atencion);
    }

    public function guardaroferta(Request $reg){
      $oferta= \DB::select('select * from ofofertas where idepro=? and ((feciniof between ? and ?) or'.
      '(fecfinof between ? and ?))',
      [$reg -> input("idepro"),$reg -> input("feciniof"),$reg -> input("fecfinof"),
      $reg -> input("feciniof"),$reg -> input("fecfinof")]);
      if (!empty($oferta)){
        $caso=2;
        return view('vwrespuesta')-> with('caso',$caso)-> with('reg',$reg);
      }else{
        $caso=3;
        $codofe = \DB::select('select count(*)+1 as total from ofofertas');

        \DB::insert('insert into ofofertas (idepro,feciniof,fecfinof,preofe,costo,margen) values '.
        '(?,?,?,?,?,?)',
        [$reg -> input("idepro"),$reg -> input("feciniof"),$reg -> input("fecfinof"),
        $reg -> input("preofe"),$reg -> input("costo"),$reg -> input("margen")]);
        echo $reg -> input("esta");
        $esta= \DB::select('select * from ofproducto where idepro=?',[$reg -> input("idepro")]);
        if(empty($esta)){
          \DB::insert('insert into ofproducto (idepro,nompro,prepro) values (?,?,?)',
          [$reg -> input("idepro"), $reg -> input("nompro"), $reg -> input("prepro")]);
        }
        Self::auditor(\Session::get('user'),'ofofertas','ingresa oferta '.$codofe[0]->total);
        return view('vwrespuesta')-> with('caso',$caso);
      }
    }
}
