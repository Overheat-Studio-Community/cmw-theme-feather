<?php

use CMW\Controller\Core\SecurityController;
use CMW\Interface\Users\IUsersOAuth;
use CMW\Manager\Env\EnvManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Model\Core\ThemeModel;
use CMW\Utils\Website;

/* @var IUsersOAuth[] $oAuths */

Website::setTitle('Connexion');
Website::setDescription('Connectez-vous à votre compte ' . Website::getWebsiteName());
?>


<form action="" method="post">
    <?php SecurityManager::getInstance()->insertHiddenToken() ?>
    <input hidden name="previousRoute" type="text"
           value="<?= $_SERVER['HTTP_REFERER'] ?? (EnvManager::getInstance()->getValue('PATH_SUBFOLDER') . 'login') ?>">
    <div>
        <input id="login_email" name="login_email" type="email" placeholder="Votre mail" required>
        <label for="login_email">E-Mail</label>
    </div>
    <div>
        <input id="login_password" type="password" name="login_password" placeholder="****" required>
        <label for="login_password">Mot de passe</label>
    </div>
    <div>
        <div>
            <div>
                <input type="checkbox" id="login_keep_connect" name="login_keep_connect">
                <label for="login_keep_connect">Se souvenir de moi</label>
            </div>
        </div>
        <div>
            <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>login/forgot">Mot de
                passe oublié</a>
        </div>
    </div>

    <div>
        <?php foreach ($oAuths as $oAuth): ?>
            <a href="oauth/<?= $oAuth->methodIdentifier() ?>"
               aria-label="<?= $oAuth->methodeName() ?>">
                <img src="<?= $oAuth->methodeIconLink() ?>"
                     alt="<?= $oAuth->methodeName() ?>" width="32" height="32"/>
            </a>
        <?php endforeach; ?>
    </div>
    <?php SecurityController::getPublicData(); ?>
    <button style="background: <?= ThemeModel::getInstance()->fetchConfigValue('buttonColor') ?>" type="submit">
        Connexion
    </button>
</form>