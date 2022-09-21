<?php

namespace App\Controller;

use App\Entity\Sectores;
use App\Entity\Empresas;
use App\Entity\Usuarios;
use App\Entity\Usuariossectores;


use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
class DefaultController extends AbstractController {






public function conexion (){
    return $this->getDoctrine()->getManager();
}

public function consulta($con,$nombre){
    if ($nombre=="sectores"){
        $bd = $con->getRepository(Sectores::class);
    } elseif ($nombre=="empresas"){
        $bd = $con->getRepository(Empresas::class);
    } elseif ($nombre=="usuarios"){
        $bd = $con->getRepository(Usuarios::class);
    } elseif ($nombre=="usuariossectores"){
        $bd = $con->getRepository(Usuariossectores::class);
    }
    return  $bd->findAll();
}
       

public function obtenersesion(){
        
    $session= new Session();
    if (!$session->has('usuario')){
        $session->start();
    }
    $con = $this->getDoctrine()->getManager();
    $bd = $con->getRepository(Usuarios::class);

    return $bd->findOneBy( array ('usuario' => $session->get('usuario')));
}

    /**
     * @Route ("/")
     * muesta la plantilla de la pag principal 
     */
    public function principal() { 
        
        return $this->render('login.html.twig');
    }

    
    /**
     * @Route ("/logout")
     */
    public function logout() {
        $session= new Session();
        $session->start();
        $session->remove('usuario');
      
        return $this->principal();
    }

     /**
         * @Route("/logearse"), name="logearse"
         * Funcion que comprueba si hay algun usuario 
         * si hay busca si coincide la pass
         */
        public function logearse(Request $request){
            $logeo=false;
            $con= $this->getDoctrine()->getRepository(Usuarios::class);
            $usuario_login= new Usuarios();
            $usuario= new Usuarios();
    
            if ($con->findOneBy( array ('usuario' => $request->get('usuario') ) ) ){
            $usuario_login= $con->findOneBy( array ('usuario' => $request->get('usuario') ) ) ;

            if ($usuario_login->getPass() == md5($request->get('pass'))){
                $usuario=$usuario_login;
                // inicio sesion          
                $session = new Session();
                $session->start();
                $session->set('usuario', $usuario->getUsuario());
                //rol
                $session->set('rol', $usuario->getRol());
                //id usuario 
                $session->set('id', $usuario->getId());
                $logeo=true;
                //cambiar de pag 
                } else {
                    echo 'Usuario o contraseña no válidos';
                }
              
            } else {
                echo "Usuario o contraseña no válidos";
            }
            if ($logeo){
                return $this->sectores();
            } else {
                return $this->principal();
            }
    }

public function obtener_mis_sectores(){
    
    $con= $this->conexion();
    $usuario_sesion= $this->obtenersesion();
    $bd = $con->getRepository(Usuariossectores::class);
    $mis_sectores = $bd->findBy( array ('id_usuario' => $usuario_sesion->getId()));

    return $mis_sectores;
}
        /**
     * @Route ("/sectores")
     */
    public function sectores() {
        $con= $this->conexion();
        $sectores = $this->consulta($con,'sectores');
        $mis_sectores= $this->obtener_mis_sectores();

        return $this->render('sectores.html.twig', array (
            'sectores' => $sectores,
            'mis_sectores' => $mis_sectores
        ));
    }
    
    /**
     * @Route ("/empresas")
     */
    public function empresas() { 
        $con= $this->conexion();
        $empresas = $this->consulta($con,'empresas');
        $sectores = $this->consulta($con,'sectores');
        $mis_sectores= $this->obtener_mis_sectores();

        return $this->render('empresas.html.twig', array (
            'empresas' => $empresas,
            'sectores' => $sectores,
            'mis_sectores' => $mis_sectores
        ));
    }

    
    /**
     * @Route ("/usuarios")
     */
    public function usuarios() { 
        $con= $this->conexion();
        $usuarios = $this->consulta($con,'usuarios');
        $sectores = $this->consulta($con,'sectores');
        $sectores_usuarios = $this->consulta($con,'usuariossectores');

        return $this->render('usuarios.html.twig', array (
            'usuarios' => $usuarios,
            'sectores' => $sectores,
            'usuariossectores' => $sectores_usuarios
        ));
    }

    
    /**
     * @Route ("/empresas_sector")
     */
    public function empresas_sector(Request $request) { 
        $con= $this->conexion();
        $empresas = $this->consulta($con,'empresas');
        
        $sectores = $this->consulta($con,'sectores');
        $bd= $con->getRepository(Empresas::class);

        $empresas_id =$bd->findBy( array('id_sector'=>$request->get('buscarid')));

        return $this->render('empresas.html.twig', array (
            'empresas' => $empresas,
            'sectores' => $sectores,
            'empresas_id' =>$empresas_id
        ));
    }

    
    /**
     * @Route ("/editar_sector/{id}")
     */
    public function editar_sector(Sectores $sector) { 
        return $this->render('nuevo_sector.html.twig', array (
            'sector' => $sector
        ));
    } 
    
    
    /**
    * @Route ("/editar_usuario/{id}")
    */
   public function editar_usuario(Usuarios $usuario) { 
    

    return $this->render('nuevo_usuario.html.twig', array (
        'usuario' => $usuario,
        
    ));
}

    /**
    * @Route ("/editar_empresa/{id}")
    */
   public function editar_empresa(Empresas $empresa) { 
       $con= $this->conexion();
       $sectores= $this->consulta($con,'sectores');

       return $this->render('nueva_empresa.html.twig', array (
           'empresa' => $empresa,
           'sectores'  => $sectores
       ));
   }
   
    /**
     * @Route ("/nuevo_usuario")
     */
    public function nuevo_usuario() { 
        return $this->render('nuevo_usuario.html.twig');
    }
    /**
     * @Route ("/nuevo_sector")
     */
    public function nuevo_sector() { 
        return $this->render('nuevo_sector.html.twig');
    }

        /**
     * @Route ("/nueva_empresa")
     */
    public function nueva_empresa() { 
        $con= $this->conexion();
        $sectores= $this->consulta($con,'sectores');
        return $this->render('nueva_empresa.html.twig', array (
            'sectores' => $sectores
        ));
    }

      

     /**
     * @Route ("/crear_usuario") 
     */
    public function crear_usuario(Request $request) { 
        $con = $this->conexion();

        
        
    $bd= $con->getRepository(Usuarios::class);
    if( $bd->findOneBy( array ('usuario' => $request->get('usuario')) ) ){
            echo 'Ese usuario ya existe';
            return $this->nuevo_usuario();
    } else {

        $usuario = new Usuarios();
        $usuario->setUsuario($request->get('usuario'));
        $usuario->setNombre($request->get('nombre'));
        $usuario->setApellidos($request->get('apellidos'));
        $usuario->setEmail($request->get('email'));
        $usuario->setPass(md5($request->get('pass')));
        $usuario->setRol($request->get('rol'));

        $con->persist($usuario);
        $con->flush(); 
        return $this->sectores();
    }

    }

    /**
     * @Route ("/crear_sector")
     */
    public function crear_sector(Request $request) {
        $con= $this->conexion();
        $sector= new Sectores ();

    $bd= $con->getRepository(Sectores::class);
    if( $bd->findOneBy( array ('nombre' => $request->get('nombre')) ) ){
            echo 'Ese sector ya existe';
            return $this->nuevo_sector();
    } else {

        $sector->setNombre($request->get('nombre'));
        $con->persist($sector);
        $con->flush();
        return $this->sectores();
    }
    }
    
    
    /**
     * @Route ("/modifico_usuario/{id}")
     */
    public function modifico_usuario(Usuarios $user, Request $request) {
        $con= $this->conexion();

      
        $user->setUsuario($request->get('usuario'));
        $user->setNombre($request->get('nombre'));
        $user->setApellidos($request->get('apellidos'));
        $user->setEmail($request->get('email'));
        $user->setPass(md5($request->get('pass')));
        $user->setRol($request->get('rol'));

        $con->persist($user);
        $con->flush(); 
        return $this->usuarios();
    }
    /**
     * @Route ("/modifico_sector/{id}")
     */
    public function modifico_sector(Sectores $sector, Request $request) {
        $con= $this->conexion();

        $sector->setNombre($request->get('nombre'));

        $con->persist($sector);
        $con->flush();
        return $this->sectores();
    }
        
    /**
     * @Route ("/modifico_empresa/{id}")
     */
    public function modifico_empresa(Empresas $empresa, Request $request) {
        $con= $this->conexion();

        $empresa->setNombre($request->get('nombre'));
        $empresa->setEmail($request->get('email'));
        $empresa->setIdSector($request->get('sector'));
        $con->persist($empresa);
        $con->flush();
        return $this->empresas();
    }
    /**
     * @Route ("/crear_empresa")
     */
    public function crear_empresa(Request $request) {
        $con= $this->conexion();
        $empresa= new Empresas ();
        $empresa->setNombre($request->get('nombre'));
        $empresa->setEmail($request->get('email'));
        $empresa->setIdSector($request->get('sector'));
        $con->persist($empresa);
        $con->flush();
        return $this->empresas();
    }


    
     /**
     * @Route ("/eliminar_sector/{id}")
     */
    public function eliminar_sector(Sectores $sector) {
        $con= $this->conexion();
       
        $bd= $con->getRepository(Empresas::class);
        $empresas_id =$bd->findBy( array('id_sector'=> $sector->getId()));

        if ( !$empresas_id){
        $con->remove($sector);
        $con->flush();
        } else {
            echo ' Error al eliminar el sector. Hay empresas que pertenecen a este sector.';
        }
        return $this->sectores();
    }


    
     /**
     * @Route ("/eliminar_usuario/{id}")
     */
    public function eliminar_usuario(Usuarios $usuario) {
        $con= $this->conexion();
       
        $con->remove($usuario);
        $con->flush();
       
        return $this->empresas();
    }
     /**
     * @Route ("/eliminar_empresa/{id}")
     */
    public function eliminar_empresa(Empresas $empresa) {
        $con= $this->conexion();
       
        $con->remove($empresa);
        $con->flush();
       
        return $this->usuarios();
    }

    
     /**
     * @Route ("/quitar_sector/{id}")
     */
    public function quitar_sector(Usuariossectores $usuario_sector) {
        $con= $this->conexion();
       
        $con->remove($usuario_sector);
        $con->flush();
       
        return $this->usuarios();
    }

    /**
     * @Route ("/asignar_sector/{id}")
     */
    public function asignar_sector(Usuarios $usuario){
        $con =$this->conexion();
        $sectores = $this->consulta($con,'sectores');
        return $this->render('asignar_sector.html.twig', array(
            'sectores' => $sectores,
            'usuario' => $usuario
        ));
    }
    
    /**
     * @Route ("/asignar/{id}")
     */
    public function asignar(Usuarios $usuario, Request $request){
        $con =$this->conexion();
        $usuario_sector= new Usuariossectores();

        $usuario_sector->setIdUsuario($usuario->getId());
        $usuario_sector->setIdSector($request->get('sector'));

        $con->persist($usuario_sector);
        $con->flush();

        return $this->usuarios();
    }

}
?>