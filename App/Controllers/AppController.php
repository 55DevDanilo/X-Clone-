<?php

namespace App\Controllers;

//os recursos do miniframework
//use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action
{

    public function timeline()
    {


        $this->validaAutenticacao();

        $tweet = Container::getModel('Tweet');

        $tweet->__set('id_usuario', $_SESSION['id']);

        $tweets = $tweet->getAll();
        // echo '<pre>';

        // print_r($tweets);

        // echo '</pre>';

        $this->view->tweets = $tweets;

        $this->render('timeline');
        # code...



    }

    public function tweet()
    {

        //session_start();
        $this->validaAutenticacao();

        //  $this->render('timeline');
        //  print_r($_POST);

        $tweet = Container::getModel('Tweet');
        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->__set('id_usuario', $_SESSION['id']);
        $tweet->salvar();
        header('Location: /timeline');
    }

    public function validaAutenticacao()
    {
        session_start();

        if (!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
            header('Location: /?login=erro');
        } else {
        }
    }

    public function quemSeguir()
    {

        $this->validaAutenticacao();

        // echo '<br /><br /><br /><br /><br /><br />';

        $pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';

        $usuarios = array();
        // echo 'Pesquisador por :' . $pesquisarPor;

        if ($pesquisarPor != '') {

            $usuario = Container::getModel('Usuario');
            $usuario->__set('nome', $pesquisarPor);
            $usuarios = $usuario->getAll();
            print_r($usuarios);
        }

        $this->view->usuarios=$usuarios;


        $this->render('quemSeguir');
    }
}
