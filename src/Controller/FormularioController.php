<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormularioController extends AbstractController {

public function conexion (){
    return $this->getDoctrine()->getManager();
}
    
    /**
     * @Route ("/formulario")
     */
    public function formulario(){
      

    
        return $this->render('formulario/formulario.html.twig');
    
    }

}
?>