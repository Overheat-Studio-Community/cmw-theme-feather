<?php

use CMW\Controller\Core\SecurityController;
use CMW\Interface\Users\IUsersOAuth;
use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;
use CMW\Manager\Env\EnvManager;


/* @var IUsersOAuth[] $oAuths */

Website::setTitle('Inscription');
Website::setDescription('Inscrivez-vous sur le site ' . Website::getWebsiteName());

?>

<div class="mt-20 mb-2 grid grid-cols-1 lg:grid-cols-2 gap-4">
    <!-- Colonne 1 : Image -->
    <form class="min-w-full flex my-1 justify-center flex-col" action="" method="post">
        <?php SecurityManager::getInstance()->insertHiddenToken() ?>
        <div class="flex align-center justify-center flex-col">
            <div class="flex justify-center	 text-4xl font-extrabold">Créer votre compte</div>
            <div class="mt-4 flex align-center justify-center items-center text-sm text-gray-400">
                Entrez les différentes informations nécéssaires pour créer votre compte.
            </div>
            <div class="relative w-full max-w-sm mx-auto mt-4 my-2 flex flex-col">
                <label for="register_email">E-Mail</label>
                <input class="relative w-full bg-gray-100 rounded-lg pl-2 py-2 my-2" id="register_email"
                       name="register_email" type="email"
                       placeholder="<?= LangManager::translate('users.users.mail') ?>">


                <label for="register_pseudo">Pseudo</label>
                <input class="relative w-full bg-gray-100 rounded-lg pl-2 py-2 my-2" id="register_pseudo"
                       name="register_pseudo" type="text"
                       placeholder="<?= LangManager::translate('users.users.pseudo') ?>">

                <label for="register_password">Mot de passe</label>
                <input class="relative w-full bg-gray-100 rounded-lg pl-2 py-2 my-2" id="register_password"
                       type="password"
                       name="register_password"
                       placeholder="<?= LangManager::translate('users.users.pass') ?>">

                <label for="register_password_verify">Confirmez votre mot de passe</label>
                <input class="relative w-full bg-gray-100 rounded-lg pl-2 py-2 my-2" id="register_password_verify"
                       type="password" name="register_password_verify"
                       placeholder="<?= LangManager::translate('users.users.repeat_pass') ?>">
                <?php if (count($oAuths) >= 3) : ?>
                    <div class="flex justify-center">Sign up with :</div>
                    <div class="flex flex-wrap gap-2 mt-2 justify-center text-xs">
                        <?php foreach ($oAuths as $oAuth): ?>
                            <div class="min-w-20 flex flex-col items-center text-gray-400 hover:text-black">
                                <a href="oauth/<?= $oAuth->methodIdentifier() ?>"
                                   aria-label="<?= $oAuth->methodeName() ?>">
                                    <img src="<?= $oAuth->methodeIconLink() ?>"
                                         alt="<?= $oAuth->methodeName() ?>" class="w-10 h-10"/>
                                </a>
                                <?= $oAuth->methodeName() ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php else : ?>
                    <div class="flex flex-col my-1">
                        <?php foreach ($oAuths

                                       as $oAuth): ?>
                            <div class="flex my-1 rounded border border-gray-100 justify-center items-center gap-2">
                                <a href="oauth/<?= $oAuth->methodIdentifier() ?>"
                                   aria-label="<?= $oAuth->methodeName() ?>">
                                    <img src="<?= $oAuth->methodeIconLink() ?>"
                                         alt="<?= $oAuth->methodeName() ?>" width="32" height="32"/>
                                </a>
                                Sign up with <?= $oAuth->methodeName() ?>
                            </div>

                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php SecurityController::getPublicData(); ?>
                <div
                    class="mt-4 d-grid flex items-center justify-center bg-black text-white rounded-lg py-2 mx-auto w-full">
                    <button type="submit"><?= LangManager::translate('users.login.register') ?></button>
                </div>
            </div>
        </div>
    </form>
    <div class="hidden lg:flex max-h-full relative justify-center">
        <img class="flex justify-center w-11/12 rounded object-cover aspect-square lg:aspect-auto h-full "
             alt="Background"
             src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/photo-background.png' ?>">
        <div class="absolute bottom-5 left-16 text-white text-shadow-lg flex flex-col items-start z-10">
            <h2 class="text-2xl font-bold">Mon dressing</h2>
            <p class="leading-4 text-base mt-2 max-w-md">Découvrez mon dressing sous tous ses ensembles</p>
        </div>
        <div class="absolute inset-0"></div>
    </div>
</div>
