<?php

use CMW\Controller\Users\UsersSessionsController;
use CMW\Manager\Env\EnvManager;
use CMW\Utils\Website;

Website::setTitle('Accueil');
Website::setDescription("page d'accueil de CraftMyWebsite");
?>
<style>
    body {
        margin: 10px;
        padding: 0;
        background-color: white;
        background-size: cover;
    }
    img {
        margin-top: -65px;
        padding: 0;
        max-height: 768px;

    }
</style>
<img alt="Background" src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/Background.jpg' ?>"> <div class="text-center grid-3">
    <h3>
        Bienvenue sur votre site <?= UsersSessionsController::getInstance()->getCurrentUser()?->getPseudo() ?? '' ?>!
    </h3>
    <p>Feather est maintenant prêt à être développé !</p>
</div>






