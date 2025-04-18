<?php

namespace App\Controllers;

//os recursos do miniframework
//use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{

	public function index()
	{
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('index');
	}

	public function inscreverse()

	{	
		$this->view->usuario=array(
			'nome'=> '',
			'email'=>'',
			'senha'=> '',

		);
		$this->view->erroCadastro=false;

		$this->render('inscreverse');
	}

	public function registrar()
	{
		//testando a super globa

		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';

		$usuario = Container::getModel('Usuario');

		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));

		// echo'<pre>';
		// print_r($usuario);
		// echo'</pre>';
		if ($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0) {
			$usuario->salvar();
			$this->render('cadastro');
		}
		
		else {

			$this->view->usuario=array(
				'nome'=> $_POST['nome'],
				'email'=> $_POST['email'],
				'senha'=> $_POST['senha'],

			);

			$this->view->erroCadastro=true;

			$this->render('inscreverse');
		}



		//receber os dados dos formularios
		//sucesso

		//erro
	}
}
