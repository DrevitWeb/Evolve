<?php
if(!isset($_SESSION["admin"]) || empty($_SESSION["admin"]))
{
    \basics\Session::setAlert("errors", "Vous n'êtes pas connecté !");
    \basics\Utils::redirect("?p=admin");
}
?>
<link rel="stylesheet" type="text/css" href="res/styles/pages/adminStyle.css"/>
<h1>Page de gestion des interactions</h1>
<a id="logout" class="btn rounded" href="?p=admin/logout">Se déconnecter</a>
<br/>
<br/>


