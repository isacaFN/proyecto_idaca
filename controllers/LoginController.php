<?php

namespace controllers;

use MVC\router;
use Model\Usuario;
use Classes\Email;

class LoginController{
    public static function login(router $router){
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST); 

            $alertas = $auth->validarLogin();
            
            if(empty($alertas)){
                $usuario = Usuario::where('correo', $auth->correo);

                if($usuario){
                    if($usuario->comprobarPasswordANDpermiso($auth->password)){
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['correo'] = $usuario->correo;
                        $_SESSION['nivel'] = $usuario->nivel;
                        $_SESSION['login'] = true;

                        // redireccionar a la pagina de inicio
                        header('location: home');

                    }
                }else{
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }

            }

        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
        
    }

    public static function logout(){
        echo 'desde logout';
    }

    public static function olvidepw(router $router){

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);

            $alertas = $auth->validarCorreo();

            if(empty($alertas)){
                $usuario = Usuario::where('correo', $auth->correo);

                if($usuario && $usuario->permiso === '1'){
                    $usuario->crearToken();
                    $usuario->guardar();

                    $email = new Email($usuario->correo, $usuario->token, $usuario->nombre);
                    $email->enviarIntrucciones();

                    Usuario::setAlerta('exito', 'Revista tu correo electronico');
                }else{
                    Usuario::setAlerta('error', 'Correo no encontrado, o no esta confirmado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/olvidepw', [
            'alertas' => $alertas
        ]);
    }

    public static function home(router $router){
        $router->render('auth/home');
    }

    public static function recuperar(router $router){
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error', 'El token no es valido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $password = new Usuario($_POST);
            
            $alertas = $password->validarPassword();

            if(empty($alertas)){
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();

                if($resultado){
                    header('location: login');
                }

            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password',[
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function crear(){
        echo 'desde crear';
    }
}