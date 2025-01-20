<?php

use CMW\Entity\Users\UserEntity;
use CMW\Manager\Env\EnvManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;

/* @var UserEntity $user */

Website::setTitle('Profil ' . $user->getPseudo());
Website::setDescription("Découvrez le profil de l'utilisateur " . $user->getPseudo());

?>

<h1 class="text-center text-xl font-semibold mt-20">Profil de <?= $user->getPseudo() ?></h1>
<section id="contact" class="grid grid-cols-1 md:grid-cols-2 gap-8 p-4">
    <!-- Informations personnelles -->
    <div class="flex justify-center items-center">
        <div class="w-full max-w-xl rounded-lg">
            <h4 class="text-center text-xl font-semibold mt-4 mb-6">Informations personnelles</h4>
            <form class="space-y-4"
                  action="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') . 'profile/update' ?>"
                  method="post">
                <?php SecurityManager::getInstance()->insertHiddenToken() ?>
                <div class="space-y-3">
                    <!-- Email -->
                    <div>
                        <label for="login_email" class="block text-sm font-medium text-gray-700">E-Mail</label>
                        <input id="login_email"
                               class="block w-full bg-gray-100 border border-gray-300 rounded-lg p-2 mt-1"
                               name="login_email"
                               type="email"
                               value="<?= $user->getMail() ?>"
                               required>
                    </div>
                    <!-- Pseudo -->
                    <div>
                        <label for="pseudo" class="block text-sm font-medium text-gray-700">Pseudo</label>
                        <input id="pseudo"
                               class="block w-full bg-gray-100 border border-gray-300 rounded-lg p-2 mt-1"
                               name="pseudo"
                               type="text"
                               value="<?= $user->getPseudo() ?>"
                               required>
                    </div>
                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <input id="password"
                               class="block w-full bg-gray-100 border border-gray-300 rounded-lg p-2 mt-1"
                               name="password"
                               type="password"
                               required>
                    </div>
                    <!-- Confirmation mot de passe -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmation de mot de passe</label>
                        <input id="password_confirmation"
                               class="block w-full bg-gray-100 border border-gray-300 rounded-lg p-2 mt-1"
                               name="password_confirmation"
                               type="password"
                               required>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button class="w-full bg-black text-white rounded-lg p-2" type="submit">
                        Appliquer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Sécurité -->
    <div class="flex justify-center items-center">
        <div class="w-full max-w-xl rounded-lg">
            <h4 class="text-center text-xl font-semibold mb-6">
                Sécurité :
                <small>
                    <?php if ($user->get2Fa()->isEnabled()): ?>
                        <span class="text-green-600">Actif !</span>
                    <?php else: ?>
                        <span class="text-red-600">Inactif !</span>
                    <?php endif; ?>
                </small>
            </h4>
            <?php if (!$user->get2Fa()->isEnabled()): ?>
                <p class="text-center mb-4">
                    Pour activer l'authentification à double facteur, scannez le QR code avec une application
                    d'authentification (Google Authenticator, Aegis...).
                </p>
            <?php endif; ?>
            <div class="flex justify-center mb-4">
                <img class="w-32" src="<?= $user->get2Fa()->getQrCode(250) ?>" alt="QR Code double authentification">
            </div>
            <p class="text-center text-sm mb-4"><?= $user->get2Fa()->get2FaSecretDecoded() ?></p>
            <form action="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>profile/2fa/toggle"
                  method="post"
                  class="space-y-4">
                <?php SecurityManager::getInstance()->insertHiddenToken() ?>
                <div>
                    <label for="secret" class="block text-sm font-medium text-gray-700">Code d'authentification</label>
                    <input id="secret"
                           class="block w-full bg-gray-100 border border-gray-300 rounded-lg p-2 mt-1"
                           name="secret"
                           type="number"
                           maxlength="7"
                           required>
                </div>
                <button class="w-full bg-black text-white rounded-lg p-2" type="submit">
                    <?= $user->get2Fa()->isEnabled() ? 'Désactiver' : 'Activer' ?>
                </button>
            </form>
        </div>
    </div>

    <!-- Identité visuelle -->
    <div class="lg:col-span-1 flex justify-center items-center">
        <div class="w-full max-w-xl rounded-lg">
            <h4 class="text-center text-xl font-semibold mb-6">Identité visuelle</h4>
            <?php if (!is_null($user->getUserPicture()?->getImage())): ?>
                <label for="picture" class="block text-center mb-4">Votre image :</label>
                <img class="mx-auto w-32 h-32 rounded-lg border border-gray-300"
                     src="<?= $user->getUserPicture()->getImage() ?>"
                     alt="Image de profil de <?= $user->getPseudo() ?>">
            <?php endif; ?>
            <form action="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>profile/update/picture"
                  method="post"
                  enctype="multipart/form-data"
                  class="space-y-4">
                <?php SecurityManager::getInstance()->insertHiddenToken() ?>
                <div>
                    <label for="pictureProfile" class="block text-sm font-medium text-gray-700">
                        Changer votre image :
                    </label>
                    <input type="file"
                           id="pictureProfile"
                           name="pictureProfile"
                           class="block w-full bg-gray-100 border border-gray-300 rounded-lg p-2 mt-1"
                           accept=".png, .jpg, .jpeg, .webp, .gif"
                           required>
                </div>
                <p class="text-center text-sm text-gray-500">Formats acceptés : PNG, JPG, JPEG, WEBP, GIF. (400x400 max)</p>
                <button class="w-full bg-black text-white rounded-lg p-2" type="submit">
                    Sauvegarder
                </button>
            </form>
        </div>
    </div>

    <!-- Supprimer le compte -->
    <div class="text-center bg-white">
        <h2 class="text-xl font-semibold mb-4">Vous nous quittez ?</h2>
        <p class="text-gray-600 mb-4">Nous sommes tristes de vous voir partir !</p>
        <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>profile/delete/<?= $user->getId() ?>"
           class="inline-block bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600">
            Supprimer mon compte
        </a>
    </div>
</section>

