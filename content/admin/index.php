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
        <br/>
        <br/>
        <a class="btn rounded col-15" href="admin/itemsManager">Gestion des objets</a>
        <br>
        <br>
        <a class="btn rounded col-15" href="admin/marketManager">Gestion du marché</a>
        <br>
        <br>
        <a class="btn rounded col-15" href="admin/locationsManager">Gestion des lieux</a>
        <br>
        <br>
        <a class="btn rounded col-15" href="admin/objectivesManager">Gestion des objectifs</a>
        <br>
        <br>
        <a class="btn rounded col-15" href="admin/npcsManager">Gestion des PNJ</a>
        <br>
        <br>
        <a class="btn rounded col-15" href="admin/interactionsManager">Gestion des interactions</a>
        <br>
        <br>
        <a class="btn rounded col-15" href="admin/rewardsManager">Gestion des Récompenses</a>
    </div>

<?php
}
?>
<script>
    registerForm("loginAdmin", "loginAdmin", function (){
       document.location.reload();
    });
</script>
