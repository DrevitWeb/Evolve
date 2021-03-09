<?php

    use basics\form\Form;
    use basics\form\Input;
    use basics\form\Select;

    $form = new Form("post", "", "Inscription", "register", "col-20");

    $form->addInput(new Input("text", "pseudo", "Pseudo"))->setAlpha()->setRequired()->setUnique("users", "pseudo");
    $form->addInput(new Input("text", "name", "Prénom"))->setRequired();
    $form->addInput(new Input("text", "surname", "Nom"))->setRequired();
    $form->addInput(new Input("email", "email", "Adresse mail"))->setEmail()->setRequired()->setUnique("users", "email");
    $form->addInput(new Input("password", "password", "Mot de passe"))->setRequired()->setEquals("confirm");
    $form->addInput(new Input("password", "confirm", "Confirmation"))->setRequired()->setEquals("password");

    $school = new Select("origin", "Ecole/Résidence");
    $school->addOption("ISEN Nantes", "ISEN_Nantes");
    $school->addOption("Arlezines ISEN", "Arlezines_ISEN");
    $school->addOption("Arlezines", "Arlezines");
    $school->addOption("Autre", "Autre");

    $form->addInput($school)->setRequired();
    ?>
<link rel="stylesheet" type="text/css" href="res/styles/pages/interface.css"/>
<h1>Enregistrement au programme Evolve</h1>
<br/>
<div class="col-10" id="registerForm">
    <?php
    echo $form->build();
    ?>
</div>
<script>
    registerForm("register", "register", function (){

    }, "registerForm");
</script>
