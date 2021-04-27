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

function login(\basics\form\Form $form)
{
    if(\modules\users\UsersManager::loginUser($form->getValue("pseudo"), $form->getValue("password")))
    {
        \basics\Session::setAlert("success", "Vous êtes maintenant connecté.");
        header("HTTP/1.1 200 Login");
    }
    else
    {
        echo "<div class='alert alert-error'>Votre pseudo ou mot de passe est incorrect</div><br/><br/>";
        header("HTTP/1.1 400 Bad Form");
        echo $form->getFormCorrected();
    }
}

function register(\basics\form\Form $form)
{
    $password = $form->getValue("password");
    $user = \modules\users\UsersManager::registerUser($form->getValue("pseudo"), $password, $form->getValue("email"));
    while(\modules\users\UsersManager::getUserByToken($user) == null)
    {
        var_dump($user);
        usleep(100);
    }
    $player = \game\player\PlayersManager::newPlayer($form->getValue("name"), $form->getValue("surname"), $form->getValue("origin"), $user);
    $message = "Bienvenue ".$form->getValue("pseudo")."<br/><br/>";
    $mail = new \modules\mail\Mail($form->getValue("email"), "Votre inscription au programme Evolve", $message, "mail");
    \basics\Session::setAlert("success", "Vous êtes maintenant inscrit au programme Evolve... Bonne chance dans votre quête.");
}