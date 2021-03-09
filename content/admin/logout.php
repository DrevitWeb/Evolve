<?php
    \basics\Session::destroy("admin");
    \basics\Session::setAlert("success", "Vous êtes bien déconnecté !");
    \basics\Utils::redirect("admin");
    die();