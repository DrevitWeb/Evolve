<?php
    $form = new \basics\form\Form("post", "", "Se connecter", "loginAdmin", "col-8 p-col-6");
    $form->addInput(new \basics\form\Input("text", "username", "Nom d'utilisateur"))->setRequired();
    $form->addInput(new \basics\form\Input("password", "passwd", "Mot de passe"))->setRequired();
?>
<link rel="stylesheet" type="text/css" href="res/styles/pages/adminStyle.css"/>
<h1>Page d'administration</h1>
<?php if(isset($_SESSION["admin"]) && !empty($_SESSION["admin"])){?><a id="logout" class="btn rounded" href="?p=admin/logout">Se déconnecter</a> <?php }?>
<br/>
<br/>
<?php
if(!isset($_SESSION["admin"]) || empty($_SESSION["admin"]))
{
    echo "<div class='center'><b>Vous n'êtes pas connecté. Veuillez entrer vos identifiants: </b></div><br/><br/>";
    echo "<div class='col-20'>".$form->build()."</div>";
}
else
{
    echo "<div class='center'><b>Bienvenue ".$_SESSION['admin']->username."</b></div>";

    ?>
        <br/>
    <br/>
    <div class="center col-20">
        <a class="btn rounded col-15" href="admin/playersManager">Gestion des joueurs</a>
    </div>

<?php
}
?>
<script>
    registerForm("loginAdmin", "loginAdmin", function (){
       document.location.reload();
    });
</script>
