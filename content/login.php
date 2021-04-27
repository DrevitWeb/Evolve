<?php

use basics\form\Form;
use basics\form\Input;
use basics\form\Select;

$form = new Form("post", "", "Connection", "login", "col-20");

$form->addInput(new Input("text", "pseudo", "Pseudo"))->setAlpha()->setRequired();
$form->addInput(new Input("password", "password", "Mot de passe"))->setRequired();
?>
<link rel="stylesheet" type="text/css" href="/res/styles/pages/interface.css"/>
<h1>Connexion au programme Evolve</h1>
<br/>
<div class="col-10" id="loginForm">
    <?php
    echo $form->build();
    ?>
</div>
<br/>
<script>
    registerForm("login", "login", function (){
        document.location.reload()
    }, "loginForm");
</script>
