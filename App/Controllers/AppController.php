<?php

namespace App\Controllers;

//os recursos do miniframework
//use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action
{

    public function timeline(){

        session_start();
        
        if ($_SESSION['id'] != ''&& $_SESSION['nome']!='') {

            // echo'chegamos aqui';

            // echo'<pre>';

            // print_r($_SESSION);

            $this->render('timeline');
            # code...

            echo'</pre>';
        }else

        {
            header('Location: /?login=erro');
        }



       
    }
}
