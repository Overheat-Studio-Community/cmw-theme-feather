<?php

use CMW\Controller\Core\SecurityController;
use CMW\Interface\Users\IUsersOAuth;
use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;

/* @var IUsersOAuth[] $oAuths */

Website::setTitle('Inscription');
Website::setDescription('Inscrivez-vous sur le site ' . Website::getWebsiteName());

?>


<form action="" method="post">
    <?php SecurityManager::getInstance()->insertHiddenToken() ?>
    <div class="mt-20">
        <input id="register_email" name="register_email" type="email"
               placeholder="<?= LangManager::translate('users.users.mail') ?>">
        <label for="register_email">E-Mail</label>
    </div>
    <div>
        <input id="register_pseudo" name="register_pseudo" type="text"
               placeholder="<?= LangManager::translate('users.users.pseudo') ?>">
        <label for="register_pseudo">Pseudo</label>
    </div>
    <div>
        <input id="register_password" type="password" name="register_password"
               placeholder="<?= LangManager::translate('users.users.pass') ?>">
        <label for="register_password">Mot de passe</label>
    </div>
    <div>
        <input id="register_password_verify" type="password" name="register_password_verify"
               placeholder="<?= LangManager::translate('users.users.repeat_pass') ?>">
        <label for="register_password_verify">Mot de passe</label>
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
    <div class="d-grid">
        <button type="submit"><?= LangManager::translate('users.login.register') ?></button>
    </div>
</form>