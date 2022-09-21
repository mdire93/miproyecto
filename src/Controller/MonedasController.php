<?php

namespace App\Controller;

use App\Entity\Monedas;
use App\Entity\Peticion;

use Symfony\Component\HttpClient\HttpClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
class MonedasController extends AbstractController {

public function conexion (){
    return $this->getDoctrine()->getManager();
}
    
    /**
     * @Route ("/monedas")
     */
    public function monedas(){
      
    $httpClient = HttpClient::create();
    $response = $httpClient->request('GET', 'http://data.fixer.io/api/latest?access_key=7dcbf028b0d32e0738d5f6408203de71');

    $statusCode = $response->getStatusCode();
    // $statusCode = 200
    $content = $response->toArray();
    // transforms the response JSON content into a PHP array
    // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

    
        return $this->render('api/monedas.html.twig', array (
            'monedas' => $content
        ));
    
    }

    /**
     * @Route ("/conversion")
     * crea las monedas y las peticiones y llama a calcular el cambio de divisa
     */
    public function conversion (Request $request){

    $con=$this->conexion();
    $bd_monedas= $con->getRepository(Monedas::class);
    $bd_peticion= $con->getRepository(Peticion::class);

    $origen=$request->get('origen');
    $destino=$request->get('destino');
    $cantidad=$request->get('importe');
    $fecha=$request->get('fecha');
    
    $httpClient = HttpClient::create();
    $response = $httpClient->request('GET', 'http://data.fixer.io/api/latest?access_key=7dcbf028b0d32e0738d5f6408203de71');

    $content = $response->toArray();

    if  (!$bd_peticion->findOneBy( array ('consulta' => $origen.','.$destino.','.$cantidad.','.$fecha ) )){

    // creo el array monedas
    foreach ( $content as $claves =>$valor){
        if ($claves == "rates"){
            foreach ( $valor as $key => $importe ) {
                if ( !$bd_monedas->findOneBy(array( 'moneda'=>$key ))){
                $moneda= new Monedas();
                $moneda->setMoneda($key);
                $moneda->setValor($importe);
                $con->persist($moneda);
                $con->flush();
                }
            }
        } 
    }
        $valorFinal=$this->calculos($origen,$destino,$cantidad,$fecha);

        
    //guardo la peticion 
    $peticion = new Peticion();
    $peticion->setConsulta($origen.','.$destino.','.$cantidad.','.$fecha);
    $peticion->setRespuesta($valorFinal);
    $con->persist($peticion);
    $con->flush();
} else{
    $consulta = $bd_peticion->findOneBy( array ('consulta' => $origen.','.$destino.','.$cantidad.','.$fecha ) );
    $valorFinal= $consulta->getRespuesta();
}

        return $this->render('api/monedas.html.twig', array (
            'monedas' => $content,
            'origen' => $origen,
            'cantidad' => $cantidad,
            'valor' => $valorFinal
        ));
    }
/**
 * funcion para calcular cambio de divisa
 */
    public function calculos($origen,$destino,$cantidad,$fecha){
            $con=$this->conexion();
            $bd= $con->getRepository(Monedas::class);
            

                $valorOrigen= $bd->findOneBy(array('moneda'=>$origen));
                $valorDestino= $bd->findOneBy(array('moneda'=>$destino));
                $valorFinal = ($cantidad / $valorOrigen->getValor() ) * $valorDestino->getValor();

                return $cantidad .' '.$origen.' son: '.$valorFinal.' '.$destino.'';

    }
}
?>