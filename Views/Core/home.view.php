<?php

use CMW\Controller\Users\UsersSessionsController;
use CMW\Utils\Website;

Website::setTitle('Accueil');
Website::setDescription("page d'accueil de CraftMyWebsite");
?>

<div class="text-center mt-24">
    <h3>
        Bienvenue sur votre site <?= UsersSessionsController::getInstance()->getCurrentUser()?->getPseudo() ?? '' ?>!
    </h3>
    <p>Feather est maintenant prêt à être développé !</p>
</div>
