<?php

namespace App\Controllers;

//os recursos do miniframework
//use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action
{

    public function autenticar()
    {

        //print_r($_POST);
        $usuario = Container::getModel('Usuario');

        $usuario->__set('email', $_POST['email']);
        $usuario->__set('senha', md5($_POST['senha']));

        // echo '<pre>';
        // print_r($usuario);
        // echo '</pre>';

        $retorno =  $usuario->autenticar();

        if (!empty($usuario->__get('id')) && !empty($usuario->__get('nome'))) {
            session_start();// para checar se o usuário está autenticado;

            $_SESSION['id']= $usuario->__get('id');
            $_SESSION['nome']= $usuario->__get('nome');

            header('Location: /timeline');

        }else
        {
            header('Location: /?login=erro');
        }

     

        // echo '<pre>';
        // print_r($usuario);
        // echo '</pre>';
    }
    public function sair (){
        session_start();
        session_destroy();
        header('Location: /');

    }
}
