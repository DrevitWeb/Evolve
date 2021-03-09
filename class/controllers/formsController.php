<?php

use JetBrains\PhpStorm\NoReturn;

session_start();

require "autoloader.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_GET["func"]))
{
    if(function_exists($_GET["func"]))
    {
        if(isset($_POST['token']) && !empty($_POST['token']))
        {
            $form = unserialize($_SESSION["forms"][$_POST['token']]);
            if ($form->checkForm()) {
                $_GET["func"]($form);
            }
            else
            {
                header("HTTP/1.1 400 Bad Form");
                echo $form->getFormCorrected();
            }
        }
        else
        {
            header("HTTP/1.1 401 Unauthorized form not found");
        }
    }
    else
    {
        header("HTTP/1.1 401 Unauthorized function not found");
    }
}
else
{
    header("HTTP/1.1 401 Unauthorized no function provided");
}

#[NoReturn] function loginAdmin($form)
{
    if($form->getValue("passwd") == "Stq5v3fg!")
    {
        $admin = new stdClass();
        $admin->username = $form->getValue("username");
        \basics\Session::set("admin", $admin);
        \basics\Session::setAlert("success", "Vous êtes bien connecté.");

        $file = file_put_contents("../../log/admin.txt", "Connexion admin ".$admin->username." at ".date("d.m.y G:i:s")."\n", FILE_APPEND);


        die();
    }
    else
    {
        \basics\Session::setAlert("errors", "Mot de passe erroné!");
        $file = file_put_contents("../../log/admin.txt", "Connexion échouée ".$form->getValue("username")." at ".date("d.m.y G:i:s")."\n", FILE_APPEND);
        die();
    }
}

function register($form)
{

}